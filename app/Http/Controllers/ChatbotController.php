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
        return view('users.chatbot');
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

        $listkata = array(
            array("kata perintah", "tampilkan"),
            array("kata perintah", "pesan"),
            array("kata perintah", "batal"),
            array("kata perintah", "ubah"),
            array("operator", "seluruh"),
            array("atribut", "nomor"),
            array("atribut", "nama"),
            array("atribut", "harga"),
            array("atribut", "status"),
            array("kata", "jumlah"),
            array("kata", "biaya"),
            array("kata", "pesanan"),
            array("kata", "produk"),
            array("kata", "ditawarkan"),
            array("kata tanya", "kapan"),
            array("kata tanya", "apa"),
            array("kata tanya", "berapa"),
        );

        $listaturan = array(
            array("aturan1", "tampilkan seluruh produk"),
            array("aturan1", "tampilkan seluruh pesanan"),
            array("aturan1", "tampilkan nama produk"),
            array("aturan1", "tampilkan harga produk"),
            array("aturan1", "tampilkan nama harga produk"),
            array("aturan1", "tampilkan status pesanan"),
            array("aturan2", "pesan"),
            array("aturan3", "batal pesanan nomor"),
            array("aturan4", "ubah pesanan"),
            array("aturan5", "berapa jumlah pesanan"),
            array("aturan5", "berapa jumlah biaya pesanan"),
            array("aturan6", "kapan pesanan nomor"),
            array("aturan7", "apa pesanan nomor"),
            array("aturan7", "apa produk ditawarkan"),
        );
        // menggambil id data kalimat terbaru yang di inputkan
        $idkalimat = 0;
        $datakalimat = Kalimat::where('users_id', '=', auth()->user()->id)->latest()->first();
        $idkalimat = $datakalimat->id;
        $arr_pesandipecah = count($pesandipecah);

        $token = 0;
        for ($i = 0; $i < $arr_pesandipecah; $i++) {
            $tblprosesnlp = new Prosesnlp;
            $tblprosesnlp->users_id = auth()->user()->id;
            $tblprosesnlp->proses_id = $prosesid;
            $tblprosesnlp->kalimat_id = $idkalimat;
            $tblprosesnlp->kata = $pesandipecah[$i];
            for ($baris = 0; $baris < count($listkata); $baris++) {
                if ($pesandipecah[$i] == $listkata[$baris][1]) {
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

        $dataprosesnlp_token = Prosesnlp::where('users_id', '=', auth()->user()->id)->where('kalimat_id', '=', $idkalimat)->where('token', '=', 1)->get();

        $kalimat = "";
        foreach ($dataprosesnlp_token as $dpnlp) {
            $kalimat = $kalimat . $dpnlp->kata . " ";
        }
        $kalimat = trim(preg_replace('/\s+/', ' ', $kalimat));

        //parser
        //$dataaturan = Aturan::all();
        $parser = "";
        //foreach ($dataaturan as $da) {
        for ($baris = 0; $baris < count($listaturan); $baris++) {
            if ($kalimat == $listaturan[$baris][1]) {
                $parser = $listaturan[$baris][0];
            }
        }
        //}

        $datakalimat1 = Kalimat::find($idkalimat);
        $datakalimat1->parsing = $parser;
        $datakalimat1->save();

        // create variabel
        $pesan = "";
        $flag = 0;
        $nama = 0;
        $harga = 0;
        $status = 0;
        $seluruh = 0;
        $nomer = "";
        $id = 0;
        $jumlah = 0;
        //get data tabel
        $dataprodukall = Produk::all();
        $dataorder_users_id = Order::Where('users_id', '=', auth()->user()->id)->get();
        $dataorder_satu_terbaru = Order::Where('users_id', '=', auth()->user()->id)->latest()->first();
        $dataprosesnlpall = Prosesnlp::where('users_id', '=', auth()->user()->id)->where('kalimat_id', '=', $idkalimat)->get();
        //aturan 1
        //         tampilkan
        // - tampilkan seluruh daftar pesanan saya
        // - tampilkan seluruh daftar produk yang ada
        // - tampilakn nama produk, harga
        // - tampilkan status pesanan nomer NMT13929
        if ($datakalimat1->parsing != null) {
            if ($datakalimat1->parsing == "aturan1") {

                foreach ($dataprosesnlp_token as $p) {
                    if ($p->kata == "tampilkan") {
                        $flag = 1;
                    }
                    if ($p->kata == "nama") {
                        $nama = 1;
                    }
                    if ($p->kata == "harga") {
                        $harga = 1;
                    }
                    if ($p->kata == "status") {
                        $status = 1;
                    }
                    if ($p->kata == "seluruh") {
                        $seluruh = 1;
                    }
                }

                if ($flag == 1) {
                    if ($kalimat == "tampilkan seluruh produk" || $kalimat == "tampilkan nama harga produk" || $kalimat == "tampilkan nama produk" || $kalimat == "tampilkan harga produk") {
                        foreach ($dataprodukall as $p) {
                            if ($seluruh == 1) {
                                $pesan = $pesan . "Nama Produk " . $p->nama . " harga " . $p->harga . " Deskripsi " . $p->deskripsi . "<br>";
                            } elseif ($harga == 1 && $seluruh != 1 && $nama == 1) {
                                $pesan = $pesan . "Nama Produk " . $p->nama . " harga " . $p->harga .  "<br>";
                            } elseif ($nama == 1 && $seluruh != 1) {
                                $pesan = $pesan . "Nama Produk " . $p->nama .  "<br>";
                            } elseif ($harga == 1 && $seluruh != 1) {
                                $pesan = $pesan . "Nama Produk " . $p->nama . " harga " . $p->harga .  "<br>";
                            }
                        }
                        return response()->json(['pesan' => $pesan], 200);
                    } elseif ($kalimat == "tampilkan seluruh pesanan" || $kalimat == "tampilkan status pesanan") {

                        foreach ($dataorder_users_id as $p) {
                            if ($seluruh == 1) {
                                $pesan = $pesan . "Nomer Pesanan " . $p->nomerpesanan . " Total Biaya Rp. " . $p->total . " Status " . $p->status . "<br>";
                            } elseif ($status == 1 && $seluruh != 1) {
                                $pesan = $pesan . "Nomer Pesanan " . $p->nomerpesanan . " Status " . $p->status . "<br>";
                            }
                        }
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $pesan = "Maaf, Kami tidak mengerti pesan yang anda masukkan";
                        return response()->json(['pesan' => $pesan], 200);
                    }
                }
            }

            //aturan 2
            // pesan
            // - saya mau pesan kue b10 :10, b5 : 5...
            elseif ($datakalimat1->parsing == "aturan2") {

                $order = new Order;
                $order->nomerpesanan = "o" . date("Ymds") . auth()->user()->id;
                $order->users_id = auth()->user()->id;
                $order->proses_id = $prosesid;
                $order->status = "Menunggu Diproses";
                $order->save();
                $pesan = "Pesanan Dengan Nomer " . $order->nomerpesanan . " isi kue :";
                $totalharga = 0;
                for ($i = 0; $i < $arr_pesandipecah; $i++) {
                    foreach ($dataprodukall as $produk) {
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
                            $flag = 1;
                        }
                    }
                }
                if ($flag != 1) {
                    $orderbatal = Order::find($order->id);
                    $orderbatal->delete();
                    $pesan = "Kami Tidak Menemukan Produk Yang mau anda pesan";
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $order->total = $totalharga;
                    $order->save();
                    $pesan = $pesan . "<br>Berhasil dibuat, terima kasih sudah memesan melalui layanan chatbot.";
                    return response()->json(['pesan' => $pesan], 200);
                }
            }

            //aturan 3
            // batalkan
            // - batalkan pesanan bernomor NMT13929
            elseif ($datakalimat1->parsing == "aturan3") {

                for ($i = 0; $i < $arr_pesandipecah; $i++) {
                    foreach ($dataorder_users_id as $order) {
                        if ($pesandipecah[$i] == $order->nomerpesanan) {
                            $nomer = $nomer . $order->nomerpesanan;
                            $findorder = Order::find($order->id);
                            if ($findorder->status != "Menunggu Diproses") {
                                $pesan = "Pesanan dengan Nomer Pesanan<br><b>" . $nomer . "</b><br> Tidak dapat dibatalkan,<br> karena pesanan sudah diproses.";
                                return response()->json(['pesan' => $pesan], 200);
                            } else {
                                OrderDetail::where('order_id', '=', $order->id)->delete();
                                $findorder->delete();
                                $pesan = "Pesanan dengan Nomer Pesanan<br><b>" . $nomer . "</b><br>Berhasil Dibatalkan";
                                return response()->json(['pesan' => $pesan], 200);
                            }
                        }
                    }
                }
            }

            //aturan 4
            // ubah
            // - ubah pesanan hari ini kue b10:5,b5:10...
            elseif ($datakalimat1->parsing == "aturan4") {
                if ($dataorder_satu_terbaru == null) {
                    $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $id = $dataorder_satu_terbaru->id;
                    $getddorder = OrderDetail::Where('order_id', '=', $id)->get();
                    $id = 0;
                    for ($i = 0; $i < $arr_pesandipecah; $i++) {
                        foreach ($getddorder as $order) {
                            if ($pesandipecah[$i] == $order->produk->nama) {
                                $id = $order->id;
                                $update = OrderDetail::find($id);
                                $update->jumlah = $pesandipecah[$i + 1];
                                $update->save();
                                $flag = 1;
                            }
                        }
                    }
                    if ($flag != 1) {
                        $pesan = "Kami Tidak Menemukan Produk Yang mau dirubah";
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $pesan = "Pesanan Berhasil Diubah";
                        return response()->json(['pesan' => $pesan], 200);
                    }
                }
            }

            //aturan 5
            // berapa
            // - berapa jumlah pesanan hari ini
            // - berapa jumlah biaya pesanan hari ini
            elseif ($datakalimat1->parsing == "aturan5") {

                if ($kalimat == "berapa jumlah pesanan") {
                    if ($dataorder_satu_terbaru == null) {
                        $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $id = $dataorder_satu_terbaru->id;
                        $datadetailorder = OrderDetail::where('order_id', '=', $id)->get();
                        foreach ($datadetailorder as $gddo) {
                            $jumlah = $jumlah + $gddo->jumlah;
                        }
                        $pesan = $pesan . "Jumlah Pesanan Terbaru adalah " . $jumlah;
                        return response()->json(['pesan' => $pesan], 200);
                    }
                } else {
                    if ($dataorder_satu_terbaru == null) {
                        $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $pesan = $pesan . "Jumlah Biaya pesanan Terbaru adalah Rp." . $dataorder_satu_terbaru->total;
                        return response()->json(['pesan' => $pesan], 200);
                    }
                }
            }

            //aturan 6
            // kapan
            // - kapan pesanan nomer NMT13929 terjadi
            elseif ($datakalimat1->parsing == "aturan6") {

                foreach ($dataprosesnlpall as $p) {
                    foreach ($dataorder_users_id as $pp) {
                        if ($p->kata == $pp->nomerpesanan) {
                            $id = $pp->id;
                            $nomer = $pp->nomerpesanan;
                        }
                    }
                }

                $getddorder = Order::where('id', '=', $id)->get();
                $pesan = $pesan . " pesanan bernomor pesanan " . $nomer . "<br>terjadi pada ";
                foreach ($getddorder as $p) {
                    $pesan = $pesan . $p->created_at;
                }
                return response()->json(['pesan' => $pesan], 200);
            }

            //aturan 7
            //         apa
            // - apa saja isi pesanan nomer NMT13929
            // - apa saja produk yang di tawarkan
            elseif ($datakalimat1->parsing == "aturan7") {

                foreach ($dataprosesnlpall as $p) {
                    foreach ($dataorder_users_id as $pp) {
                        if ($p->kata == $pp->nomerpesanan) {
                            $id = $pp->id;
                            $nomer = $pp->nomerpesanan;
                        }
                    }
                }

                $pesan = "";
                if ($kalimat == "apa pesanan nomor") {
                    $getddorder = OrderDetail::where('order_id', '=', $id)->get();
                    $pesan = $pesan . "Isi pesanan bernomer pesanan " . $nomer . " adalah <br>";
                    foreach ($getddorder as $p) {
                        $pesan = $pesan . "nama kue " . $p->produk->nama . " jumlah " . $p->jumlah . "<br>";
                    }
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $pesan = $pesan . "Produk yang kami tawarkan adalah<br>";
                    foreach ($dataprodukall as $p) {
                        $pesan = $pesan . "nama kue " . $p->nama . " harga " . $p->harga . "<br>";
                    }
                    return response()->json(['pesan' => $pesan], 200);
                }
            }
            //jika tidak ada kondisi dari 7 aturan produksi
            else {
                $pesan = "Maaf, Kami tidak mengerti pesan yang anda masukkan";
                return response()->json(['pesan' => $pesan], 200);
            }
        } else {
            //PROSES JACCARD SIMILARITY
            $data = Similarity::where('users_id', '=', auth()->user()->id)->latest()->first();
            if ($data == null) {
                $idtraining = 1;
            } else {
                foreach ($data as $d) {
                    $idtraining = $data->training_id + 1;
                }
            }
            // //merubah kalimat menjadi huruf kecil
            // $chat = strtolower($request->pesan);

            // //Menghapus Karakter Lain Selain Huruf dan Angka
            // $regex = "/[^a-zA-Z0-9]+/i";
            // $chat = preg_replace($regex, " ", $chat);

            // //minghilangkan spasi duplicate dan merubahnya menjadi 1 spasi
            // $chat = trim(preg_replace('/\s+/', ' ', $chat));

            //pecah string berdasarkan string " "
            $chat = explode(" ", $pesan2spasi);

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
                $tablesimilarity->proses_id = $prosesid;
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

            if ($hasilsimilarity <= 0.75) {
                $pesan = "Maaf, Kami tidak mengerti pesan yang anda masukkan";
                return response()->json(['pesan' => $pesan], 200);
            } else {
                $datareturn = Similarity::where('id', '=', $idmax)->get();
                foreach ($datareturn as $datar) {
                    $pesan = $datar->balas;
                }

                return response()->json(['pesan' => $pesan], 200);
            }
        }
    }

    public function indexdataset(Request $request)
    {
        if ($request->has('cari')) {
            $data = Chatbot::where('chat', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {

            $data = Chatbot::paginate(4);
        }
        return view('admin.dataset', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'chat' => 'required',
            'balas' => 'required'
        ]);
        $data = new Chatbot();
        $data->chat = $request->chat;
        $data->balas = $request->balas;
        $data->save();
        return redirect('/admin/dataset')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function getdatabyid($id)
    {
        $data = Chatbot::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'chat' => 'required',
            'balas' => 'required'
        ]);
        $data = Chatbot::find($request->id);
        $data->chat = $request->chat;
        $data->balas = $request->balas;
        $data->save();
        return redirect('/admin/dataset')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        $data = Chatbot::find($id);
        $data->delete();
        return redirect('/admin/dataset')->with('sukses', 'Data Berhasil Dihapus');
    }
}
