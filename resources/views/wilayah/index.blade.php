@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Kecamatan Berdasarkan Kabupaten</h3>

    {{-- Dropdown Pilih Kabupaten --}}
    <form method="GET" action="{{ route('wilayah.index') }}" class="mb-4">
        <div class="input-group">
            <select name="kabupaten_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Tampilkan Semua Kabupaten --</option>
                @foreach ($kabupaten as $k)
                    <option value="{{ $k->id_kabupaten }}" {{ request('kabupaten_id') == $k->id_kabupaten ? 'selected' : '' }}>
                        {{ $k->nama_kabupaten }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Tampilkan Kecamatan --}}
    @if (count($kecamatan) > 0)
        <h5>
            Daftar Kecamatan 
            @if ($selectedKabupaten)
                di Kabupaten <strong>{{ $kabupaten->firstWhere('id_kabupaten', $selectedKabupaten)->nama_kabupaten }}</strong>
            @else
                dari Seluruh Kabupaten
            @endif
        </h5>

        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kecamatan as $i => $kc)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $kc->kabupaten->nama_kabupaten }}</td>
                    <td>{{ $kc->nama_kecamatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($selectedKabupaten)
        <div class="alert alert-warning">Belum ada kecamatan untuk kabupaten ini.</div>
    @endif
</div>
@endsection
