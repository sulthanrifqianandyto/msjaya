@extends('layouts.home')

@section('title', 'Tentang Kami')

@section('content')
<!-- Section Background -->
<section class="relative overflow-hidden">
    <!-- Background Image -->
    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-12">
    
        <!-- Judul dan Deskripsi -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h1 class="text-4xl font-bold text-green-700">Tentang MS Jaya</h1>
            <p class="mt-6 text-gray-700 text-lg leading-relaxed max-w-3xl mx-auto">
                MS Jaya adalah perusahaan yang bergerak di bidang industri pengolahan beras, berdedikasi untuk menyediakan beras berkualitas tinggi bagi masyarakat Indonesia. Berdiri dengan komitmen terhadap mutu, efisiensi, dan keberlanjutan, MS Jaya mengelola seluruh proses produksi secara terpadu mulai dari pemilihan gabah unggulan, proses penggilingan modern, hingga distribusi beras ke berbagai wilayah.<br><br>
                Didukung oleh teknologi mesin penggilingan yang mutakhir dan tenaga kerja berpengalaman, MS Jaya mampu menjaga standar kebersihan, kualitas, dan ketersediaan produk secara konsisten. Kami percaya bahwa kualitas beras yang baik bukan hanya menciptakan kepuasan pelanggan, tetapi juga berkontribusi terhadap ketahanan pangan nasional.<br><br>
                Dengan semangat untuk terus berkembang, MS Jaya berkomitmen menjadi mitra terpercaya dalam industri pangan, menjalin hubungan jangka panjang dengan petani lokal, distributor, dan konsumen di seluruh Indonesia.
            </p>
        </div>

        <!-- Nilai & Gambar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Nilai-nilai Kami -->
            <div data-aos="fade-right">
                <h2 class="text-2xl font-semibold text-green-600 mb-4">Nilai-nilai Kami</h2>
                <ul class="space-y-4 text-gray-700 text-base leading-relaxed">
                    <li class="flex items-start">
                        <span class="text-green-500 mt-1">&#x2022;</span>
                        <span class="ml-3">Integritas dalam setiap tindakan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-500 mt-1">&#x2022;</span>
                        <span class="ml-3">Kualitas produk dan layanan terbaik</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-500 mt-1">&#x2022;</span>
                        <span class="ml-3">Inovasi untuk keberlanjutan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-500 mt-1">&#x2022;</span>
                        <span class="ml-3">Fokus pada kepuasan pelanggan</span>
                    </li>
                </ul>
            </div>

            <!-- Gambar -->
            <div data-aos="fade-left">
                <img src="{{ asset('images/pabrik.jpg') }}" alt="Tentang MS Jaya" class="rounded-xl shadow-lg w-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan di akhir body -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<script>
    AOS.init();
</script>


@endsection
