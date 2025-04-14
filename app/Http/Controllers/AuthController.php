<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyAgenda_user;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->validate([
            'myagenda_user_email' => 'required|email',
            'myagenda_user_password' => 'required'
        ]);
    
        if (Auth::attempt(['email' => $request->myagenda_user_email, 'password' => $request->myagenda_user_password])) {
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors(['login' => 'Email atau password salah']);
    }    

    public function register(Request $request)
    {
        $request->validate([
            'myagenda_user_nama' => 'required|string|max:255',
            'myagenda_user_email' => 'required|email|unique:myagenda_user',
            'myagenda_user_password' => 'required|min:6',
        ]);

        MyAgenda_user::create([
            'myagenda_user_nama' => $request->myagenda_user_nama,
            'myagenda_user_email' => $request->myagenda_user_email,
            'myagenda_user_password' => bcrypt($request->myagenda_user_password),
            'myagenda_user_role' => 'pengguna'
        ]);

        session()->flash('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->route('login');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

