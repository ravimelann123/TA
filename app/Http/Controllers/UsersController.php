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
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
        $totalcart = count($cart);
        return view('users.changepassword', ['totalcart' => $totalcart]);
    }



    public function create(Request $request)
    {
        // $this->validate($request, [
        //     'username' => 'required|min:8',
        //     'password' => 'required|min:8'

        // ]);

        $data = $request->all();
        $users = new Users;
        $users->username = $data['username'];
        $users->password = bcrypt($data['password']);
        $users->role = $data['role'];
        $users->save();

        $akun = new Akun;
        $akun->users_id = $users->id;
        $akun->nama = "Default";
        $akun->save();
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
        // $this->validate($request, [
        //     'username' => 'required|min:8',
        //     'password' => 'required|min:8'
        // ]);

        $users = Users::find($request->id);
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->role = $request->role;
        $users->save();
        return redirect('/admin/users')->with('sukses', 'Data Berhasil Dirubah');
    }



    public function UpdatePassword(Request $request)
    {
        // $this->validate($request, [
        //     'passwordlama' => 'required|min:8',
        //     'passwordbaru' => 'required|min:8',
        //     'konfirmasipassword' => 'required|min:8',
        // ]);
        //dd($request->all());
        $data = $request->all();
        if (Hash::check($data['passwordlama'], auth()->user()->password)) {
            if ($data['passwordbaru'] == $data['konfirmasipassword']) {
                $users = Users::find(auth()->user()->id);
                $users->password = bcrypt($data['passwordbaru']);
                $users->save();
                return redirect('/plgn/biodata')->with('sukses', 'Kata Sandi Berhasil Dirubah');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function UpdatePasswordadmin(Request $request)
    {
        // $this->validate($request, [
        //     'passwordlama' => 'required|min:8',
        //     'passwordbaru' => 'required|min:8',
        //     'konfirmasipassword' => 'required|min:8',
        // ]);
        //dd($request->all());
        $data = $request->all();
        if (Hash::check($data['passwordlama'], auth()->user()->password)) {
            if ($data['passwordbaru'] == $data['konfirmasipassword']) {
                $users = Users::find(auth()->user()->id);
                $users->password = bcrypt($data['passwordbaru']);
                $users->save();
                return redirect('/admin/biodata')->with('sukses', 'Kata Sandi Berhasil Dirubah');
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
        return redirect('/admin/users')->with('delete', 'Data Berhasil Dihapus');
    }
}
