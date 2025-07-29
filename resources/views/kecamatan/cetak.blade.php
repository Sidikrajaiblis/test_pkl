<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kecamatan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h4>Laporan Data Kecamatan</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kabupaten</th>
                <th>Nama Kecamatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $kc)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $kc->kabupaten->nama_kabupaten }}</td>
                <td>{{ $kc->nama_kecamatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
