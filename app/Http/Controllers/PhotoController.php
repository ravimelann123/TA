<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function indexlogin()
    {


        $photo = Photo::take(3)->groupBy('produk_id')->get();

        return view('auths.login', ['photo' => $photo]);
    }
    public function viewall()
    {

        $photo = Photo::groupBy('produk_id')->get();
        return view('master.viewall', ['photo' => $photo]);
    }


    public function store(Request $request)
    {
        //
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
        return Redirect::back()->with('sukses', 'Data Berhasil Dihapus');
    }
}
