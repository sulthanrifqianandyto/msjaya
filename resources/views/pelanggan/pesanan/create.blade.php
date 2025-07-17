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

                    <!-- Dropdown Wilayah Lokal -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="provinsi_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <select id="provinsi" name="provinsi_id" class="form-select w-full" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinsis as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="kabupaten_id" class="block text-sm font-medium text-gray-700">Kabupaten</label>
                            <select id="kabupaten" name="kabupaten_id" class="form-select w-full" required>
                                <option value="">-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                        <div>
                            <label for="kecamatan_id" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan_id" class="form-select w-full" required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan_id" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                            <select id="kelurahan" name="kelurahan_id" class="form-select w-full" required>
                                <option value="">-- Pilih Kelurahan --</option>
                            </select>
                        </div>
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

    <!-- Script Dinamis Lokal -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const kabupatenSelect = document.getElementById("kabupaten");
            const kecamatanSelect = document.getElementById("kecamatan");
            const kelurahanSelect = document.getElementById("kelurahan");

            document.getElementById("provinsi").addEventListener("change", function () {
                fetch(`/wilayah/kabupaten?provinsi_id=${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                        data.forEach(k => {
                            kabupatenSelect.innerHTML += `<option value="${k.id}">${k.nama}</option>`;
                        });
                        kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                    });
            });

            kabupatenSelect.addEventListener("change", function () {
                fetch(`/wilayah/kecamatan?kabupaten_id=${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                        data.forEach(k => {
                            kecamatanSelect.innerHTML += `<option value="${k.id}">${k.nama}</option>`;
                        });
                        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                    });
            });

            kecamatanSelect.addEventListener("change", function () {
                fetch(`/wilayah/kelurahan?kecamatan_id=${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                        data.forEach(k => {
                            kelurahanSelect.innerHTML += `<option value="${k.id}">${k.nama}</option>`;
                        });
                    });
            });
        });
    </script>
</x-app-layout>
