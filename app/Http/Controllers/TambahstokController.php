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
            if ($request->cari == "") {
                $tambahstok = Tambahstok::paginate(5);
            } else {
                $data = Produk::where('nama', '=', $request->cari)->get();
                $flag = count($data);
                if ($flag == 1) {
                    foreach ($data as $p) {
                        $id = $p->id;
                    }
                    $tambahstok = Tambahstok::where('produk_id', '=', $id)->paginate(5);
                } else {
                    $tambahstok = Tambahstok::paginate(5);
                }
            }
        } else {
            $tambahstok = Tambahstok::paginate(5);
        }
        return view('admin.tambah_stokproduk', ['produk' => $produk], ['tambahstok' => $tambahstok]);
    }
    public function indexsuperadmin(Request $request)
    {

        if ($request->has('cari')) {
            if ($request->cari == "") {
                $data = Tambahstok::paginate(4);
            } else {
                $data = Produk::where('nama', '=', $request->cari)->get();
                $flag = count($data);
                if ($flag == 1) {
                    foreach ($data as $p) {
                        $id = $p->id;
                    }
                    $data = Tambahstok::where('produk_id', '=', $id)->paginate(4);
                } else {
                    $data = Tambahstok::paginate(4);
                }
            }
        } else {
            $data = Tambahstok::paginate(4);
        }
        return view('superadmin.superadmin_tambah_stok',  ['data' => $data]);
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
        return redirect('/tambahstok')->with('sukses', 'Data Berhasil Ditambahkan');
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
        return redirect('/tambahstok')->with('delete', 'Data Berhasil Dihapus');
    }
}
