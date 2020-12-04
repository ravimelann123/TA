<?php

namespace App\Http\Controllers;

use App\Bahasaalami;
use Illuminate\Http\Request;

class BahasaalamiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Bahasaalami::where('kata', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {

            $data = Bahasaalami::paginate(4);
        }
        return view('superadmin.superadmin_bahasaalami', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $data = new Bahasaalami();
        $data->tag = $request->tag;
        $data->kata = $request->kata;
        $data->save();
        return redirect('/superadmin_bahasaalami')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function getdatabyid($id)
    {
        $data = Bahasaalami::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $data = Bahasaalami::find($request->id);
        $data->tag = $request->tag;
        $data->kata = $request->kata;
        $data->save();
        return redirect('/superadmin_bahasaalami')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        $data = Bahasaalami::find($id);
        $data->delete();
        return redirect('/superadmin_bahasaalami')->with('sukses', 'Data Berhasil Dihapus');
    }
}
