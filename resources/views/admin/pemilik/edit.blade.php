@extends('layouts.admin')

@section('title', 'Edit Pemilik')

@section('content')
    <h2 style="margin-bottom: 1rem; color: #14532D;">Edit Pemilik</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.pemilik.update', ['pemilik' => $pemilik->id_admin]) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="name">Nama:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $pemilik->name) }}" required style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" value="{{ old('email', $pemilik->email) }}" required style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password">Password Baru (kosongkan jika tidak diubah):</label><br>
            <input type="password" name="password" id="password" style="width: 100%; padding: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password_confirmation">Konfirmasi Password Baru:</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" style="width: 100%; padding: 0.5rem;">
        </div>

        <button type="submit" style="background-color: #A8FF3E; color: #111111; padding: 0.5rem 1rem; border-radius: 6px; font-weight: bold;">
            Simpan Perubahan
        </button>
    </form>
@endsection
