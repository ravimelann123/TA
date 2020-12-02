<?php

namespace App\Http\Controllers;

use App\Kalimat;
use App\Prosesnlp;
use Illuminate\Http\Request;

class KalimatController extends Controller
{
    public function IndexProsessNLP(Request $request)
    {
        if ($request->has('cari')) {
            $data = Kalimat::where('kalimat', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $data = Kalimat::paginate(5);
        }

        return view('superadmin.superadmin_ProsessNlp', ['data' => $data]);
    }
    public function IndexProsessNLPdetail($id)
    {
        $data = Prosesnlp::where('kalimat_id', '=', $id)->paginate(4);
        return view('superadmin.superadmin_ProsessNlp_detail', ['data' => $data]);
    }
}
