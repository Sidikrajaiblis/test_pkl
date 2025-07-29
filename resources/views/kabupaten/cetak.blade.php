<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kabupaten</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h4>Laporan Data Kabupaten</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kabupaten</th>
                <th>Jumlah Kecamatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $d)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $d->nama_kabupaten }}</td>
                <td>{{ $d->kecamatan_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
