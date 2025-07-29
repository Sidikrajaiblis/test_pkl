@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Detail Kabupaten</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama Kabupaten</h5>
            <p class="card-text">{{ $kabupaten->nama_kabupaten }}</p>
        </div>
    </div>

    <a href="{{ route('kabupaten.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
