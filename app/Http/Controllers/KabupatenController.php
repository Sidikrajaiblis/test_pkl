<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KabupatenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $data = Kabupaten::withCount('kecamatan') // ⬅️ ini ditambahkan
            ->when($search, function ($query) use ($search) {
                $query->where('nama_kabupaten', 'like', "%$search%");
            })
            ->paginate(10);

        return view('kabupaten.index', compact('data'));
    }


    public function create()
    {
        return view('kabupaten.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kabupaten' => 'required|unique:m_kabupaten,nama_kabupaten',
        ]);

        Kabupaten::create($request->all());

        return redirect()->route('kabupaten.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        return view('kabupaten.show', compact('kabupaten'));
    }

    public function edit($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        return view('kabupaten.edit', compact('kabupaten'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kabupaten' => 'required|unique:m_kabupaten,nama_kabupaten,' . $id . ',id_kabupaten',
        ]);

        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->update($request->all());

        return redirect()->route('kabupaten.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        Kabupaten::destroy($id);
        return redirect()->route('kabupaten.index')->with('success', 'Data berhasil dihapus.');
    }

    public function cetak()
    {
        $data = Kabupaten::all();
        $pdf = Pdf::loadView('kabupaten.cetak', compact('data'));
        return $pdf->download('laporan_kabupaten.pdf');
    }
}
