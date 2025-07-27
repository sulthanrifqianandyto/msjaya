@extends('layouts.admin')

@section('title', 'Buat Pesanan')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-semibold text-green-800 mb-4">Buat Pesanan</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">

        @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('admin.pesanan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Pilih Pelanggan -->
            <div>
                <label for="pelanggan_id" class="block text-sm font-medium text-gray-700 mb-1">Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" required class="form-select w-full">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id_pelanggan }}">{{ $p->nama }} - {{ $p->email }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Item -->
            <div>
                <label for="item" class="block text-sm font-medium text-gray-700 mb-1">Nama Beras</label>
                <select name="item" id="item" required class="form-select w-full">
                    <option value="Beras Medium">Beras Medium</option>
                    <option value="Beras Premium">Beras Premium</option>
                    <option value="Beras Organik">Beras Organik</option>
                </select>
            </div>

            <!-- Kuantitas -->
            <div>
                <label for="kuantitas" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas (kg)</label>
                <input type="number" step="0.01" name="kuantitas" required class="form-input w-full" placeholder="Contoh: 100">
            </div>

            <!-- Wilayah -->
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

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required class="form-textarea w-full" placeholder="Contoh: Jl. Pahlawan No. 123, RT 05 RW 03"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                    Simpan Pesanan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS Wilayah -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsi = document.getElementById('provinsi');
    const kabupaten = document.getElementById('kabupaten');
    const kecamatan = document.getElementById('kecamatan');
    const kelurahan = document.getElementById('kelurahan');

    provinsi.addEventListener('change', function () {
        const provinsiId = this.value;
        kabupaten.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        kecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        if (provinsiId) {
            fetch(`/wilayah/kabupaten?provinsi_id=${provinsiId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        kabupaten.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                    });
                });
        }
    });

    kabupaten.addEventListener('change', function () {
        const kabupatenId = this.value;
        kecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        if (kabupatenId) {
            fetch(`/wilayah/kecamatan?kabupaten_id=${kabupatenId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        kecamatan.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                    });
                });
        }
    });

    kecamatan.addEventListener('change', function () {
        const kecamatanId = this.value;
        kelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        if (kecamatanId) {
            fetch(`/wilayah/kelurahan?kecamatan_id=${kecamatanId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        kelurahan.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                    });
                });
        }
    });
});
</script>
@endsection
