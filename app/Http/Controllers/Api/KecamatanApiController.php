<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Data kecamatan ditemukan',
            'data' => Kecamatan::with('kabupaten')->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string',
            'id_kabupaten' => 'required|exists:m_kabupaten,id_kabupaten'
        ]);

        $exists = Kecamatan::where('nama_kecamatan', $request->nama_kecamatan)
            ->where('id_kabupaten', $request->id_kabupaten)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Data kecamatan sudah ada pada kabupaten tersebut',
            ], 409);
        }

        $kecamatan = Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
            'id_kabupaten' => $request->id_kabupaten
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kecamatan berhasil ditambahkan',
            'data' => $kecamatan
        ], 201);
    }
}
