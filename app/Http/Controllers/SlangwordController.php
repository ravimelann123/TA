<?php

namespace App\Http\Controllers;

use App\Slangword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SlangwordController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Slangword::where('slangword', 'LIKE', '%' . $request->cari . '%')->paginate(5);
            $data->appends($request->all());
        } else {
            $data = Slangword::paginate(5);
        }

        return view('admin.slangword', ['data' => $data]);
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'slangword' => 'required',
            'formal' => 'required'
        ]);

        $data = Slangword::all();

        foreach ($data as $p) {
            if ($p->slangword == $request->slangword) {
                return Redirect::back()->with('delete', 'Dataset sudah ada');
            }
        }

        $data = new Slangword();
        $data->slangword = $request->slangword;
        $data->formal = $request->formal;
        $data->save();

        return redirect('/admin/slangword')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function getdatabyid($id)
    {
        $data = Slangword::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'slangword' => 'required',
            'formal' => 'required'
        ]);

        $data = Slangword::all();


        $data = Slangword::find($request->id);
        $data->slangword = $request->slangword;
        $data->formal = $request->formal;
        $data->save();
        return redirect('/admin/slangword')->with('sukses', 'Data Berhasil Dirubah');
    }
    public function delete($id)
    {
        $data = Slangword::find($id);
        $data->delete();
        return redirect('/admin/slangword')->with('sukses', 'Data Berhasil Dihapus');
    }
}
