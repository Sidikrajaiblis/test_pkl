<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class KecamatanApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Kecamatan::with('kabupaten');

        // Filter berdasarkan id_kecamatan
        if ($request->filled('id_kecamatan')) {
            $query->where('id_kecamatan', $request->id_kecamatan);
        }

        // Filter berdasarkan nama_kecamatan (LIKE)
        if ($request->filled('nama_kecamatan')) {
            $query->where('nama_kecamatan', 'like', '%' . $request->nama_kecamatan . '%');
        }

        // Filter berdasarkan id_kabupaten
        if ($request->filled('id_kabupaten')) {
            $query->where('id_kabupaten', $request->id_kabupaten);
        }

        // Filter berdasarkan nama_kabupaten (relasi)
        if ($request->filled('nama_kabupaten')) {
            $query->whereHas('kabupaten', function ($q) use ($request) {
                $q->where('nama_kabupaten', 'like', '%' . $request->nama_kabupaten . '%');
            });
        }

        $data = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Data kecamatan ditemukan',
            'data' => $data
        ], 200);
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama_kecamatan' => 'required|string',
                'id_kabupaten' => 'required|exists:m_kabupaten,id_kabupaten'
            ]);

            // Cek duplikasi berdasarkan nama + kabupaten
            $exists = Kecamatan::where('nama_kecamatan', $validated['nama_kecamatan'])
                ->where('id_kabupaten', $validated['id_kabupaten'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kecamatan sudah ada pada kabupaten tersebut',
                ], 409); // 409 Conflict
            }

            // Simpan data
            $kecamatan = Kecamatan::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Kecamatan berhasil ditambahkan',
                'data' => $kecamatan
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
