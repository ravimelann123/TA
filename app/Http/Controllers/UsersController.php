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
            $datausers = Users::where('username', 'LIKE', '%' . $request->cari . '%')->where('role', '=', 'user')->paginate(5);
        } else {
            $datausers = Users::where('role', '=', 'user')->paginate(5);
        }
        return view('admin.users', ['datausers' => $datausers]);
    }
    public function indexsuperadmin(Request $request)
    {
        if ($request->has('cari')) {
            $data = Users::where('username', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {
            $data = Users::paginate(4);
        }
        return view('superadmin.superadmin_users', ['data' => $data]);
    }

    public function indexpassword()
    {
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
        $totalcart = count($cart);
        return view('users.changepassword', ['totalcart' => $totalcart]);
    }
    public function createsuperadmin(Request $request)
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
        $users->save();

        $akun = new Akun;
        $akun->users_id = $users->id;
        $akun->nama = "Default";
        $akun->save();
        return redirect('/superadmin_users')->with('sukses', 'Data Berhasil Ditambahkan');
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8',
            'password' => 'required|min:8'

        ]);

        $data = $request->all();
        $users = new Users;
        $users->username = $data['username'];
        $users->password = bcrypt($data['password']);
        $users->role = "user";
        $users->save();

        $akun = new Akun;
        $akun->users_id = $users->id;
        $akun->nama = "Default";
        $akun->save();
        return redirect('/users')->with('sukses', 'Data Berhasil Ditambahkan');
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
    public function editsuperadmin($id)
    {
        $users = Users::find($id);
        return view('superadmin.superadmin_users_edit', ['users' => $users]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8',
            'password' => 'required|min:8'
        ]);

        $users = Users::find($request->id);
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->role = "user";
        $users->save();
        return redirect('/users')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function updatesuperadmin(Request $request)
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
        return redirect('/superadmin_users')->with('sukses', 'Data Berhasil Dirubah');
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
                return redirect('/myprofile')->with('sukses', 'Kata Sandi Berhasil Dirubah');
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
        return redirect('/users')->with('delete', 'Data Berhasil Dihapus');
    }

    public function deletesuperadmin($id)
    {
        $users = Users::find($id);
        $users_id = $users->id;
        $akun = Akun::find($users_id);
        $users->delete();
        $akun->delete();
        return redirect('/superadmin_users')->with('delete', 'Data Berhasil Dihapus');
    }
}
