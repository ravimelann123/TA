<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/dashboard');
        }
        return redirect('/login')->with('delete', 'Username dan Password Salah');;
        //dd($request->all());
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
