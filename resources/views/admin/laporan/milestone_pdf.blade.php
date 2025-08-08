<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Target Produksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Target Produksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Target</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Target Produksi</th>
                <th>Total Produksi</th>
                <th>Pencapaian (%)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($milestones as $i => $milestone)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $milestone->nama }}</td>
                    <td>{{ $milestone->tanggal_mulai }}</td>
                    <td>{{ $milestone->tanggal_selesai }}</td>
                    <td>{{ $milestone->target }}</td>
                    <td>{{ $milestone->total_produksi }}</td>
                    <td>{{ $milestone->pencapaian }}%</td>
                    <td>{{ $milestone->status_lengkap }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
