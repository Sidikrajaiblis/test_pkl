@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Kabupaten</h3>

    {{-- Search --}}
    <form method="GET" action="{{ route('kabupaten.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari kabupaten...">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Button Tambah & Cetak --}}
    <div class="mb-3">
        <a href="{{ route('kabupaten.create') }}" class="btn btn-success">+ Tambah Kabupaten</a>
        <a href="{{ route('kabupaten.cetak') }}" class="btn btn-outline-secondary">Cetak PDF</a>
    </div>
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
    @endif

    {{-- Table --}}
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Kabupaten</th>
                <th>Jumlah kecamatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $kabupaten)
            <tr>
                <td>{{ $data->firstItem() + $i }}</td>
                <td>{{ $kabupaten->nama_kabupaten }}</td>
                <td>{{ $kabupaten->kecamatan_count }} Kecamatan</td>
                <td>
                    <a href="{{ route('kabupaten.edit', $kabupaten->id_kabupaten) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ route('kabupaten.show', $kabupaten->id_kabupaten) }}" class="btn btn-sm btn-warning">Show</a>
                    <form action="{{ route('kabupaten.destroy', $kabupaten->id_kabupaten) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin mau hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $data->withQueryString()->links() }}
    </div>
</div>
@endsection