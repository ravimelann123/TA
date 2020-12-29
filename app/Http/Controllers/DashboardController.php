<?php

namespace App\Http\Controllers;

use App\Users;
use App\Photo;
use App\Order;
use App\Produk;
use App\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        if (auth()->user()->role == "admin") {
            $akun = Users::where('role', '=', 'user')->get();
            $akun = count($akun);
            $order = Order::all();
            $order = count($order);
            $produk = Produk::all();
            $produk = count($produk);
            return view('admin.dashboard', ['akun' => $akun, 'order' => $order, 'produk' => $produk]);
        } elseif (auth()->user()->role == "superadmin") {
            return view('superadmin.dashboard');
        } else {
            $photo = Photo::groupBy('produk_id')->get();
            $order = Order::where('users_id', '=', auth()->user()->id)->get();
            $order = count($order);
            return view('users.dashboard', ['photo' => $photo, 'order' => $order]);
        }
    }
}
