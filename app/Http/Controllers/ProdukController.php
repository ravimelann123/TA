<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Produk;
use App\Photo;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk', ['produk' => $produk]);
    }

    public function photoproduk($id)
    {
        //$produk_id = $id;
        $photo = Photo::where('produk_id', '=', $id)->get();
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
                echo $namafoto;
                $photo->namafoto = $namafoto;
                $photo->produk_id = $produk->id;
                $photo->save();
            }
            return redirect('/produk');
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
        return redirect('/produk');
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        $photo = Photo::where('produk_id', '=', $id)->delete();
        return redirect('/produk');
    }
}
