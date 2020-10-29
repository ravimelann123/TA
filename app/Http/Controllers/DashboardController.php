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
        } else {
            $photo = Photo::groupBy('produk_id')->get();
            $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
            $totalcart = count($cart);

            return view('users.dashboard', ['cart' => $cart, 'photo' => $photo, 'totalcart' => $totalcart]);
        }
    }
}
