<?php

namespace App\Http\Controllers;

use App\Similarity;
use Illuminate\Http\Request;

class SimilarityController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('cari')) {
            $data = Similarity::where('pesan', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {
            $data = Similarity::paginate(4);
        }
        return view('admin.similarity', ['data' => $data]);
    }
}
