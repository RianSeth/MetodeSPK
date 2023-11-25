<?php

namespace App\Http\Controllers;

use App\Models\Kriteriawp;
use Illuminate\Http\Request;

class KriteriaWPController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'kriteria' => 'required',
            'bobot' => 'required',
            'atribut' => 'required'
        ]);

        Kriteriawp::create([
            'kode' => $request->kode,
            'kriteria' => $request->kriteria,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ]);

        return redirect()->route('krwp');
    }
}
