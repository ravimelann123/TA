<?php

namespace App\Http\Controllers;

use App\Aturan;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Aturan::where('aturanproduksi', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {

            $data = Aturan::paginate(4);
        }
        return view('superadmin.superadmin_aturan', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $data = new Aturan();
        $data->tag = $request->tag;
        $data->aturanproduksi = $request->aturanproduksi;
        $data->save();
        return redirect('/superadmin_aturan')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function getdatabyid($id)
    {
        $data = Aturan::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $data = Aturan::find($request->id);
        $data->tag = $request->tag;
        $data->aturanproduksi = $request->aturanproduksi;
        $data->save();
        return redirect('/superadmin_aturan')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        $data = Aturan::find($id);
        $data->delete();
        return redirect('/superadmin_aturan')->with('sukses', 'Data Berhasil Dihapus');
    }
}
