<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Produk;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $produk = Produk::all();
        return view('users.order', ['produk' => $produk]);
    }

    public function addProductCart(Request $request, $id)
    {

        $produk = Produk::find($id);
    }
    public function create(Request $request)
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

        return redirect('/order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
