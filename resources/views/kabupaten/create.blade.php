@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Kabupaten</h3>

    <form action="{{ route('kabupaten.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_kabupaten" class="form-label">Nama Kabupaten</label>
            <input type="text" name="nama_kabupaten" id="nama_kabupaten" class="form-control" required
                value="{{ old('nama_kabupaten') }}">
            @error('nama_kabupaten')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kabupaten.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection