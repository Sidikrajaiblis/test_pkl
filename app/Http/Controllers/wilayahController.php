<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class wilayahController extends Controller
{
    public function index(Request $request)
    {
        $kabupaten = Kabupaten::all();
        $selectedKabupaten = $request->kabupaten_id;

        // Ambil semua atau berdasarkan id_kabupaten
        $kecamatan = Kecamatan::with('kabupaten');

        if ($selectedKabupaten) {
            $kecamatan->where('id_kabupaten', $selectedKabupaten);
        }

        return view('wilayah.index', [
            'kabupaten' => $kabupaten,
            'selectedKabupaten' => $selectedKabupaten,
            'kecamatan' => $kecamatan->get()
        ]);
    }

    public function storeKabupaten(Request $request)
    {
        $request->validate([
            'nama_kabupaten' => 'required|unique:m_kabupaten,nama_kabupaten',
        ]);

        Kabupaten::create($request->only('nama_kabupaten'));
        return redirect()->route('wilayah.index')->with('success', 'Kabupaten berhasil ditambahkan.');
    }

    public function storeKecamatan(Request $request)
    {
        $request->validate([
            'id_kabupaten' => 'required|exists:m_kabupaten,id_kabupaten',
            'nama_kecamatan' => [
                'required',
                Rule::unique('m_kecamatan')->where(function ($query) use ($request) {
                    return $query->where('id_kabupaten', $request->id_kabupaten);
                }),
            ],
        ]);

        Kecamatan::create($request->only('nama_kecamatan', 'id_kabupaten'));
        return redirect()->route('wilayah.index', ['kabupaten_id' => $request->id_kabupaten])
            ->with('success', 'Kecamatan berhasil ditambahkan.');
    }
}
