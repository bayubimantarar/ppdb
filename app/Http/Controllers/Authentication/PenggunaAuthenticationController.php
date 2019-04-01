<?php

namespace App\Http\Controllers\Authentication;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\PenggunaAuthenticationRequest;

class PenggunaAuthenticationController extends Controller
{
    public function loginForm()
    {
        return view('authentication.login_form');
    }

    public function login(
        PenggunaAuthenticationRequest
        $penggunaAuthenticationRequest
    ) {
        # set variable
        $email = $penggunaAuthenticationRequest->email;
        $password = $penggunaAuthenticationRequest->password;

        # set array data login
        $dataLogin = [
            'email' => $email,
            'password' => $password
        ];

        # check login
        if(Auth::guard('pengguna')->attempt($dataLogin)){
            return redirect()
                ->intended();
        }

        return redirect('/autentikasi/form-login')
            ->withErrors([
                'notification' => 'Akun tidak ditemukan! Periksa kembali email atau kata sandi.'
            ]);
    }

    /**
     * Block comment
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
