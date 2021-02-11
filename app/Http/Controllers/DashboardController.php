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
            $orderin = Order::where('status', '=', 'Menunggu Diproses')->get()->count();
            return view('admin.dashboard', ['akun' => $akun, 'order' => $order, 'produk' => $produk, 'orderin' => $orderin]);
        } elseif (auth()->user()->role == "superadmin") {
            return view('superadmin.dashboard');
        } else {
            // $order = Order::where('users_id', '=', auth()->user()->id)->get();
            // $order = count($order);
            // return view('users.dashboard', ['order' => $order]);
            $order = Order::all();
            // dd($order);
            return view('users.dashboard', ['order' => $order]);
        }
    }
}
