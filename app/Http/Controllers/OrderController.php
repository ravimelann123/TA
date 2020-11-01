<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Produk;
use App\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderdetailpesanan($id)
    {
        $orderdetail = OrderDetail::where('order_id', '=', $id)->get();
        return view('admin.orderdetail', ['orderdetail' => $orderdetail]);
    }
    public function index()
    {
        $produk = Produk::all();
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();

        $totalcart = count($cart);
        return view('users.order', ['produk' => $produk, 'totalcart' => $totalcart]);
    }
    public function orderbd(Request $request)
    {

        if ($request->has('cari')) {
            $order = Order::where('status', '=', 'Menunggu Diproses')->where('nomerpesanan', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $order = Order::where('status', '=', 'Menunggu Diproses')->paginate(5);
        }

        return view('admin.orderbd', ['order' => $order]);
    }

    public function updatetosd($id)
    {
        $order = Order::find($id);
        $order->status = "Sedang Diproses";
        $order->save();
        return redirect('/orderbd')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function updatetops($id)
    {
        $order = Order::find($id);
        $order->status = "Pesanan Selesai";
        $order->save();
        return redirect('/ordersd')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function ordersd(Request $request)
    {

        if ($request->has('cari')) {
            $order = Order::where('status', '=', 'Sedang Diproses')->where('nomerpesanan', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $order = Order::where('status', '=', 'Sedang Diproses')->paginate(5);
        }

        return view('admin.ordersd', ['order' => $order]);
    }

    public function orderps(Request $request)
    {

        if ($request->has('cari')) {
            $order = Order::where('status', '=', 'Pesanan Selesai')->where('nomerpesanan', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $order = Order::where('status', '=', 'Pesanan Selesai')->paginate(5);
        }

        return view('admin.orderps', ['order' => $order]);
    }

    public function indexorder(Request $request)
    {


        if ($request->has('cari')) {
            $order = Order::where('nomerpesanan', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $order = Order::paginate(5);
        }


        return view('admin.indexorder', ['order' => $order]);
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

        return redirect('/order')->with('sukses', 'Data Berhasil Disimpan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indextransaksi(Request $request)
    {
        $order = Order::where('users_id', '=', auth()->user()->id)->latest()->first();
        $orderd = OrderDetail::where('order_id', '=', $order->id)->get();
        $produk = Produk::all();
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();

        $totalcart = count($cart);
        return view('users.transaksi', ['order' => $order, 'produk' => $produk, 'orderd' => $orderd, 'totalcart' => $totalcart]);
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
