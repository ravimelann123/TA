<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Produk;
use App\Cart;
use Illuminate\Http\Request;
use \Sastrawi\Stemmer\StemmerFactory;
use PDF;

class OrderController extends Controller
{
    public function orderdetailpesanan($id)
    {
        $data = Order::find($id);
        $orderdetail = OrderDetail::where('order_id', '=', $id)->get();
        return view('admin.orderdetail', ['orderdetail' => $orderdetail, 'data' => $data]);
    }
    public function pdf($id)
    {
        $data = Order::find($id);
        $orderdetail = OrderDetail::where('order_id', '=', $id)->get();
        $pdf = PDF::loadView('admin.print', ['orderdetail' => $orderdetail, 'data' => $data]);
        return $pdf->download('invoice.pdf');
    }

    public function updatetosd($id)
    {
        $order = Order::find($id);
        $order->status = "Sedang Diproses";
        $order->save();
        return redirect('/indexorder')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function updatetops($id)
    {
        $order = Order::find($id);
        $order->status = "Pesanan Selesai";
        $order->save();
        return redirect('/indexorder')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function indexorder(Request $request)
    {

        if ($request->has('cari')) {
            $data = Order::where('status', '=',  $request->cari)->paginate(4);
        } else {
            $data = Order::paginate(4);
        }
        return view('admin.indexorder', ['data' => $data]);
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

        return redirect('/transaksi')->with('sukses', 'Data Berhasil Disimpan');
    }


    public function indextransaksi(Request $request)
    {
        $order = Order::where('users_id', '=', auth()->user()->id)->latest()->first();
        $orderd = OrderDetail::where('order_id', '=', $order->id)->get();
        $produk = Produk::all();
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();

        $totalcart = count($cart);
        return view('users.transaksi', ['order' => $order, 'produk' => $produk, 'orderd' => $orderd, 'totalcart' => $totalcart]);
    }


    public function indexpesanan(Request $request)
    {
        if ($request->has('cari')) {
            $data = Order::where('status', '=',  $request->cari)->where('users_id', '=', auth()->user()->id)->paginate(4);
        } else {
            $data = Order::where('users_id', '=', auth()->user()->id)->paginate(4);
        }

        return view('users.pesanan', ['data' => $data]);
    }

    public function Dpesanan($id)
    {

        $orderdetail = OrderDetail::where('order_id', '=', $id)->get();
        return view('users.Dpesanan', ['orderdetail' => $orderdetail]);
    }
}
