<?php

namespace App\Http\Controllers;

use App\Aturan;
use App\Chatbot;
use App\Cart;
use App\Kalimat;
use App\Kata;
use App\Order;
use App\Prosesnlp;
use App\Similarity;
use Illuminate\Http\Request;
use Swift_LoadBalancedTransport;

class ChatbotController extends Controller
{

    public function index()
    {
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
        $totalcart = count($cart);
        return view('users.chatbot', ['totalcart' => $totalcart]);
    }


    public function chatbotchat(Request $request)
    {
        // PROSES NLP
        $data = Prosesnlp::where('users_id', '=', auth()->user()->id)->latest()->first();

        if ($data == null) {
            $prosesid = 1;
        } else {
            foreach ($data as $d) {
                $prosesid = $data->proses_id + 1;
            }
        }

        //merubah kalimat menjadi huruf kecil
        $pesan = strtolower($request->pesan);

        //Menghapus Karakter Lain Selain Huruf dan Angka
        $regex = "/[^a-zA-Z0-9]+/i";
        $pesanhasilregex = preg_replace($regex, " ", $pesan);

        //minghilangkan spasi duplicate dan merubahnya menjadi 1 spasi
        $pesan2spasi = trim(preg_replace('/\s+/', ' ', $pesanhasilregex));

        //pecah string berdasarkan string " "
        $pesandipecah = explode(" ", $pesan2spasi);

        // input kalimat ke tabel kalimat
        $kalimat = new Kalimat;
        $kalimat->users_id = auth()->user()->id;
        $kalimat->kalimat = $pesan2spasi;
        $kalimat->save();

        // menggambil id data kalimat terbaru yang di inputkan
        $idkalimat = 0;
        $datakalimat = Kalimat::where('users_id', '=', auth()->user()->id)->latest()->first();
        $idkalimat = $datakalimat->id;

        $arr_pesandipecah = count($pesandipecah);
        $bahasa = Kata::all();
        $token = 0;
        for ($i = 0; $i < $arr_pesandipecah; $i++) {
            $tblprosesnlp = new Prosesnlp;
            $tblprosesnlp->users_id = auth()->user()->id;
            $tblprosesnlp->proses_id = $prosesid;
            $tblprosesnlp->kalimat_id = $idkalimat;
            $tblprosesnlp->kata = $pesandipecah[$i];
            foreach ($bahasa as $p) {
                if ($pesandipecah[$i] == $p->kata) {
                    $token = 1;
                }
            }

            if ($token == 1) {
                $tblprosesnlp->token = 1;
            } else {
                $tblprosesnlp->token = 0;
            }
            $tblprosesnlp->save();
            $token = 0;
        }

        $dataprosesnlp = Prosesnlp::where('users_id', '=', auth()->user()->id)->where('kalimat_id', '=', $idkalimat)->where('token', '=', 1)->get();

        $aa = "";
        foreach ($dataprosesnlp as $dpnlp) {
            $aa = $aa . $dpnlp->kata . " ";
        }

        $dataaturan = Aturan::all();

        $parser = "";
        foreach ($dataaturan as $da) {
            if ($aa == $da->aturanproduksi) {
                $parser = $da->tag;
            }
        }

        $datakalimat2 = Kalimat::find($idkalimat);
        $datakalimat2->parsing = $parser;
        $datakalimat2->save();

        $datakalimat3 = Kalimat::find($idkalimat);



        if ($datakalimat3->parsing == "aturan1") {
            return response()->json(['pesan' => "aturan1"], 200);
        }
        if ($datakalimat3->parsing == "aturan2") {
            return response()->json(['pesan' => "aturan2"], 200);
        }
        if ($datakalimat3->parsing == "aturan3") {
            return response()->json(['pesan' => "aturan3"], 200);
        }
        if ($datakalimat3->parsing == "aturan4") {
            return response()->json(['pesan' => "aturan4"], 200);
        }
        if ($datakalimat3->parsing == "aturan5") {
            return response()->json(['pesan' => "aturan5"], 200);
        }
        if ($datakalimat3->parsing == "aturan6") {
            return response()->json(['pesan' => "aturan6"], 200);
        }
        if ($datakalimat3->parsing == "aturan7") {
            return response()->json(['pesan' => "aturan7"], 200);
        }



        //PROSES JACCARD SIMILARITY
        // $data = Similarity::where('users_id', '=', auth()->user()->id)->latest()->first();
        // if ($data == null) {
        //     $idtraining = 1;
        // } else {
        //     foreach ($data as $d) {
        //         $idtraining = $data->training_id + 1;
        //     }
        // }
        // //merubah kalimat menjadi huruf kecil
        // $chat = strtolower($request->pesan);

        // //Menghapus Karakter Lain Selain Huruf dan Angka
        // $regex = "/[^a-zA-Z0-9]+/i";
        // $chat = preg_replace($regex, " ", $chat);

        // //minghilangkan spasi duplicate dan merubahnya menjadi 1 spasi
        // $chat = trim(preg_replace('/\s+/', ' ', $chat));

        // //pecah string berdasarkan string " "
        // $chat = explode(" ", $chat);

        // $arr_chat = count($chat);
        // $datachat = Chatbot::all();
        // //$kesamaan = 0;
        // foreach ($datachat as $p) {
        //     $kesamaan = 0;
        //     $ss = $p->chat;
        //     $ss = explode(" ", $ss);
        //     $arr_balas = count($ss);
        //     for ($i = 0; $i < $arr_chat; $i++) {
        //         for ($j = 0; $j < $arr_balas; $j++) {
        //             if ($chat[$i] == $ss[$j]) {
        //                 $kesamaan += 1;
        //             }
        //         }
        //     }

        //     $totalsimilarity = $kesamaan / (($arr_chat + $arr_balas) - $kesamaan);
        //     $tablesimilarity = new Similarity;
        //     $tablesimilarity->users_id = auth()->user()->id;
        //     $tablesimilarity->training_id = $idtraining;
        //     $tablesimilarity->pesan = $request->pesan;
        //     $tablesimilarity->balas = $p->balas;
        //     $tablesimilarity->similarity = $totalsimilarity;
        //     $tablesimilarity->save();
        // }

        // $max = Similarity::where('users_id', '=', auth()->user()->id)->where('training_id', '=', $idtraining)->get();
        // $idmax = 0;
        // $hasilsimilarity = 0;
        // foreach ($max as $p) {
        //     if ($p->similarity >= $hasilsimilarity) {
        //         $idmax = $p->id;
        //         $hasilsimilarity = $p->similarity;
        //     }
        // }

        // if ($hasilsimilarity < 0.5) {
        //     $balas = "Mohon maaf, kami tidak mengerti apa yang anda maksudkan.";
        // } else {
        //     $datareturn = Similarity::where('id', '=', $idmax)->get();
        //     foreach ($datareturn as $datar) {
        //         $balas = $datar->balas;
        //     }
        // // }
        // $test = Order::where('users_id', '=', auth()->user()->id)->get();
        // $pesan = "";
        // foreach ($test as $a) {
        //     $pesan = $pesan . $a->id . " " . $a->nomerpesanan . " " . "<br>";
        // }
        //$berhasil = "berhasil";
        //$chat = Chatbot::where('chat', 'LIKE', '%' . $request->pesan . '%')->first();
        // return response()->json(['pesan' => $berhasil], 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Chatbot $chatbot)
    {
        //
    }

    public function edit(Chatbot $chatbot)
    {
        //
    }


    public function update(Request $request, Chatbot $chatbot)
    {
        //
    }


    public function destroy(Chatbot $chatbot)
    {
        //
    }
}
