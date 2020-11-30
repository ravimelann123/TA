<?php

namespace App\Http\Controllers;

use App\Aturan;
use App\Chatbot;
use App\Cart;
use App\Kalimat;
use App\Kata;
use App\Order;
use App\OrderDetail;
use App\Produk;
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


        $prsnlp = Prosesnlp::where('kalimat_id', '=', $idkalimat)->get();

        //aturan 1
        //         tampilkan
        // - tampilkan seluruh daftar pesanan saya
        // - tampilkan seluruh daftar produk yang ada
        // - tampilakn nama produk, harga
        // - tampilkan status pesanan nomer NMT13929

        if ($datakalimat3->parsing == "aturan1") {
            return response()->json(['pesan' => "aturan1"], 200);
        }

        //aturan 2
        // pesan
        // - saya mau pesan kue b10 :10, b5 : 5...
        if ($datakalimat3->parsing == "aturan2") {
            $flag = 0;
            foreach ($prsnlp as $p) {
                if ($p->kata == "pesan") {
                    $flag = 1;
                }
            }

            if ($flag == 1) {
                $order = new Order;
                $order->nomerpesanan = "o" . date("Ymds") . auth()->user()->id;
                $order->users_id = auth()->user()->id;
                $order->status = "Menunggu Diproses";
                $order->save();
                $dataproduk = Produk::all();
                $pesan = "Pesanan Dengan Nomer " . $order->nomerpesanan . " isi kue :";
                $totalharga = 0;
                for ($i = 0; $i < $arr_pesandipecah; $i++) {

                    foreach ($dataproduk as $produk) {
                        if ($pesandipecah[$i] == $produk->nama) {
                            $pesan = $pesan . " <br> Kue " . $produk->nama;
                            $pesan = $pesan . " jumlah " . $pesandipecah[$i + 1];
                            $jumlahharga = $pesandipecah[$i + 1] * $produk->harga;
                            $totalharga = $totalharga + $jumlahharga;
                            $orderdetail = new OrderDetail;
                            $orderdetail->order_id = $order->id;
                            $orderdetail->produk_id = $produk->id;
                            $orderdetail->jumlah = $pesandipecah[$i + 1];
                            $orderdetail->save();
                        }
                    }
                }

                $order->total = $totalharga;
                $order->save();
                $pesan = $pesan . "<br>Berhasil dibuat, terima kasih sudah memesan melalui layanan chatbot.";
                return response()->json(['pesan' => $pesan], 200);
            }
        }

        //aturan 3
        // batalkan
        // - batalkan pesanan bernomor NMT13929
        if ($datakalimat3->parsing == "aturan3") {
            $flag = 0;
            foreach ($prsnlp as $p) {
                if ($p->kata == "batalkan") {
                    $flag = 1;
                }
            }
            if ($flag == 1) {

                $getdtorder = Order::Where('users_id', '=', auth()->user()->id)->get();
                for ($i = 0; $i < $arr_pesandipecah; $i++) {
                    $nomer = "";
                    foreach ($getdtorder as $order) {
                        if ($pesandipecah[$i] == $order->nomerpesanan) {
                            $nomer = $nomer . $order->nomerpesanan;
                            $findorder = Order::find($order->id);

                            OrderDetail::where('order_id', '=', $order->id)->delete();
                            $findorder->delete();
                        }
                    }
                }
                $pesan = "Pesanan dengan Nomer Pesanan" . $nomer . " Berhasil Dibatalkan";
                return response()->json(['pesan' => $pesan], 200);
            }
        }

        //aturan 4
        // ubah
        // - ubah pesanan hari ini kue b10:5,b5:10...
        if ($datakalimat3->parsing == "aturan4") {
            return response()->json(['pesan' => "aturan4"], 200);
        }

        //aturan 5
        // berapa
        // - berapa jumlah pesanan hari ini
        // - berapa jumlah biaya pesanan hari ini
        if ($datakalimat3->parsing == "aturan5") {
            $kalimat = "";
            foreach ($prsnlp as $p) {
                if ($p->token == 1) {
                    $kalimat = $kalimat . $p->kata . " ";
                }
            }

            $pesan = "";
            if ($kalimat == "berapa jumlah pesanan ") {
                $jumlah = 0;
                $getdtorder = Order::Where('users_id', '=', auth()->user()->id)->latest()->first();
                $id = $getdtorder->id;
                $getddorder = OrderDetail::where('order_id', '=', $id)->get();
                foreach ($getddorder as $gddo) {
                    $jumlah = $jumlah + $gddo->jumlah;
                }
                $pesan = $pesan . "Jumlah Pesanan Terbaru adalah " . $jumlah;
                return response()->json(['pesan' => $pesan], 200);
            } elseif ($kalimat == "berapa jumlah biaya pesanan ") {
                $getdtorder = Order::Where('users_id', '=', auth()->user()->id)->latest()->first();
                $pesan = $pesan . "Jumlah Biaya pesanan Terbaru adalah Rp." . $getdtorder->total;
                return response()->json(['pesan' => $pesan], 200);
            } else {
            }
        }

        //aturan 6
        // kapan
        // - kapan pesanan nomer NMT13929 terjadi
        if ($datakalimat3->parsing == "aturan6") {
            $kalimat = "";
            $getdtorder = Order::Where('users_id', '=', auth()->user()->id)->get();
            foreach ($prsnlp as $p) {
                foreach ($getdtorder as $pp) {
                    if ($p->kata == $pp->nomerpesanan) {
                        $id = $pp->id;
                        $nomer = $pp->nomerpesanan;
                    }
                }
                if ($p->token == 1) {
                    $kalimat = $kalimat . $p->kata . " ";
                }
            }

            $pesan = "";
            if ($kalimat == "kapan pesanan nomer ") {
                $getddorder = Order::where('id', '=', $id)->get();
                $pesan = $pesan . " pesanan bernomer pesanan " . $nomer . "<br>terjadi pada ";
                foreach ($getddorder as $p) {
                    $pesan = $pesan . $p->created_at;
                }
                return response()->json(['pesan' => $pesan], 200);
            } else {
            }
        }

        //aturan 7
        //         apa
        // - apa saja isi pesanan nomer NMT13929
        // - apa saja produk yang di tawarkan
        if ($datakalimat3->parsing == "aturan7") {
            $kalimat = "";


            $getdtorder = Order::Where('users_id', '=', auth()->user()->id)->get();
            foreach ($prsnlp as $p) {
                foreach ($getdtorder as $pp) {
                    if ($p->kata == $pp->nomerpesanan) {
                        $id = $pp->id;
                        $nomer = $pp->nomerpesanan;
                    }
                }
                if ($p->token == 1) {
                    $kalimat = $kalimat . $p->kata . " ";
                }
            }

            $pesan = "";
            if ($kalimat == "apa pesanan nomer ") {
                $getddorder = OrderDetail::where('order_id', '=', $id)->get();
                $pesan = $pesan . "Isi pesanan bernomer pesanan " . $nomer . " adalah <br>";
                foreach ($getddorder as $p) {
                    $pesan = $pesan . "nama kue " . $p->produk->nama . " jumlah " . $p->jumlah . "<br>";
                }
                return response()->json(['pesan' => $pesan], 200);
            } elseif ($kalimat == "apa produk ditawarkan ") {
                $getdtproduk = Produk::all();
                $pesan = $pesan . "Produk yang kami tawarkan adalah<br>";
                foreach ($getdtproduk as $p) {
                    $pesan = $pesan . "nama kue " . $p->nama . " harga " . $p->harga . "<br>";
                }
                return response()->json(['pesan' => $pesan], 200);
            } else {
            }
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
