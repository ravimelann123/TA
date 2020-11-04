<?php

namespace App\Http\Controllers;

use App\Chatbot;
use App\Cart;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{

    public function index()
    {
        $cart = Cart::where('users_id', '=', auth()->user()->id)->get();
        $totalcart = count($cart);
        return view('users.chatbot', ['totalcart' => $totalcart]);
    }

    public function index1()
    {
        $msg = "siapa nama kamu";
        $dataakun = Chatbot::where('chat', 'LIKE', '%' . $msg . '%')->get();
        dd($dataakun);
    }


    public function chatbotchat(Request $request)
    {
        $chat = Chatbot::where('chat', 'LIKE', '%' . $request->pesan . '%')->first();
        return response()->json(['pesan' => $chat], 200);
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
