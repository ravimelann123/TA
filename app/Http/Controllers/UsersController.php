<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Users;
use App\Akun;
use App\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $datausers = Users::where('username', 'LIKE', '%' . $request->cari . '%')->where('id', '!=', auth()->user()->id)->paginate(5);
        } else {
            $datausers = Users::where('id', '!=', auth()->user()->id)->paginate(5);
        }
        return view('admin.users', ['datausers' => $datausers]);
    }


    public function indexpassword()
    {

        return view('users.changepassword');
    }



    public function create(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $data = $request->all();
        $users = new Users;
        $users->username = $data['username'];
        $users->password = bcrypt($data['password']);
        $users->role = $data['role'];
        $users->nama = "Default Name";
        $users->save();
        return redirect('/admin/users')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function getdatabyid($id)
    {
        $data = Users::find($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        $data = Users::find($id);
        return response()->json($data);
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $users = Users::find($request->id);
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->role = $request->role;
        $users->save();
        return redirect('/admin/users')->with('sukses', 'Data Berhasil Dirubah');
    }



    public function UpdatePassword(Request $request)
    {
        $this->validate($request, [
            'passwordlama' => 'required|min:8',
            'passwordbaru' => 'required|min:8',
            'konfirmasipassword' => 'required|min:8',
        ]);
        //dd($request->all());
        $data = $request->all();
        if (Hash::check($data['passwordlama'], auth()->user()->password)) {
            if ($data['passwordbaru'] == $data['konfirmasipassword']) {
                $users = Users::find(auth()->user()->id);
                $users->password = bcrypt($data['passwordbaru']);
                $users->save();
                return redirect('/plgn/biodata')->with('sukses', 'Kata Sandi Berhasil Dirubah');
            } else {
                return redirect()->back()->with('delete', 'Kata Sandi Tidak Sama');
            }
        } else {
            return redirect()->back();
        }
    }
    public function UpdatePasswordadmin(Request $request)
    {
        $this->validate($request, [
            'passwordlama' => 'required|min:8',
            'passwordbaru' => 'required|min:8',
            'konfirmasipassword' => 'required|min:8',
        ]);
        //dd($request->all());
        $data = $request->all();
        if (Hash::check($data['passwordlama'], auth()->user()->password)) {
            if ($data['passwordbaru'] == $data['konfirmasipassword']) {
                $users = Users::find(auth()->user()->id);
                $users->password = bcrypt($data['passwordbaru']);
                $users->save();
                return redirect('/admin/biodata')->with('sukses', 'Kata Sandi Berhasil Dirubah');
            } else {
                return redirect()->back()->with('delete', 'Kata Sandi Tidak Sama');
            }
        } else {
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $users = Users::find($id);
        $users->delete();
        return redirect('/admin/users')->with('delete', 'Data Berhasil Dihapus');
    }
    public function biodata(Request $request, $id)
    {
        $data = Users::where('id', '=', $id)->get();
        //dd($dataakun);
        return view('admin.biodata', ['data' => $data]);
    }

    public function updateusersadmin(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required|min:10|numeric',
            'avatar' => 'mimes:jpeg,png',
        ]);
        $users = Users::find($request->id);
        $users->nama = $request->nama;
        $users->email = $request->email;
        $users->nohp = $request->nohp;
        $users->alamat = $request->alamat;

        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $users->avatar = $request->file('avatar')->getClientOriginalName();
            $users->save();
        }
        return Redirect::back()->with('sukses', 'Data Berhasil Dirubah');
    }
    public function myprofileadmin()
    {
        return view('admin.profileadmin');
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
            'avatar' => 'mimes:jpeg,png'
        ]);

        $users = Users::find(auth()->user()->id);
        $users->username = $request->username;
        $users->nama = $request->nama;
        $users->email = $request->email;
        $users->nohp = $request->nohp;
        $users->alamat = $request->alamat;
        $users->save();
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $users->avatar = $request->file('avatar')->getClientOriginalName();
            $users->save();
        }
        return Redirect::back()->with('sukses', 'Data Berhasil Dirubah');
    }

    public function myprofile()
    {
        return view('users.profileuser');
    }
}
