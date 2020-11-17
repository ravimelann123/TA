<?php

namespace App\Http\Controllers;

use App\Chatbot;
use App\Cart;
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

        $data = Similarity::where('users_id', '=', auth()->user()->id)->latest()->first();
        if ($data == null) {
            $idtraining = 1;
        } else {
            foreach ($data as $d) {
                $idtraining = $data->training_id + 1;
            }
        }
        //merubah kalimat menjadi huruf kecil
        $chat = strtolower($request->pesan);

        //Menghapus Karakter Lain Selain Huruf dan Angka
        $regex = "/[^a-zA-Z0-9]+/i";
        $chat = preg_replace($regex, " ", $chat);

        //minghilangkan spasi duplicate dan merubahnya menjadi 1 spasi
        $chat = trim(preg_replace('/\s+/', ' ', $chat));

        //pecah string berdasarkan string " "
        $chat = explode(" ", $chat);

        $arr_chat = count($chat);
        $datachat = Chatbot::all();
        //$kesamaan = 0;
        foreach ($datachat as $p) {
            $kesamaan = 0;
            $ss = $p->chat;
            $ss = explode(" ", $ss);
            $arr_balas = count($ss);
            for ($i = 0; $i < $arr_chat; $i++) {
                for ($j = 0; $j < $arr_balas; $j++) {
                    if ($chat[$i] == $ss[$j]) {
                        $kesamaan += 1;
                    }
                }
            }

            $totalsimilarity = $kesamaan / (($arr_chat + $arr_balas) - $kesamaan);
            $tablesimilarity = new Similarity;
            $tablesimilarity->users_id = auth()->user()->id;
            $tablesimilarity->training_id = $idtraining;
            $tablesimilarity->pesan = $request->pesan;
            $tablesimilarity->balas = $p->balas;
            $tablesimilarity->similarity = $totalsimilarity;
            $tablesimilarity->save();
        }

        $max = Similarity::where('users_id', '=', auth()->user()->id)->where('training_id', '=', $idtraining)->get();
        $idmax = 0;
        $hasilsimilarity = 0;
        foreach ($max as $p) {
            if ($p->similarity >= $hasilsimilarity) {
                $idmax = $p->id;
                $hasilsimilarity = $p->similarity;
            }
        }

        if ($hasilsimilarity < 0.5) {
            $balas = "Mohon maaf, kami tidak mengerti apa yang anda maksudkan.";
        } else {
            $datareturn = Similarity::where('id', '=', $idmax)->get();
            foreach ($datareturn as $datar) {
                $balas = $datar->balas;
            }
        }


        //$chat = Chatbot::where('chat', 'LIKE', '%' . $request->pesan . '%')->first();
        return response()->json(['pesan' => $balas], 200);
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
