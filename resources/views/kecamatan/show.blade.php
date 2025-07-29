@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Detail Kecamatan</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama Kecamatan</h5>
            <p class="card-text">{{ $kecamatan->nama_kecamatan }}</p>

            <h5 class="card-title">Kabupaten</h5>
            <p class="card-text">{{ $kecamatan->kabupaten->nama_kabupaten }}</p>
        </div>
    </div>

    <a href="{{ route('kecamatan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
