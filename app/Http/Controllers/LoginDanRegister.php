<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginDanRegister extends Controller
{
    public function indexLogin()
    {
        return view('login.halamanLogin');
    }

    public function indexRegister()
    {
        return view('login.halamanRegister');
    }
    public function login(Request $request) 
    {

        $valisdasi = $request->validate(
            [
                'email' => ['required'],
                'password' => ['required']
            ],
            [
                'email.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi'
            ]
        );
        
        $info=[
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($info)){
            echo 'lasomu';
        } else {
            return redirect('indexLogin')->withErrors('Salah')->withInput();
        }
    }
    public function daftar(Request $request)
    {
        $request->validate(
            [
                'nama' => ['required'],
                'email' => ['required'],
                'password' => ['required'],
                'role_id' => ['required'],
                'no_telepon' => ['required'],
            ],
            [
                'nama.required' => 'nama harus diisi',
                'email.required' => 'email harus diisi',
                'pasword.required' => 'password harus diisi',
                'rol_id.required' => 'rol_id harus diisi',
                'no_telepon.required' => 'nomor telepon harus diisi',
            ]
        );
    }
}
