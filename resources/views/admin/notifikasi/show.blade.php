@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <h2 class="text-xl font-semibold text-green-800 mb-4">Detail Pesanan</h2>

    <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div>
            <strong>Nama Pelanggan:</strong>
            <p>{{ $pesanan->pelanggan->nama }}</p>
        </div>

        <div>
            <strong>Tanggal Pesanan:</strong>
            <p>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y H:i') }}</p>
        </div>

        <div>
            <strong>Item:</strong>
            <p>{{ $pesanan->item }}</p>
        </div>

        <div>
            <strong>Kuantitas:</strong>
            <p>{{ number_format($pesanan->kuantitas, 2) }} kg</p>
        </div>

        <div>
            <strong>Alamat Pengiriman:</strong>
            <p>{{ $pesanan->alamat }}</p>
        </div>

        <div>
            <strong>Status:</strong>
            <span class="font-semibold text-{{ 
                $pesanan->status === 'menunggu' ? 'yellow-600' :
                ($pesanan->status === 'disiapkan' ? 'blue-600' :
                ($pesanan->status === 'dikirim' ? 'purple-600' : 'green-600')) 
            }}">
                {{ ucfirst($pesanan->status) }}
            </span>
        </div>

        @if ($pesanan->bukti_foto)
            <div>
                <strong>Bukti Penerimaan:</strong><br>
                <img src="{{ asset('storage/' . $pesanan->bukti_foto) }}" alt="Bukti" class="w-60 rounded shadow">
            </div>
        @endif
    </div>

    <a href="{{ route('admin.pesanan.index') }}"
       class="inline-block mt-6 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm rounded shadow">
        ← Kembali ke Daftar Pesanan
    </a>
@endsection
