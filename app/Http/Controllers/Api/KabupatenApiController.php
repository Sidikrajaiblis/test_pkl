<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;

class KabupatenApiController extends Controller
{
    public function index()
    {
        $data = Kabupaten::all();

        return response()->json([
            'status' => true,
            'message' => 'Data kabupaten ditemukan',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kabupaten' => 'required|unique:m_kabupaten,nama_kabupaten'
        ]);

        $kabupaten = Kabupaten::create([
            'nama_kabupaten' => $request->nama_kabupaten
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $kabupaten
        ]);
    }
}
