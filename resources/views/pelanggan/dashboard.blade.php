<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl sm:text-2xl text-green-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi login -->
            <div class="bg-white p-4 sm:p-6 shadow rounded-lg">
                <p class="text-gray-800 text-base sm:text-lg font-semibold">
                    {{ __("Anda berhasil login!") }}
                </p>
            </div>

            <!-- Data Distribusi -->
            @if (isset($distribusi) && count($distribusi) > 0)
                <div class="bg-white p-4 sm:p-6 shadow rounded-lg">
                    <h3 class="text-green-700 font-bold text-lg sm:text-xl mb-4 sm:mb-6">Data Distribusi Anda</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-200 text-xs sm:text-sm text-left">
                            <thead class="bg-green-100 text-green-800">
                                <tr>
                                    <th class="px-3 sm:px-6 py-3 border">Tanggal</th>
                                    <th class="px-3 sm:px-6 py-3 border">Status</th>
                                    <th class="px-3 sm:px-6 py-3 border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($distribusi as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 border">
                                            {{ \Carbon\Carbon::parse($item->tanggal_distribusi)->format('d M Y') }}
                                        </td>
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 border">
                                            @if ($item->status === 'sudah')
                                                <span class="text-green-600 font-semibold">Terkonfirmasi</span>
                                            @else
                                                <span class="text-yellow-600 font-medium">Belum dikonfirmasi</span>
                                            @endif
                                        </td>
                                        <td class="px-3 sm:px-6 py-2 sm:py-4 border">
                                            @if ($item->status !== 'sudah')
                                                <form action="{{ route('distribusi.konfirmasi', $item->id_distribusi) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-green-600 text-black text-xs sm:text-sm font-semibold rounded shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs sm:text-sm text-gray-500 italic">Tidak tersedia</span>
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
                    <p class="text-sm sm:text-base">Tidak ada data distribusi ditemukan.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
