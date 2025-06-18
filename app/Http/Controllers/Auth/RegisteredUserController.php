<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'nama' => 'required', 'string', 'max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Pelanggan::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pelanggan = Pelanggan::create([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($pelanggan));

        Auth::login($pelanggan);

        return redirect()->route('dashboard');
    }
}
