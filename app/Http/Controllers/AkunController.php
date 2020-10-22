<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('cari')) {
            $dataakun = Akun::where('nama', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $dataakun = Akun::paginate(5);
        }

        return view('admin.Akun', ['dataakun' => $dataakun]);
    }

    public function edit($id)
    {
        $akun = Akun::find($id);
        return view('admin.akun_edit', ['akun' => $akun]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required|min:10|numeric',
            'avatar' => 'mimes:jpeg,png',
        ]);
        $akun = Akun::find($id);
        $akun->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $akun->avatar = $request->file('avatar')->getClientOriginalName();
            $akun->save();
        }
        return redirect('/akun');
    }

    public function indexmyprofile()
    {
        return view('users.editmyprofile');
    }

    public function updatemyprofile(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'username' => 'required|min:8',
            'email' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required|min:10|numeric',
            'avatar' => 'mimes:jpeg,png',
        ]);

        $users = Users::find(auth()->user()->id);
        $users->username = $request->username;
        $users->save();
        $akun = Akun::find(auth()->user()->akun->id);
        $akun->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $akun->avatar = $request->file('avatar')->getClientOriginalName();
            $akun->save();
        }
        return redirect('/myprofile');
    }

    public function myprofile()
    {
        return view('users.profileuser');
    }
}
