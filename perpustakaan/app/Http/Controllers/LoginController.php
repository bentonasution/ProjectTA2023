<?php

namespace App\Http\Controllers;


use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function halamanlogin() 
    {
        return view('login.login');
    }

    public function postlogin(Request $request) 
    {
        $credentials = $request->only('nik', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        } else {
            return redirect('login')->with('error', 'NIK atau Password Salah!!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
    }

    
}