@extends('layouts.login_admin')

@section('title', 'Masuk Admin')

@section('content')
    <h2>Login Admin</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>

        <button type="submit">Masuk</button>
    </form>

    <div class="footer-text">
        &copy; {{ date('Y') }} Admin Panel. All rights reserved.
    </div>
@endsection
