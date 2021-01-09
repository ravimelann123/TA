<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Order;
use App\Users;
use App\Cart;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    // public function index(Request $request)
    // {

    //     if ($request->has('cari')) {
    //         $dataakun = Akun::where('nama', 'LIKE', '%' . $request->cari . '%')->paginate(5);
    //     } else {
    //         $dataakun = Akun::paginate(5);
    //     }

    //     return view('admin.Akun', ['dataakun' => $dataakun]);
    // }

    public function biodata(Request $request, $id)
    {
        $data = Akun::where('users_id', '=', $id)->get();
        //dd($dataakun);
        return view('admin.biodata', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Akun::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        // $this->validate($request, [
        //     'email' => 'required',
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'nohp' => 'required|min:10|numeric',
        //     'avatar' => 'mimes:jpeg,png',
        // ]);
        $akun = Akun::find($request->id);
        $akun->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $akun->avatar = $request->file('avatar')->getClientOriginalName();
            $akun->save();
        }
        return redirect('/users')->with('sukses', 'Data Berhasil Dirubah');
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
        return redirect('/plgn/biodata')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function updatemyprofileadmin(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'username' => 'required|min:8',
            'email' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required|min:10|numeric',
            'avatar' => 'mimes:jpeg,png'
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
        return redirect('/admin/biodata')->with('sukses', 'Data Berhasil Dirubah');
    }
    public function myprofile()
    {

        return view('users.profileuser');
    }
    public function myprofileadmin()
    {
        return view('admin.profileadmin');
    }

    public function getdatabyid($id)
    {
        $data = Akun::find($id);
        return response()->json($data);
    }
}
