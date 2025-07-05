<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl sm:text-2xl text-green-800 leading-tight">
            {{ __('Buat Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Form -->
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('pesanan.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="item" class="block text-sm font-medium text-gray-700 mb-1">Nama Beras</label>
                        <select name="item" id="item" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="Beras Medium">Beras Medium</option>
                            <option value="Beras Premium">Beras Premium</option>
                            <option value="Beras Organik">Beras Organik</option>
                        </select>
                    </div>

                    <div>
                        <label for="kuantitas" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas (kg)</label>
                        <input type="number" step="0.01" name="kuantitas" required
                               class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman</label>
                        <textarea name="alamat" rows="3" required
                                  class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                            Buat Pesanan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
