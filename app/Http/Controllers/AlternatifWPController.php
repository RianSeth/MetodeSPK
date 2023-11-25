<?php

namespace App\Http\Controllers;

use App\Models\Alternatifwp;
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

        Alternatifwp::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('alwp');
    }
}
