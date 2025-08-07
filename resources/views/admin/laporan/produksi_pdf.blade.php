<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Produksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h2>Laporan Produksi</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah Produksi</th>
                <th>Tanggal Produksi</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($produksi as $item)
        <tr>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->stok }}</td>
            <td>{{ $item->tanggal_produksi }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
        </tr>
    @endforeach
</tbody>

    </table>

</body>
</html>
