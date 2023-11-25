<?php

namespace App\Http\Controllers;

use App\Models\Alternatifwp;
use App\Models\Datawp;
use App\Models\Kriteriawp;
use Illuminate\Http\Request;

class DataWPController extends Controller
{
    public function krwp()
    {
        $kriterias = Kriteriawp::all();

        $kriteriaCount = Kriteriawp::count();
        $newCodeKriteria = 'C' . ($kriteriaCount + 1);

        return view('data.wp.kriteria.krwp', compact('kriterias', 'newCodeKriteria'));
    }

    public function alwp()
    {
        $alternatifs = Alternatifwp::all();

        $alternatifCount = Alternatifwp::count();
        $newCodeAlternatif = 'A' . ($alternatifCount + 1);

        return view('data.wp.alternatif.alwp', compact('alternatifs', 'newCodeAlternatif'));
    }

    public function datawp()
    {
        $datawps = Datawp::all();
        $kriterias = Kriteriawp::all();
        $alternatifs = Alternatifwp::all();

        return view('data.wp.data.datawp', compact('kriterias', 'alternatifs', 'datawps'));
    }

    public function create(Request $request)
    {
        //dd($request->all());

        $data = $request->input('data');

        foreach ($data as $idAlternatif => $kriteriaData) {
            foreach ($kriteriaData as $idKriteria => $rowData) {
                $value = $rowData['value'];
                $idAlternatif = $rowData['id_alternatif'];
                $idKriteria = $rowData['id_kriteria'];

                // Periksa apakah nilai kosong
                if (empty($value)) {
                    return redirect()->back()->withInput()->withErrors(['error' => 'Harap isi semua nilai untuk setiap alternatif dan kriteria.']);
                }

                Datawp::create([
                    'kriteriawp_id' => $idKriteria,
                    'alternatifwp_id' => $idAlternatif,
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('datawp');
    }

    public function destroy()
    {
        Datawp::truncate();

        return redirect()->route('datawp');
    }
}
