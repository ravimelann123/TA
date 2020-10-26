<?php

namespace App\Http\Controllers;

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

            return view('admin.dashboard');
        } else {
            $photo = Photo::groupBy('produk_id')->get();
            $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
            return view('users.dashboard', ['cart' => $cart], ['photo' => $photo]);
        }
    }
}
