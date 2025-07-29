<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogikaController extends Controller
{
    public function index()
    {
        return view('logika.form');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nilai' => 'required|numeric'
        ]);

        $nilai = $request->nilai;

        // Logika peringkat
        if ($nilai >= 500) {
            $peringkat = "Sangat Tinggi";
        } elseif ($nilai >= 400) {
            $peringkat = "Tinggi";
        } elseif ($nilai >= 300) {
            $peringkat = "Menengah";
        } elseif ($nilai >= 200) {
            $peringkat = "Rendah";
        } else {
            $peringkat = "Sangat Rendah";
        }

        return view('logika.form', compact('nilai', 'peringkat'));
    }
}
