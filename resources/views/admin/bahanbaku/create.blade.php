@extends('layouts.admin')

@section('title', 'Tambah Bahan Baku')

@section('content')
<h2 style="margin-bottom: 1rem; color: #14532D;">Tambah Bahan Baku</h2>

<div style="background-color: #FAF9F6; padding: 2rem; border-radius: 12px; max-width: 700px;">
    <form action="{{ route('admin.bahanbaku.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Nama Bahan</label>
            <input type="text" name="nama_bahan" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Stok (kg)</label>
            <div style="display: flex; align-items: center;">
                <input type="number" name="stok" step="0.01" min="0" class="form-control"
                       style="flex: 1; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px 0 0 6px; background-color: #ffffff;" required>
                <span style="background-color: #14532D; color: #fff; padding: 0.5rem 1rem; border-radius: 0 6px 6px 0;">kg</span>
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display:block; font-weight: bold; color: #111111;">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control"
                   style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px; background-color: #ffffff;" required>
        </div>

        <div style="margin-bottom: 1.5rem;">
    <label style="display:block; font-weight: bold; color: #111111;">Alamat Suplier</label>

    <select name="provinsi_id" id="provinsi" class="form-control" required
            style="width: 100%; margin-bottom: 0.5rem; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;">
        <option value="">Pilih Provinsi</option>
        @foreach ($provinsis as $provinsi)
            <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
        @endforeach
    </select>

    <select name="kabupaten_id" id="kabupaten" class="form-control" required
            style="width: 100%; margin-bottom: 0.5rem; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;">
        <option value="">Pilih Kabupaten</option>
    </select>

    <select name="kecamatan_id" id="kecamatan" class="form-control" required
            style="width: 100%; margin-bottom: 0.5rem; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;">
        <option value="">Pilih Kecamatan</option>
    </select>

    <select name="kelurahan_id" id="kelurahan" class="form-control" required
            style="width: 100%; padding: 0.5rem; border: 1px solid #A3B18A; border-radius: 6px;">
        <option value="">Pilih Kelurahan/Desa</option>
    </select>
</div>

        <button type="submit"
                style="background-color: #A8FF3E; color: #111111; padding: 0.6rem 1.5rem; border: none; border-radius: 6px; font-weight: bold;">
            Simpan
        </button>

       <script>
document.getElementById('provinsi').addEventListener('change', function () {
    fetch(`/admin/wilayah/kabupaten?provinsi_id=${this.value}`)
        .then(res => res.json())
        .then(data => {
            let kabupaten = document.getElementById('kabupaten');
            kabupaten.innerHTML = '<option value="">Pilih Kabupaten</option>';
            data.forEach(item => kabupaten.innerHTML += `<option value="${item.id}">${item.nama}</option>`);

            // Reset kecamatan & kelurahan
            document.getElementById('kecamatan').innerHTML = '<option value="">Pilih Kecamatan</option>';
            document.getElementById('kelurahan').innerHTML = '<option value="">Pilih Kelurahan</option>';
        });
});

document.getElementById('kabupaten').addEventListener('change', function () {
    fetch(`/admin/wilayah/kecamatan?kabupaten_id=${this.value}`)
        .then(res => res.json())
        .then(data => {
            let kecamatan = document.getElementById('kecamatan');
            kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
            data.forEach(item => kecamatan.innerHTML += `<option value="${item.id}">${item.nama}</option>`);

            // Reset kelurahan
            document.getElementById('kelurahan').innerHTML = '<option value="">Pilih Kelurahan</option>';
        });
});

document.getElementById('kecamatan').addEventListener('change', function () {
    fetch(`/admin/wilayah/kelurahan?kecamatan_id=${this.value}`)
        .then(res => res.json())
        .then(data => {
            let kelurahan = document.getElementById('kelurahan');
            kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
            data.forEach(item => kelurahan.innerHTML += `<option value="${item.id}">${item.nama}</option>`);
        });
});
</script>


    </form>
</div>
@endsection
