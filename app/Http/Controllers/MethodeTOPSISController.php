<?php

namespace App\Http\Controllers;

use App\Models\Alternatifwp;
use App\Models\Datawp;
use App\Models\Kriteriawp;
use Illuminate\Http\Request;

class MethodeTOPSISController extends Controller
{
    public function methodetopsis()
    {
        $alternatif = Alternatifwp::all();
        $kriteria = Kriteriawp::all();
        $altkrit = Datawp::all();

        if ($altkrit->isEmpty()) {
            return view('kosong.index');
        }

        // Inisialisasi variable array untuk menyimpan nilai sum, results dan matrix ternormalisasi
        $sum = [];
        $results = [];
        $originalResults = [];

        // Perulangan untuk menghitung matrix ternormalisasi
        foreach ($alternatif as $a) {
            $resultRow = [];

            foreach ($kriteria as $k) {
                $altKriteriaData = $altkrit->where('alternatifwp_id', $a->id)->where('kriteriawp_id', $k->id)->first();

                if ($altKriteriaData) {
                    $value = $altKriteriaData->value;

                    $totalKriteriaSquaredSum = Datawp::where('kriteriawp_id', $k->id)
                        ->selectRaw('SUM(POW(value, 2)) as total_squared_sum')
                        ->value('total_squared_sum');

                    $sum[$k->id] = $totalKriteriaSquaredSum;

                    $result = $value / sqrt($totalKriteriaSquaredSum);

                    // Menyimpan hasil asli dalam variabel
                    $resultRow[$k->id] = $result;
                } else {
                    $resultRow[$k->id] = 0;
                }
            }

            $originalResults[$a->id] = $resultRow;
        }


        $weightedResults = [];

        // Perulangan kedua untuk mengalikan hasil asli dengan bobot
        foreach ($originalResults as $a => $resultRow) {
            $weightedResultRow = [];

            foreach ($kriteria as $k) {
                $bobotKriteria = $k->bobot;
                $resultWithWeight = $resultRow[$k->id] * $bobotKriteria;
                $weightedResultRow[$k->id] = $resultWithWeight;
            }

            $weightedResults[$a] = $weightedResultRow;
        }

        $valuesByKriteria = [];

        // Perulangan untuk mengelompokkan nilai berdasarkan id_kriteria
        foreach ($weightedResults as $a => $resultRow) {
            foreach ($resultRow as $k => $value) {
                $idKarakter = $k;
                $idKriteria = $kriteria->find($idKarakter)->id;

                if (!isset($valuesByKriteria[$idKriteria])) {
                    $valuesByKriteria[$idKriteria] = [];
                }

                $valuesByKriteria[$idKriteria][] = $value;
            }
        }

        $Amax = [];
        $Amin = [];

        // Perulangan dan kondisi untuk mencari nilai tertinggi dan terendah pada setiap kriteria yang menyesuaikan dengan attribut yang ada
        foreach ($valuesByKriteria as $idKriteria => $values) {
            $kriteriaObj = $kriteria->find($idKriteria);
            $attribute = $kriteriaObj->atribut;

            if ($attribute === 'benefit') {
                $maxValue = max($values);
                $Amax[$idKriteria] = $maxValue;
                $minValue = min($values);
                $Amin[$idKriteria] = $minValue;
            } elseif ($attribute === 'cost') {
                $maxValue = max($values);
                $Amin[$idKriteria] = $maxValue;
                $minValue = min($values);
                $Amax[$idKriteria] = $minValue;
            }
        }

        // Inisialisasi array untuk menyimpan hasil solusi ideal positif dan negatif
        $resultSquaredPositif = [];
        $resultSquaredNegatif = [];

        // Perulangan untuk mencari hasil nilai ideal positif
        foreach ($weightedResults as $a => $resultRow) {
            foreach ($resultRow as $k => $value) {
                $idKriteria = $k;

                $amaxForKriteria = $Amax[$idKriteria];
                $valueAfterSubtraction = $value - $amaxForKriteria;
                $resultSquaredPositif[$a][$k] = pow($valueAfterSubtraction, 2);
            }
        }

        // Perulangan untuk mencari hasil nilai ideal negatif
        foreach ($weightedResults as $a => $resultRow) {
            foreach ($resultRow as $k => $value) {
                $idKriteria = $k;

                $aminForKriteria = $Amin[$idKriteria];
                $valueAfterSubtraction = $value - $aminForKriteria;
                $resultSquaredNegatif[$a][$k] = pow($valueAfterSubtraction, 2);
            }
        }

        // Inisialisasi array untuk menyimpan hasil penjumlahan setiap nilai berdasarkan id_alternatif
        $sumByAlternatifPositif = [];
        $sumByAlternatifNegatif = [];

        // Perulangan untuk mencari hasil penjumlahan nilai ideal positif
        foreach ($resultSquaredPositif as $a => $resultRow) {
            $sumByAlternatifPositif[$a] = 0;

            foreach ($resultRow as $k => $value) {
                $sumByAlternatifPositif[$a] += $value;
            }
        }

        // Perulangan untuk mencari hasil penjumlahan nilai ideal positif
        foreach ($resultSquaredNegatif as $a => $resultRow) {
            $sumByAlternatifNegatif[$a] = 0;

            foreach ($resultRow as $k => $value) {
                $sumByAlternatifNegatif[$a] += $value;
            }
        }

        // Inisalisasi untuk mendapatkan nilai D+ dan D-
        $sqrtByAlternatifPositif = [];
        $sqrtByAlternatifNegatif = [];

        foreach ($sumByAlternatifPositif as $a => $sum) {
            $sqrtByAlternatifPositif[$a] = sqrt($sum);
        }


        foreach ($sumByAlternatifNegatif as $a => $sum) {
            $sqrtByAlternatifNegatif[$a] = sqrt($sum);
        }

        return view('metode.topsis.metode', compact('sqrtByAlternatifNegatif', 'sqrtByAlternatifPositif', 'resultSquaredNegatif', 'resultSquaredPositif', 'Amax', 'Amin', 'originalResults', 'weightedResults', 'alternatif', 'kriteria'));
    }

    public function hasil()
    {
        $alternatif = Alternatifwp::all();
        $kriteria = Kriteriawp::all();
        $altkrit = Datawp::all();

        if ($altkrit->isEmpty()) {
            return view('kosong.index');
        }

        // Inisialisasi variable array untuk menyimpan nilai sum, results dan matrix ternormalisasi
        $sum = [];
        $results = [];
        $originalResults = [];

        // Perulangan untuk menghitung matrix ternormalisasi
        foreach ($alternatif as $a) {
            $resultRow = [];

            foreach ($kriteria as $k) {
                $altKriteriaData = $altkrit->where('alternatifwp_id', $a->id)->where('kriteriawp_id', $k->id)->first();

                if ($altKriteriaData) {
                    $value = $altKriteriaData->value;

                    $totalKriteriaSquaredSum = Datawp::where('kriteriawp_id', $k->id)
                        ->selectRaw('SUM(POW(value, 2)) as total_squared_sum')
                        ->value('total_squared_sum');

                    $sum[$k->id] = $totalKriteriaSquaredSum;

                    $result = $value / sqrt($totalKriteriaSquaredSum);

                    // Menyimpan hasil asli dalam variabel
                    $resultRow[$k->id] = $result;
                } else {
                    $resultRow[$k->id] = 0;
                }
            }

            $originalResults[$a->id] = $resultRow;
        }


        $weightedResults = [];

        // Perulangan kedua untuk mengalikan hasil asli dengan bobot
        foreach ($originalResults as $a => $resultRow) {
            $weightedResultRow = [];

            foreach ($kriteria as $k) {
                $bobotKriteria = $k->bobot;
                $resultWithWeight = $resultRow[$k->id] * $bobotKriteria;
                $weightedResultRow[$k->id] = $resultWithWeight;
            }

            $weightedResults[$a] = $weightedResultRow;
        }

        $valuesByKriteria = [];

        // Perulangan untuk mengelompokkan nilai berdasarkan id_kriteria
        foreach ($weightedResults as $a => $resultRow) {
            foreach ($resultRow as $k => $value) {
                $idKarakter = $k;
                $idKriteria = $kriteria->find($idKarakter)->id;

                if (!isset($valuesByKriteria[$idKriteria])) {
                    $valuesByKriteria[$idKriteria] = [];
                }

                $valuesByKriteria[$idKriteria][] = $value;
            }
        }

        $Amax = [];
        $Amin = [];

        // Perulangan dan kondisi untuk mencari nilai tertinggi dan terendah pada setiap kriteria yang menyesuaikan dengan attribut yang ada
        foreach ($valuesByKriteria as $idKriteria => $values) {
            $kriteriaObj = $kriteria->find($idKriteria);
            $attribute = $kriteriaObj->atribut;

            if ($attribute === 'benefit') {
                $maxValue = max($values);
                $Amax[$idKriteria] = $maxValue;
                $minValue = min($values);
                $Amin[$idKriteria] = $minValue;
            } elseif ($attribute === 'cost') {
                $maxValue = max($values);
                $Amin[$idKriteria] = $maxValue;
                $minValue = min($values);
                $Amax[$idKriteria] = $minValue;
            }
        }

        // Inisialisasi array untuk menyimpan hasil solusi ideal positif dan negatif
        $resultSquaredPositif = [];
        $resultSquaredNegatif = [];

        // Perulangan untuk mencari hasil nilai ideal positif
        foreach ($weightedResults as $a => $resultRow) {
            foreach ($resultRow as $k => $value) {
                $idKriteria = $k;

                $amaxForKriteria = $Amax[$idKriteria];
                $valueAfterSubtraction = $value - $amaxForKriteria;
                $resultSquaredPositif[$a][$k] = pow($valueAfterSubtraction, 2);
            }
        }

        // Perulangan untuk mencari hasil nilai ideal negatif
        foreach ($weightedResults as $a => $resultRow) {
            foreach ($resultRow as $k => $value) {
                $idKriteria = $k;

                $aminForKriteria = $Amin[$idKriteria];
                $valueAfterSubtraction = $value - $aminForKriteria;
                $resultSquaredNegatif[$a][$k] = pow($valueAfterSubtraction, 2);
            }
        }

        // Inisialisasi array untuk menyimpan hasil penjumlahan setiap nilai berdasarkan id_alternatif
        $sumByAlternatifPositif = [];
        $sumByAlternatifNegatif = [];

        // Perulangan untuk mencari hasil penjumlahan nilai ideal positif
        foreach ($resultSquaredPositif as $a => $resultRow) {
            $sumByAlternatifPositif[$a] = 0;

            foreach ($resultRow as $k => $value) {
                $sumByAlternatifPositif[$a] += $value;
            }
        }

        // Perulangan untuk mencari hasil penjumlahan nilai ideal positif
        foreach ($resultSquaredNegatif as $a => $resultRow) {
            $sumByAlternatifNegatif[$a] = 0;

            foreach ($resultRow as $k => $value) {
                $sumByAlternatifNegatif[$a] += $value;
            }
        }

        // Inisalisasi untuk mendapatkan nilai D+ dan D-
        $sqrtByAlternatifPositif = [];
        $sqrtByAlternatifNegatif = [];

        foreach ($sumByAlternatifPositif as $a => $sum) {
            $sqrtByAlternatifPositif[$a] = sqrt($sum);
        }


        foreach ($sumByAlternatifNegatif as $a => $sum) {
            $sqrtByAlternatifNegatif[$a] = sqrt($sum);
        }

        // Inisialisasi array untuk menyimpan hasil perhitungan
        $finalResults = [];

        // Perulangan untuk mencari nilai preverensi (D-/((D-)+D+))
        foreach ($alternatif as $a) {
            $idAlternatif = $a->id;

            if (isset($sqrtByAlternatifNegatif[$idAlternatif]) && isset($sqrtByAlternatifPositif[$idAlternatif])) {
                $negatif = $sqrtByAlternatifNegatif[$idAlternatif];
                $positif = $sqrtByAlternatifPositif[$idAlternatif];

                // Melakukan perhitungan
                $hasil = $negatif / ($negatif + $positif);

                $finalResults[$idAlternatif] = $hasil;
            }
        }

        arsort($finalResults);

        // Inisialisasi array untuk menyimpan peringkat
        $ranking = [];

        // Hitung peringkat dan simpan dalam array
        $rank = 1;
        foreach ($finalResults as $alternatifId => $hasil) {
            $alternatif = Alternatifwp::find($alternatifId);

            if ($alternatif) {
                $ranking[] = [
                    'rank' => $rank,
                    'alternatif_keterangan' => $alternatif->nama,
                    'alternatif_name' => $alternatif->kode,
                    'final_value' => $hasil
                ];
            }

            $rank++;
        }

        return view('hasil.topsis.hasil', compact('finalResults', 'alternatif', 'ranking'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
