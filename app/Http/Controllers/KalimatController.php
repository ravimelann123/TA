<?php

namespace App\Http\Controllers;

use App\Kalimat;
use App\Prosesnlp;
use Illuminate\Http\Request;

class KalimatController extends Controller
{
    public function indexProsessNLP(Request $request)
    {
        if ($request->has('cari')) {

            $data = Kalimat::where('kalimat', 'LIKE', '%' . $request->cari . '%')->get();
        } else {

            $data = Kalimat::all();
        }

        $data1 = Prosesnlp::all();
        return view('superadmin.superadmin_ProsessNlp', ['data' => $data, 'data1' => $data1]);
    }
}
