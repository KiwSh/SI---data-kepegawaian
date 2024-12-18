<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string', // Validasi username
            'password' => 'required|string',
        ]);
    
        // Auth::attempt untuk memverifikasi username dan password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Regenerasi session setelah login sukses
            $request->session()->regenerate();
    
            // Tambahkan pesan sukses ke session
            session()->flash('success', 'Successfully logged in!');
    
            // Redirect ke halaman dashboard
            return redirect()->intended('/');
        }
    
        // Tambahkan pesan error jika login gagal
        session()->flash('error', 'Login failed! Please check your username and password.');
    
        // Redirect kembali ke halaman login
        return redirect()->back();
    }    

    public function logout(Request $request)
    {
        // Logout dan invalidate session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tambahkan pesan sukses ke session
        session()->flash('success', 'Successfully logged out!');

        // Redirect ke halaman login
        return redirect('/login');
    }

}