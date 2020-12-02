<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Produk;
use App\Photo;
use App\Cart;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('cari')) {
            $produk = Produk::where('nama', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $produk = Produk::paginate(5);
        }
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
        $totalcart = count($cart);
        return view('admin.produk', ['produk' => $produk, 'totalcart' => $totalcart]);
    }

    public function indexsuperadmin(Request $request)
    {

        if ($request->has('cari')) {
            $produk = Produk::where('nama', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $produk = Produk::paginate(5);
        }
        return view('superadmin.superadmin_produk', ['produk' => $produk]);
    }
    public function indexproduk(Request $request)
    {
        if ($request->has('cari')) {
            if ($request->cari == "") {
                $photo = Photo::groupBy('produk_id')->get();
            } else {
                $produk = Produk::where('nama', '=', $request->cari)->get();
                $flag = count($produk);
                if ($flag == 1) {
                    foreach ($produk as $p) {
                        $id = $p->id;
                        $photo = Photo::where('produk_id', '=', $id)->groupBy('produk_id')->get();
                    }
                } else {
                    $photo = Photo::groupBy('produk_id')->get();
                }
            }
        } else {
            $photo = Photo::groupBy('produk_id')->get();
        }

        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
        $totalcart = count($cart);
        return view('users.produk', ['photo' => $photo, 'totalcart' => $totalcart]);
    }

    public function photoproduk($id)
    {
        //$produk_id = $id;
        $photo = Photo::where('produk_id', '=', $id)->paginate(5);
        return view('admin.Photo', ['photo' => $photo]);
    }

    public function create(Request $request)
    {
        $produk = new Produk;
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->stok = 0;
        $produk->harga = $request->harga;
        $produk->save();

        if ($request->hasFile('namafoto')) {
            $image_array = $request->file('namafoto');
            $array_len = count($image_array);


            for ($i = 0; $i < $array_len; $i++) {
                $namafoto = $image_array[$i]->getClientOriginalName();
                $image_array[$i]->move('images/produk/', $namafoto);
                $photo = new Photo();

                $photo->namafoto = $namafoto;
                $photo->produk_id = $produk->id;
                $photo->save();
            }
            return redirect('/produk')->with('sukses', 'Data Berhasil Ditambahkan');
        }
    }



    public function show(Produk $produk)
    {
        //
    }


    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('admin.produk_edit', ['produk' => $produk]);
    }


    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'username' => 'required|min:8',
        //     'password' => 'required|min:8',
        //     'role' => 'required'

        // ]);

        $produk = Produk::find($id);
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->save();
        return redirect('/produk')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        $photo = Photo::where('produk_id', '=', $id)->delete();
        return redirect('/produk')->with('delete', 'Data Berhasil Dihapus');
    }
}
