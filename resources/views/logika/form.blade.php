@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Logika Penilaian (Kurang, Lebih, Sama dengan)</h4>

    <form action="{{ route('logika.proses') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nilai" class="form-label">Masukkan Nilai:</label>
            <input type="number" name="nilai" id="nilai" class="form-control" required
                value="{{ old('nilai', $nilai ?? '') }}">
            @error('nilai') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cek Peringkat</button>
    </form>

    @isset($peringkat)
        <div class="alert alert-info mt-4">
            Nilai: <strong>{{ $nilai }}</strong><br>
            Peringkat: <strong>{{ $peringkat }}</strong>
        </div>
    @endisset
</div>
@endsection
