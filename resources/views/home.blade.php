@extends('layouts.home')

@section('title', 'Beranda')

@section('hero')
<div 
    x-data="{
        activeSlide: 0,
        slides: [
        {
                image: '{{ asset('images/p1.jpg') }}',
                title: 'Kualitas Terbaik',
                description: 'Kami menggunakan padi berkualitas untuk memproduksi beras yang terbaik.'
            },
            
            {
                image: '{{ asset('images/p1.jpg') }}',
                title: 'Mitra Tepercaya',
                description: 'MS Jaya adalah mitra industri andalan berbagai petani.'
            },

            {
                image: '{{ asset('images/p1.jpg') }}',
                title: 'Distribusi Tepat Waktu',
                description: 'Kami menjamin pengiriman barang Anda selalu tepat waktu.'
            },
        ],
        autoSlide() {
            setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            }, 5000);
        }
    }"
    x-init="autoSlide"
    class="relative h-[400px] md:h-[600px] w-full overflow-hidden"
>
    <!-- Gambar Slide -->
    <template x-for="(slide, index) in slides" :key="index">
        <div
            x-show="activeSlide === index"
            x-transition:enter="transition-opacity duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-cover bg-center"
            :style="'background-image: url(' + slide.image + ')'">
        </div>
    </template>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

    <!-- Konten Dinamis -->
    <div
    class="absolute z-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center px-4 sm:px-8 max-w-2xl w-full"
    x-transition:enter="transition ease-out duration-700"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
>
    <!-- Background semi-transparent dengan blur -->
    <div class="bg-black/40 backdrop-blur-sm rounded-lg p-6 sm:p-8">
        <h2 class="text-white text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md tracking-wide"
             x-text="slides[activeSlide].title"></h2>
        <p class="text-white text-sm sm:text-base md:text-lg mb-6 drop-shadow-sm leading-relaxed"
           x-text="slides[activeSlide].description"></p>
<!-- <a href="kontak"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 transition-all duration-300 px-6 py-3 rounded-full text-white text-sm sm:text-base shadow-lg hover:shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 8a2 2 0 00-2-2h-3.28a2 2 0 01-1.9-1.37L13.24 3H10.76l-.58 1.63A2 2 0 018.28 6H5a2 2 0 00-2 2v2h18V8zM3 10v6a2 2 0 002 2h14a2 2 0 002-2v-6H3z"/>
            </svg>
            Hubungi Kami
        </a>-->
    </div>
</div>

    <!-- Tombol Navigasi -->
    <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
        class="absolute z-30 left-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white p-3 rounded-full transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="activeSlide = (activeSlide + 1) % slides.length"
        class="absolute z-30 right-4 top-1/2 transform -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white p-3 rounded-full transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Indikator Slide -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                @click="activeSlide = index"
                :class="activeSlide === index ? 'bg-white' : 'bg-white/50'"
                class="w-3 h-3 rounded-full cursor-pointer transition-all duration-400"
            ></div>
        </template>
    </div>
</div>
@endsection





@section('content')
        <h2 class="text-4xl text-center md:text-5xl font-bold text-green-700">"Kualitas Terjaga, Kepercayaan Terbangun"</h2>
        <p class="mt-4 text-lg text-center text-gray-600">MS Jaya berkomitmen menyediakan beras terbaik dari proses yang modern dan terintegrasi.</p>

    <!-- Tentang Perusahaan -->
    <section class="bg-white rounded-2xl shadow-xl p-6 md:p-12 mt-10 hover:scale-[1.01] transform transition duration-500 ease-in-out" data-aos="fade-up">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div data-aos="fade-right">
                <img src="{{ asset('images/about-us.jpg') }}" alt="Pabrik MS Jaya" class="rounded-xl shadow-md w-full">
            </div>
            <div data-aos="fade-left">
                <h2 class="text-3xl font-extrabold text-green-800 mb-4">Tentang MS Jaya</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                        MS Jaya adalah perusahaan yang bergerak di bidang industri pengolahan beras, berdedikasi untuk menyediakan beras berkualitas tinggi bagi masyarakat Indonesia. Berdiri dengan komitmen terhadap mutu, efisiensi, dan keberlanjutan, MS Jaya mengelola seluruh proses produksi secara terpadu mulai dari pemilihan gabah unggulan, proses penggilingan modern, hingga distribusi beras ke berbagai wilayah.
                </p>
            </div>
        </div>
    </section>

    <!-- Nilai Perusahaan -->
    <section class="mt-20" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-12">Nilai-Nilai Perusahaan</h2>
        <div class="grid md:grid-cols-3 gap-8 text-center">
            @php
                $values = [
                    ['title' => 'Integritas', 'desc' => 'Menjunjung tinggi etika dan kejujuran dalam setiap aktivitas usaha.', 'icon' => 'integritas.png'],
                    ['title' => 'Inovasi', 'desc' => 'Terus berinovasi untuk menjawab kebutuhan industri dan pasar modern.', 'icon' => 'inovasi.png'],
                    ['title' => 'Komitmen', 'desc' => 'Memberikan hasil terbaik melalui pelayanan dan produk berkualitas.', 'icon' => 'komitmen.png'],
                ];
            @endphp
            @foreach($values as $index => $value)
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 ease-in-out" data-aos="fade-up" data-aos-delay="{{ 100 * $index }}">
                    <img src="{{ asset('images/' . $value['icon']) }}" alt="{{ $value['title'] }}" class="mx-auto mb-5 w-16 h-16">
                    <h3 class="text-xl font-semibold text-green-600">{{ $value['title'] }}</h3>
                    <p class="text-gray-600 mt-3">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Call to Action -->
<section class="mt-20 bg-green-700 text-white py-12 px-6 rounded-2xl shadow-xl text-center" data-aos="zoom-in">
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Bergabunglah Bersama MS Jaya</h2>
    <p class="text-lg md:text-xl mb-6 max-w-3xl mx-auto">Kami membuka kemitraan dan kerja sama dengan berbagai pihak untuk membangun masa depan yang lebih baik.</p>
    <a href="{{ route('register') }}" class="inline-block bg-white text-green-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">Daftar Sekarang</a>
</section>

<!-- Testimoni Pelanggan -->
<section class="mt-20" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center text-green-700 mb-12">Apa Kata Mereka?</h2>
    <div class="grid md:grid-cols-3 gap-8">
        @php
            $testimonials = [
                ['nama' => 'Budi Santoso', 'pesan' => 'MS Jaya selalu memberikan layanan terbaik dan produk berkualitas.', 'foto' => 'user1.jpg'],
                ['nama' => 'Dewi Lestari', 'pesan' => 'Pelayanan cepat, harga bersaing, dan sangat terpercaya!', 'foto' => 'user2.jpg'],
                ['nama' => 'Hendra Wijaya', 'pesan' => 'Kami sangat puas menjadi mitra MS Jaya.', 'foto' => 'user3.jpg'],
            ];
        @endphp

        @foreach($testimonials as $index => $t)
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ 100 * $index }}">
                <div class="flex items-center space-x-4 mb-4">
                    <img src="{{ asset('images/' . $t['foto']) }}" alt="{{ $t['nama'] }}" class="w-12 h-12 rounded-full object-cover">
                    <h4 class="font-semibold text-green-700">{{ $t['nama'] }}</h4>
                </div>
                <p class="text-gray-600 italic">“{{ $t['pesan'] }}”</p>
            </div>
        @endforeach
    </div>
</section>

    </section>
@endsection
