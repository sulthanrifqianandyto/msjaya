@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Data Pesanan</h2>

@if (session('success'))
    <div style="background-color: #DFF2BF; color: #4F8A10; padding: 1rem; margin-bottom: 1rem; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

<div style="overflow-x:auto;">
    <table style="width: 100%; border-collapse: collapse; background-color: #FAF9F6; color: #111111;">
        <thead style="background-color: #14532D; color: white;">
            <tr>
                <th style="padding: 0.75rem; text-align: left;">Tanggal</th>
                <th style="padding: 0.75rem; text-align: left;">Pelanggan</th>
                <th style="padding: 0.75rem; text-align: left;">Item</th>
                <th style="padding: 0.75rem; text-align: left;">Kuantitas</th>
                <th style="padding: 0.75rem; text-align: left;">Alamat</th>
                <th style="padding: 0.75rem; text-align: left;">Status</th>
                <th style="padding: 0.75rem; text-align: left;">Aksi</th>
                <th style="padding: 0.75rem; text-align: left;">Bukti</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanan as $p)
                <tr style="border-bottom: 1px solid #A3B18A;">
                    <td style="padding: 0.75rem;">{{ $p->created_at->format('d M Y') }}</td>
                    <td style="padding: 0.75rem;">{{ $p->pelanggan->nama ?? '-' }}</td>
                    <td style="padding: 0.75rem;">{{ $p->item }}</td>
                    <td style="padding: 0.75rem;">{{ $p->kuantitas }} kg</td>
                    <td style="padding: 0.75rem;">{{ $p->alamat }}</td>
                    <td style="padding: 0.75rem; text-transform: capitalize;">{{ $p->status }}</td>
                    <td style="padding: 0.75rem;">
                        @if ($p->status === 'menunggu')
                            <form method="POST" action="{{ route('admin.pesanan.konfirmasi', $p->id_pesanan) }}" style="display:inline;">
                                @csrf
                                <button style="background-color: #FFD54F; color: #000; padding: 0.4rem 0.8rem; border-radius: 4px; font-weight: bold; cursor: pointer;">
                                    Konfirmasi
                                </button>
                            </form>
                        @elseif ($p->status === 'disiapkan')
                            <form method="POST" action="{{ route('admin.pesanan.kirim', $p->id_pesanan) }}" style="display:inline;">
                                @csrf
                                <button style="background-color: #42A5F5; color: white; padding: 0.4rem 0.8rem; border-radius: 4px; font-weight: bold; cursor: pointer;">
                                    Kirim
                                </button>
                            </form>
                        @else
                            <span style="color: #888; font-style: italic;">Tidak tersedia</span>
                        @endif
                    </td>
                    <td style="padding: 0.75rem;">
                        @if ($p->bukti_foto)
                            <a href="{{ asset('storage/' . $p->bukti_foto) }}" target="_blank" style="color: #1E88E5; text-decoration: underline;">Lihat</a>
                        @else
                            <span style="color: #888;">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding: 1rem; text-align: center; color: #666;">Tidak ada data pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
