<?php

namespace App\Http\Controllers;

use App\Kalimat;
use App\Prosesnlp;
use App\Prosesnlp_detail;
use Illuminate\Http\Request;

class KalimatController extends Controller
{
    public function indexProsessNLP(Request $request)
    {
        if ($request->has('cari')) {
            $data = Prosesnlp::where('id', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $data = Prosesnlp::paginate(5);
        }

        return view('admin.proses_nlp', ['data' => $data]);
    }
    public function prosesnlpdetail(Request $request, $id)
    {
        if ($request->has('cari')) {
            $data = Prosesnlp_detail::where('kata', 'LIKE', '%' . $request->cari . '%')->paginate(5);
            $ids = $id;
        } else {
            $data = Prosesnlp_detail::where('prosesnlp_id', '=', $id)->paginate(5);
            $ids = $id;
        }
        return view('admin.proses_nlp_detail', ['data' => $data, 'ids' => $ids]);
    }
}
