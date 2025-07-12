@extends('layouts.admin')

@section('content')
<div class="bg-green-100 p-6 rounded-xl shadow-md max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-green-900">📢 Notifikasi Terbaru</h2>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="text-sm bg-red-600 text-white px-2 py-1 rounded-full">
                {{ auth()->user()->unreadNotifications->count() }} belum dibaca
            </span>
        @endif
    </div>

    <div class="space-y-4">
        @forelse(auth()->user()->notifications as $notification)
            <a href="{{ $notification->data['link'] ?? '#' }}"
               class="block bg-white border border-gray-200 rounded-lg p-4 shadow hover:bg-gray-50 transition-all duration-200">
                <div class="flex justify-between items-start">
                    <div class="text-sm text-gray-800 leading-relaxed">
                        {!! $notification->data['message'] ?? 'Tidak ada isi notifikasi.' !!}
                    </div>
                    <div class="text-xs text-gray-500 whitespace-nowrap ml-4">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center text-gray-600 py-4">
                Belum ada notifikasi.
            </div>
        @endforelse
    </div>
</div>
@endsection
