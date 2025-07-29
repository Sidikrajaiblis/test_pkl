@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Data Kecamatan</h3>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search --}}
    <form method="GET" action="{{ route('kecamatan.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari kecamatan...">
            <button class="btn btn-primary">Cari</button>
        </div>
    </form>

    <a href="{{ route('kecamatan.create') }}" class="btn btn-success">+ Tambah Kecamatan</a>
    <a href="{{ route('kecamatan.cetak') }}" class="btn btn-outline-secondary">Cetak PDF</a>

    {{-- Tabel --}}
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Kecamatan</th>
                <th>Kabupaten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $kecamatan)
                <tr>
                    <td>{{ $data->firstItem() + $i }}</td>
                    <td>{{ $kecamatan->nama_kecamatan }}</td>
                    <td>{{ $kecamatan->kabupaten->nama_kabupaten }}</td>
                    <td>
                        <a href="{{ route('kecamatan.edit', $kecamatan->id_kecamatan) }}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{ route('kecamatan.show', $kecamatan->id_kecamatan) }}" class="btn btn-sm btn-warning">show</a>
                        <form action="{{ route('kecamatan.destroy', $kecamatan->id_kecamatan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $data->withQueryString()->links() }}
    </div>
</div>
@endsection
