<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Kecamatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Laporan Data Kecamatan</h2>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Kecamatan</th>
                <th>id Kabupaten</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $kec)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $kec->nama_kecamatan }}</td>
                <td>{{ $kec->id_kabupaten }}</td>
                <td>{{ \Carbon\Carbon::parse($kec->created_at)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
