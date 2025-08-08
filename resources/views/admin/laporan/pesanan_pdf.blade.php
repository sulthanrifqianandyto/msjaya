<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #111111;
        }
        h2 {
            color: #14532D;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #FAF9F6;
        }
        th, td {
            border: 1px solid #A3B18A;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #14532D;
            color: white;
        }
    </style>
</head>
<body>

<h2>Laporan Pesanan</h2>

<table>
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Item</th>
            <th>Kuantitas</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Tanggal Pesanan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pesanan as $p)
            <tr>
                <td>{{ $p->id_pesanan }}</td>
                <td>{{ $p->pelanggan->nama ?? '-' }}</td>
                <td>{{ $p->item }}</td>
                <td>{{ $p->kuantitas }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>{{ $p->created_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data pesanan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
