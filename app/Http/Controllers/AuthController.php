<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:30', 'unique:users,npm'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validate['name'],
            'npm' => $validate['npm'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']), 
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole()->with('success', 'Registrasi anda berhasil!');

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login') -> with('success', 'Logout berhasil!.');
    }

    private function redirectByRole()
    {
        if(Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        } 

        return redirect()->route('home');
    }

}
