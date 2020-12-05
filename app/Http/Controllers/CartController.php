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
        $data = Cart::where('users_id', '=', auth()->user()->id)->get();
        $data1 = Produk::all();
        return view('users.cart', ['data' => $data, 'data1' => $data1]);
    }


    public function addprodukcart(Request $request)
    {

        $cart = Cart::where('produk_id', '=', $request->produk)->get();
        $hasil = count($cart);
        if ($hasil == 1) {
            return redirect('/cart')->with('delete', 'Produk ini sudah ada di keranjang');
            //return response()->json(['gagal' => 'ok'], 404);
        } else {
            $cart = new Cart;
            $cart->produk_id = $request->produk;
            $cart->jumlah = 1;
            $cart->users_id = auth()->user()->id;
            $cart->save();
            //return response()->json(['berhasil' => 'ok'], 200);
            return redirect('/cart')->with('sukses', 'Berhasil Ditambahkan');
        }
    }


    public function indexcart(Request $request, $id)
    {

        $order = new Order;
        $order->nomerpesanan = "o" . date("Ymds") . auth()->user()->id;
        $order->users_id = auth()->user()->id;
        $order->status = "Menunggu Diproses";

        $jumlah_arr = $request->jumlah;
        $array_len = count($jumlah_arr);

        $total = 0;
        for ($i = 0; $i < $array_len; $i++) {
            $produk = Produk::find($request->produk_id[$i]);
            $total = $total + ($request->jumlah[$i] * $produk->harga);
        }

        $order->total = $total;

        $order->save();


        for ($i = 0; $i < $array_len; $i++) {
            $orderdetail = new OrderDetail;
            $orderdetail->order_id = $order->id;
            $orderdetail->produk_id = $request->produk_id[$i];
            if ($request->jumlah[$i] == null) {
                $orderdetail->jumlah = 1;
            } else {
                $orderdetail->jumlah = $request->jumlah[$i];
            }

            $orderdetail->save();
            $produk = Produk::find($request->produk_id[$i]);
            if ($request->jumlah[$i] == null) {
                $produk->stok = $produk->stok - 1;
            } else {
                $produk->stok = $produk->stok - $request->jumlah[$i];
            }
            $produk->save();
        }

        Cart::where('users_id', '=', auth()->user()->id)->delete();

        return redirect('/transaksi')->with('sukses', 'Order Berhasil');
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
