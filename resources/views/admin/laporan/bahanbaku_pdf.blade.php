<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bahan Baku</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
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

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Bahan Baku</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Stok</th>
                <th>Tanggal Masuk</th>
                <th>Alamat Suplier</th>
                <th>Wilayah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanBakus as $bahan)
                <tr>
                    <td>{{ $bahan->nama_bahan }}</td>
                    <td>{{ number_format($bahan->stok, 2) }}</td>
                    <td>{{ $bahan->tanggal_masuk }}</td>
                    <td>
                        {{ $bahan->alamat_suplier }}
                    </td>
                    <td>
                        {{ $bahan->kelurahan->nama ?? '-' }},
                        {{ $bahan->kecamatan->nama ?? '-' }},
                        {{ $bahan->kabupaten->nama ?? '-' }},
                        {{ $bahan->provinsi->nama ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
