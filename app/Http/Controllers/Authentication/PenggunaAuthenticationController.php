<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\penggunaAuthenticationRequest;

class PenggunaAuthenticationController extends Controller
{
    public function loginForm()
    {
        return response()
            ->json(200);
    }

    public function login(
        penggunaAuthenticationRequest
        $penggunaAuthenticationRequest
    ) {
        # code...
        $email = $penggunaAuthenticationRequest->email;
        $password = $penggunaAuthenticationRequest->password;

        $dataLogin = [
            'email' => $email,
            'password' => $password
        ];

        if(Auth::guard('pengguna')->attempt($dataLogin)){
            return redirect()
                ->intended();
        }

        return redirect('/autentikasi/form-login')
            ->withErrors([
                'notification' => 'Akun tidak ditemukan! Periksa kembali email atau kata sandi.'
            ]);
    }
}
