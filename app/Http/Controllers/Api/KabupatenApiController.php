<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;
use Illuminate\Validation\ValidationException;
use Exception;

class KabupatenApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Kabupaten::query();

        // Filter by nama_kabupaten
        if ($request->filled('nama_kabupaten')) {
            $query->where('nama_kabupaten', 'like', '%' . $request->nama_kabupaten . '%');
        }

        // Filter by id_kabupaten
        if ($request->filled('id_kabupaten')) {
            $query->where('id_kabupaten', $request->id_kabupaten);
        }

        $data = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Data kabupaten ditemukan',
            'data' => $data,
        ], 200);
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kabupaten' => 'required|unique:m_kabupaten,nama_kabupaten'
            ]);

            $kabupaten = Kabupaten::create([
                'nama_kabupaten' => $validated['nama_kabupaten']
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $kabupaten
            ], 201); // 201 Created

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }
}
