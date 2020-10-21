<?php

namespace App\Http\Controllers;

use App\Tambahstok;
use App\Produk;
use Illuminate\Http\Request;

class TambahstokController extends Controller
{

    public function indextambahstok(Request $request)
    {
        $produk = Produk::all();
        if ($request->has('cari')) {
            $tambahstok = Tambahstok::where('produk_id', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $tambahstok = Tambahstok::all();
        }

        return view('admin.tambah_stokproduk', ['produk' => $produk], ['tambahstok' => $tambahstok]);
    }
    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        $data = $request->all();
        $tambahstok = new Tambahstok;
        $tambahstok->produk_id = $data['produk_id'];
        $tambahstok->stok = $data['stok'];
        $tambahstok->users_id = auth()->user()->id;
        $tambahstok->save();

        $produk = Produk::find($request->produk_id);
        $produk->stok = $produk->stok + $request->stok;
        $produk->save();
        return redirect('/tambahstok');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Tambahstok $tambahstok)
    {
        //
    }


    public function edit(Tambahstok $tambahstok)
    {
        //
    }


    public function update(Request $request, Tambahstok $tambahstok)
    {
        //
    }


    public function delete($id)
    {
        $tambahstok = Tambahstok::find($id);
        $produk_id = $tambahstok->produk_id;
        $produk = Produk::find($produk_id);
        $produk->stok = $produk->stok - $tambahstok->stok;
        $produk->save();
        $tambahstok->delete();
        return redirect('/tambahstok');
    }
}
