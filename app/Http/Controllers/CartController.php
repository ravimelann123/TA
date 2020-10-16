<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Photo;
use App\Order;
use App\Produk;
use App\OrderDetail;

class CartController extends Controller
{
    public function index()
    {
        $photo = Photo::groupBy('produk_id')->get();
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();

        return view('users.cart', ['cart' => $cart], ['photo' => $photo]);
    }


    public function addprodukcart(Request $request, $id)
    {

        $cart = Cart::where('produk_id', '=', $id)->get();
        $hasil = count($cart);

        if ($hasil == 1) {
            return redirect('/cart');
        } else {
            $cart = new Cart;
            $cart->produk_id = $id;
            $cart->jumlah = 1;
            $cart->users_id = auth()->user()->id;
            $cart->save();
            return redirect('/cart');
        }
    }


    public function indexcart(Request $request, $id)
    {

        $order = new Order;
        $order->nomerpesanan = "#O" . date("Ymds") . auth()->user()->id;
        $order->users_id = auth()->user()->id;
        $order->status = "Belum Diproses";
        $order->save();

        $jumlah_arr = $request->jumlah;
        $array_len = count($jumlah_arr);


        for ($i = 0; $i < $array_len; $i++) {
            $orderdetail = new OrderDetail;
            $orderdetail->order_id = $order->id;
            $orderdetail->produk_id = $request->produk_id[$i];
            $orderdetail->jumlah = $request->jumlah[$i];
            $orderdetail->save();
            $produk = Produk::find($request->produk_id[$i]);
            $produk->stok = $produk->stok - $request->jumlah[$i];
            $produk->save();
        }

        Cart::where('users_id', '=', auth()->user()->id)->delete();

        return redirect('/cart');
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function deletecart()
    {
        Cart::where('users_id', '=', auth()->user()->id)->delete();
        return redirect('/cart');
    }

    public function deletecartitem($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/cart');
    }
}
