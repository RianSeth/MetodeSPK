<?php

namespace App\Http\Controllers;

use App\Models\Alternatifwp;
use App\Models\Datawp;
use Illuminate\Http\Request;

class AlternatifWPController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'keterangan',
        ]);

        $tambahalternatif = Alternatifwp::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        if ($tambahalternatif)
        {
            Datawp::truncate();
        }

        return redirect()->route('alwp');
    }
}
