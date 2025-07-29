@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Kecamatan</h3>

    <form action="{{ route('kecamatan.update', $kecamatan->id_kecamatan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
            <input type="text" name="nama_kecamatan" class="form-control"
                value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" required>
            @error('nama_kecamatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="id_kabupaten" class="form-label">Kabupaten</label>
            <select name="id_kabupaten" class="form-select" required>
                <option value="">-- Pilih Kabupaten --</option>
                @foreach($kabupaten as $kab)
                    <option value="{{ $kab->id_kabupaten }}"
                        {{ $kecamatan->id_kabupaten == $kab->id_kabupaten ? 'selected' : '' }}>
                        {{ $kab->nama_kabupaten }}
                    </option>
                @endforeach
            </select>
            @error('id_kabupaten') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kecamatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
