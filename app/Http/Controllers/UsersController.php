<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Users;
use App\Akun;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function index()
    {
        $datausers = Users::all();
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
            'email' => 'required|unique:akun',
            'nama' => 'required',
            'role' => 'required',
            'alamat' => 'required',
            'nohp' => 'required|min:10|max:12|numeric',
        ]);

        $data = $request->all();
        $users = new Users;
        $users->username = $data['username'];
        $users->password = bcrypt($data['password']);
        $users->role = $data['role'];
        $users->save();

        $akun = new Akun;
        $akun->users_id = $users->id;
        $akun->nama = $data['nama'];
        $akun->email = $data['email'];
        $akun->nohp = $data['nohp'];
        $akun->alamat = $data['alamat'];
        $akun->save();
        return redirect('users');
    }

    public function edit($id)
    {
        $users = Users::find($id);
        return view('admin.users_edit', ['users' => $users]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8',
            'password' => 'required|min:8',
            'role' => 'required'

        ]);

        $users = Users::find($id);
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->role = $request->role;
        $users->save();
        return redirect('/users');
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
                return redirect('/settings');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }


    public function delete($id)
    {
        $users = Users::find($id);
        $users_id = $users->id;
        $akun = Akun::find($users_id);
        $users->delete();
        $akun->delete();
        return redirect('/users');
    }
}
