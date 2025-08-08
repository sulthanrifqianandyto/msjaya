<!DOCTYPE html>
<html>
<head>
    <title>Laporan Distribusi</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #333; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Laporan Distribusi</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal Distribusi</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distribusis as $item)
                <tr>
                    <td>{{ $item->tanggal_distribusi }}</td>
                    <td>{{ $item->pesanan->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $item->pesanan->alamat ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
