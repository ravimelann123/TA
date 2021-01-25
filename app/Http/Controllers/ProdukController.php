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
            $data = Produk::where('nama', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {
            $data = Produk::paginate(4);
        }
        return view('admin.produk', ['data' => $data]);
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
        return view('users.produk', ['photo' => $photo]);
    }

    public function photoproduk($id)
    {
        //$produk_id = $id;
        $data = Photo::where('produk_id', '=', $id)->paginate(3);
        $count = Photo::where('produk_id', '=', $id)->count();

        $idproduk = $id;
        return view('admin.Photo', ['data' => $data, 'idproduk' => $idproduk, 'count' => $count]);
    }

    public function create(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'namafoto[]' => 'mimes:jpeg,png'
        ]);

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
            return redirect('/admin/produk')->with('sukses', 'Data Berhasil Ditambahkan');
        }
    }



    public function edit($id)
    {
        $data = Produk::find($id);
        return response()->json($data);
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);

        $produk = Produk::find($request->id);
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->save();
        return redirect('/admin/produk')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        $photo = Photo::where('produk_id', '=', $id)->delete();
        return redirect('/admin/produk')->with('delete', 'Data Berhasil Dihapus');
    }
}
