<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\MyAgenda_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        MyAgenda_user::create([
            'myagenda_user_nama' => $request->myagenda_user_nama,
            'myagenda_user_email' => $request->myagenda_user_email,
            'myagenda_user_password' => bcrypt($request->myagenda_user_password),
            'myagenda_user_role' => 'pengguna'
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'myagenda_user_nama' => ['required', 'string', 'max:255'],
            'myagenda_user_email' => ['required', 'string', 'email', 'max:255', 'unique:myagenda_user,myagenda_user_email'],
            'myagenda_user_password' => ['required', 'string', 'min:8'],
        ]);
    }
}
