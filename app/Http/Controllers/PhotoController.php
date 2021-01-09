<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function indexlogin()
    {
        $photo = Photo::take(6)->groupBy('produk_id')->get();
        return view('auths.login', ['photo' => $photo]);
    }
    public function viewall()
    {
        $photo = Photo::groupBy('produk_id')->get();
        return view('master.viewall', ['photo' => $photo]);
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'namafoto' => 'mimes:jpeg,png'
        ]);
        if ($request->hasFile('namafoto')) {
            $image_array = $request->file('namafoto');
            $array_len = count($image_array);

            for ($i = 0; $i < $array_len; $i++) {
                $namafoto = $image_array[$i]->getClientOriginalName();
                $image_array[$i]->move('images/produk/', $namafoto);
                $photo = new Photo();
                $photo->namafoto = $namafoto;
                $photo->produk_id = $request->id;
                $photo->save();
            }
            return redirect::back()->with('sukses', 'Data Berhasil Ditambahkan');
        }
    }



    public function show(Photo $photo)
    {
        //
    }


    public function edit(Photo $photo)
    {
        //
    }


    public function update(Request $request, $id)
    {

        $photo = Photo::find($id);

        if ($request->hasFile('namafoto')) {
            $nama = $request->file('namafoto');
            $nama->move('images/produk/', $nama->getClientOriginalName());
            $photo->namafoto = $nama->getClientOriginalName();
            echo $photo->namafoto;
            $photo->save();
            return Redirect::back()->with('sukses', 'Data Berhasil Dirubah');
        }
    }


    public function delete($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        return Redirect::back()->with('delete', 'Data Berhasil Dihapus');
    }
}
