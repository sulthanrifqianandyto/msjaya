@extends('layouts.app')

@section('title', 'Buat Pesanan')

@section('content')
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <h2 class="font-semibold text-xl sm:text-2xl text-green-800 leading-tight mb-4">
            {{ __('Buat Pesanan') }}
        </h2>

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
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#provinsi').on('change', function () {
            let provinsiID = $(this).val();
            $('#kabupaten').empty().append('<option>Loading...</option>');
            $('#kecamatan, #kelurahan').empty().append('<option>-- Pilih --</option>');
            if (provinsiID) {
                $.get('{{ url("wilayah/kabupaten") }}?provinsi_id=' + provinsiID, function (data) {

                    $('#kabupaten').empty().append('<option value="">-- Pilih Kabupaten --</option>');
                    $.each(data, function (key, value) {
                        $('#kabupaten').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    });
                });
            }
        });

        $('#kabupaten').on('change', function () {
            let kabupatenID = $(this).val();
            $('#kecamatan').empty().append('<option>Loading...</option>');
            $('#kelurahan').empty().append('<option>-- Pilih --</option>');
            if (kabupatenID) {
                $.get('{{ url("wilayah/kecamatan") }}?kabupaten_id=' + kabupatenID, function (data) {
                    $('#kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
                    $.each(data, function (key, value) {
                        $('#kecamatan').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    });
                });
            }
        });

        $('#kecamatan').on('change', function () {
            let kecamatanID = $(this).val();
            $('#kelurahan').empty().append('<option>Loading...</option>');
            if (kecamatanID) {
                $.get('{{ url("wilayah/kelurahan") }}?kecamatan_id=' + kecamatanID, function (data) {
                    $('#kelurahan').empty().append('<option value="">-- Pilih Kelurahan --</option>');
                    $.each(data, function (key, value) {
                        $('#kelurahan').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    });
                });
            }
        });
    });
</script>



