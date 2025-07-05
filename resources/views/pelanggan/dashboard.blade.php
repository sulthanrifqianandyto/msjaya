<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl sm:text-2xl text-green-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        @if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded shadow mb-4 text-sm sm:text-base">
        {{ session('success') }}
    </div>
@endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi login -->
            <div class="bg-white p-4 sm:p-6 shadow rounded-lg">
                <p class="text-gray-800 text-base sm:text-lg font-semibold">
                    {{ __("Anda berhasil login!") }}
                </p>
            </div>

            <!-- Tombol Buat Pesanan -->
            <div class="bg-white p-4 sm:p-6 shadow rounded-lg">
                <a href="{{ route('pesanan.create') }}"
                   class="inline-block px-5 py-3 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow transition duration-200">
                    + Buat Pesanan Baru
                </a>
            </div>

            <!-- Data Pesanan -->
            @if (isset($pesanan) && count($pesanan) > 0)
                <div class="bg-white p-4 sm:p-6 shadow rounded-lg">
                    <h3 class="text-green-700 font-bold text-lg sm:text-xl mb-4 sm:mb-6">Data Pesanan Anda</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-200 text-xs sm:text-sm text-left">
                            <thead class="bg-green-100 text-green-800">
                                <tr>
                                    <th class="px-3 sm:px-6 py-3 border">Tanggal</th>
                                    <th class="px-3 sm:px-6 py-3 border">Item</th>
                                    <th class="px-3 sm:px-6 py-3 border">Kuantitas (kg)</th>
                                    <th class="px-3 sm:px-6 py-3 border">Status</th>
                                    <th class="px-3 sm:px-6 py-3 border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($pesanan as $item)
                                    <tr class="hover:bg-gray-50 transition">
    <td class="px-3 sm:px-6 py-2 sm:py-4 border">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
    <td class="px-3 sm:px-6 py-2 sm:py-4 border">{{ $item->item }}</td>
    <td class="px-3 sm:px-6 py-2 sm:py-4 border">{{ number_format($item->kuantitas, 2) }} kg</td>
    <td class="px-3 sm:px-6 py-2 sm:py-4 border">
        @php
            $statusColor = match($item->status) {
                'menunggu' => 'text-yellow-600',
                'disiapkan' => 'text-blue-600',
                'dikirim' => 'text-purple-600',
                'diterima' => 'text-green-600',
                default => 'text-gray-600'
            };
        @endphp
        <span class="font-semibold {{ $statusColor }}">{{ ucfirst($item->status) }}</span>
    </td>
    <td class="px-3 sm:px-6 py-2 sm:py-4 border">
        @if ($item->status === 'dikirim')
            <form action="{{ route('pesanan.konfirmasi', $item->id_pesanan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex items-center gap-2">
        <input type="file" name="bukti_foto" accept="image/*" required
            class="text-xs text-gray-700 border rounded px-2 py-1 file:mr-2 file:border-0 file:py-1 file:px-3 file:bg-green-100 file:text-green-800">
        <button type="submit"
                class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded shadow hover:bg-green-700 transition">
            Konfirmasi
        </button>
    </div>
</form>

        @else
            <button class="px-3 py-1 bg-gray-300 text-gray-600 text-xs font-semibold rounded cursor-not-allowed" disabled>
    {{ $item->status === 'diterima' ? 'Pesanan Selesai' : 'Belum Bisa Dikonfirmasi' }}
</button>
        @endif
    </td>
</tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white p-4 sm:p-6 shadow rounded-lg text-center text-gray-600">
                    <p class="text-sm sm:text-base">Anda belum memiliki pesanan.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
