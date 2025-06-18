@extends('layouts.home')

@section('title', 'Profil Perusahaan')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 md:p-10">
        {{-- Logo dan Nama --}}
        <div class="flex flex-col items-center text-center mb-10">
            <img src="{{ asset('images/logo.png') }}" alt="Logo MS Jaya" class="w-28 h-28 mb-4">
            <h1 class="text-4xl font-bold text-orange-700">MS Jaya</h1>
            <p class="text-gray-600 mt-2 max-w-xl">
                MS Jaya adalah solusi terpercaya dalam bidang produksi material bangunan dan jasa konstruksi. Kami hadir untuk mendukung pertumbuhan bisnis modern Anda.
            </p>
        </div>

        {{-- Visi & Misi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <div>
                <h2 class="text-xl font-semibold text-orange-600">Visi</h2>
                <p class="text-gray-700 mt-2">
                    Menjadi perusahaan terdepan dalam memberikan solusi inovatif dan berkelanjutan di bidang konstruksi dan material bangunan.
                </p>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-orange-600">Misi</h2>
                <ul class="list-disc list-inside text-gray-700 mt-2 space-y-1">
                    <li>Memberikan layanan berkualitas tinggi dan terpercaya</li>
                    <li>Meningkatkan kompetensi sumber daya manusia</li>
                    <li>Berinovasi dalam teknologi dan metode kerja</li>
                </ul>
            </div>
        </div>

        {{-- Kontak dan Lokasi --}}
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-orange-600 mb-4">Hubungi Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-700 mb-2"><strong>Alamat:</strong> G3HF+P9G Pabrik MS Jaya, Sukamelang, Kec. Kroya, Kabupaten Indramayu, Jawa Barat 45265</p>
                    <p class="text-gray-700 mb-2"><strong>Email:</strong> info@msjaya.co.id</p>
                    <p class="text-gray-700 mb-2"><strong>Telepon:</strong> (021) 1234-5678</p>
                    <a href="mailto:info@msjaya.co.id" class="inline-block mt-4 bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition">
                        Hubungi Kami
                    </a>
                </div>
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.401805073247!2d108.07088197413488!3d-6.470679563265438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ecb4018ec58d5%3A0x234553b7ce1d2719!2sCV.%20Makmur%20Sejahtera%20MS!5e0!3m2!1sid!2sid!4v1746388337438!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
