<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $data = Kecamatan::with('kabupaten')->when($search, function ($query) use ($search) {
            $query->where('nama_kecamatan', 'like', "%$search%");
        })->paginate(10);

        return view('kecamatan.index', compact('data'));
    }

    public function create()
    {
        $kabupaten = Kabupaten::all();
        return view('kecamatan.create', compact('kabupaten'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => [
                'required',
                Rule::unique('m_kecamatan')->where(function ($query) use ($request) {
                    return $query->where('id_kabupaten', $request->id_kabupaten);
                }),
            ],
            'id_kabupaten' => 'required|exists:m_kabupaten,id_kabupaten',
        ]);

        Kecamatan::create($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kabupaten = Kabupaten::all();
        return view('kecamatan.show', compact('kecamatan', 'kabupaten'));
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kabupaten = Kabupaten::all();
        return view('kecamatan.edit', compact('kecamatan', 'kabupaten'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kecamatan' => [
                'required',
                Rule::unique('m_kecamatan')->where(function ($query) use ($request) {
                    return $query->where('id_kabupaten', $request->id_kabupaten);
                })->ignore($id, 'id_kecamatan'),
            ],
            'id_kabupaten' => 'required|exists:m_kabupaten,id_kabupaten',
        ]);

        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        Kecamatan::destroy($id);
        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil dihapus.');
    }

    public function cetak()
    {
        $data = Kecamatan::all();
        $pdf = Pdf::loadView('kecamatan.cetak', compact('data'));
        return $pdf->download('laporan_kabupaten.pdf');
    }
}
