@extends('layouts.admin') {{-- Ganti sesuai layout kamu --}}
@section('title', 'Edit Bahan Baku')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-semibold mb-4">Edit Bahan Baku</h2>

    <form action="{{ route('admin.bahanbaku.update', $bahanbaku->id_bahan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_bahan">Nama Bahan</label>
            <input type="text" name="nama_bahan" value="{{ old('nama_bahan', $bahanbaku->nama_bahan) }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label for="stok">Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $bahanbaku->stok) }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label for="tanggal_masuk">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $bahanbaku->tanggal_masuk) }}" class="form-input w-full">
        </div>

        {{-- Provinsi --}}
        <div class="mb-4">
            <label for="provinsi_id">Provinsi</label>
            <select name="provinsi_id" id="provinsi" class="form-select w-full">
                <option value="">Pilih Provinsi</option>
                @foreach ($provinsis as $prov)
                    <option value="{{ $prov->id }}" {{ $bahanbaku->provinsi_id == $prov->id ? 'selected' : '' }}>
                        {{ $prov->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kabupaten --}}
        <div class="mb-4">
            <label for="kabupaten_id">Kabupaten</label>
            <select name="kabupaten_id" id="kabupaten" class="form-select w-full">
                <option value="">Pilih Kabupaten</option>
                @foreach ($kabupatens as $kab)
                    <option value="{{ $kab->id }}" {{ $bahanbaku->kabupaten_id == $kab->id ? 'selected' : '' }}>
                        {{ $kab->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kecamatan --}}
        <div class="mb-4">
            <label for="kecamatan_id">Kecamatan</label>
            <select name="kecamatan_id" id="kecamatan" class="form-select w-full">
                <option value="">Pilih Kecamatan</option>
                @foreach ($kecamatans as $kec)
                    <option value="{{ $kec->id }}" {{ $bahanbaku->kecamatan_id == $kec->id ? 'selected' : '' }}>
                        {{ $kec->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kelurahan --}}
        <div class="mb-4">
            <label for="kelurahan_id">Kelurahan</label>
            <select name="kelurahan_id" id="kelurahan" class="form-select w-full">
                <option value="">Pilih Kelurahan</option>
                @foreach ($kelurahans as $kel)
                    <option value="{{ $kel->id }}" {{ $bahanbaku->kelurahan_id == $kel->id ? 'selected' : '' }}>
                        {{ $kel->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsi = document.getElementById('provinsi');
    const kabupaten = document.getElementById('kabupaten');
    const kecamatan = document.getElementById('kecamatan');
    const kelurahan = document.getElementById('kelurahan');

    provinsi.addEventListener('change', function () {
        fetch(`/api/wilayah/kabupaten/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kabupaten.innerHTML = '<option value="">Pilih Kabupaten</option>';
                data.forEach(item => {
                    kabupaten.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                });
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
            });
    });

    kabupaten.addEventListener('change', function () {
        fetch(`/api/wilayah/kecamatan/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                data.forEach(item => {
                    kecamatan.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                });
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
            });
    });

    kecamatan.addEventListener('change', function () {
        fetch(`/api/wilayah/kelurahan/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
                data.forEach(item => {
                    kelurahan.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                });
            });
    });
});
</script>

@endsection
