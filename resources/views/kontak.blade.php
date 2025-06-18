@extends('layouts.home')

@section('title', 'Kontak Kami')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 md:p-10">
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-green-700">Hubungi MS Jaya</h1>
        <p class="mt-4 text-gray-600 max-w-xl mx-auto">
            Kami siap membantu Anda. Silakan hubungi kami melalui informasi di bawah atau kirim pesan melalui email.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <div class="space-y-3 text-gray-700">
            <p><strong>Alamat:</strong><br> G3HF+P9G Pabrik MS Jaya, Sukamelang, Kec. Kroya, Kabupaten Indramayu, Jawa Barat 45265</p>
            <p><strong>Email:</strong><br> info@msjaya.co.id</p>
            <p><strong>Telepon:</strong><br> (021) 1234-5678</p>
            <a href="mailto:info@msjaya.co.id" class="inline-block mt-4 bg-yellow-500 text-white px-5 py-2 rounded hover:bg-yellow-600 transition">Kirim Email</a>
        </div>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.410541788629!2d108.06997527413473!3d-6.469566163254763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ecb4018ec58d5%3A0x234553b7ce1d2719!2sCV.%20Makmur%20Sejahtera%20MS!5e0!3m2!1sen!2sus!4v1746990022402!5m2!1sen!2sus" width="100%" height="300" style="border:0;" allowfullscreen loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection
