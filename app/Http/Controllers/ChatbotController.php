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
        //merubah kalimat menjadi huruf kecil
        $chat = strtolower($request->pesan);

        //Menghapus Karakter Lain Selain Huruf dan Angka
        $regex = "/[^a-zA-Z0-9]+/i";
        $chat = preg_replace($regex, " ", $chat);

        //pecah string berdasarkan string " "
        $chat = explode(" ", $chat);

        $arr_chat = count($chat);
        $datachat = Chatbot::all();
        //$kesamaan = 0;
        foreach ($datachat as $p) {
            $kesamaan = 0;
            $ss = $p->balas;
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
            $tablesimilarity->pesan = $request->pesan;
            $tablesimilarity->balas = $p->balas;
            $tablesimilarity->similarity = $totalsimilarity;
            $tablesimilarity->save();
        }


        //$chat = Chatbot::where('chat', 'LIKE', '%' . $request->pesan . '%')->first();
        return response()->json(['pesan' => $totalsimilarity], 200);
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
