<?php

namespace App\Http\Controllers;

use App\Aturan;
use App\Chatbot;
use App\Cart;
use App\Dataset;
use App\Kalimat;
use App\Kata;
use App\Order;
use App\OrderDetail;
use App\Produk;
use App\Prosesnlp;
use App\Prosesnlp_detail;
use App\Similarity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Swift_LoadBalancedTransport;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{

    public function index()
    {
        return view('users.chatbot');
    }


    public function chatbotchat(Request $request)
    {

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
            array("kata", "kode"),
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
            array("aturan1", "tampilkan kode produk"),
            array("aturan1", "tampilkan nama produk"),
            array("aturan1", "tampilkan harga produk"),
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

        // PROSES NLP
        // $data = Prosesnlp::latest()->first();
        // $prosesid = 0;
        // if ($data == null) {
        //     $prosesid = 1;
        // } else {
        //     $prosesid = $data->proses_id + 1;
        // }

        // menggambil id data kalimat terbaru yang di inputkan
        $idkalimat = 0;
        $datakalimat = Kalimat::where('users_id', '=', auth()->user()->id)->latest()->first();
        $idkalimat = $datakalimat->id;
        $arr_pesandipecah = count($pesandipecah);

        $tblprosesnlp = new Prosesnlp;
        // $tblprosesnlp->proses_id = $prosesid;
        $tblprosesnlp->kalimat_id = $idkalimat;
        $tblprosesnlp->save();
        $token = 0;
        for ($i = 0; $i < $arr_pesandipecah; $i++) {

            $prosesnlp_detail = new Prosesnlp_detail;
            $prosesnlp_detail->kata = $pesandipecah[$i];
            $prosesnlp_detail->prosesnlp_id = $tblprosesnlp->id;
            for ($baris = 0; $baris < count($listkata); $baris++) {
                if ($pesandipecah[$i] == $listkata[$baris][1]) {
                    $token = 1;
                }
            }
            if ($token == 1) {
                $prosesnlp_detail->token = 1;
            } else {
                $prosesnlp_detail->token = 0;
            }
            $prosesnlp_detail->save();
            $token = 0;
        }

        $dataprosesnlp_token = Prosesnlp_detail::where('prosesnlp_id', '=', $tblprosesnlp->id)->where('token', '=', 1)->get();
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

        $dataparsing = Prosesnlp::find($tblprosesnlp->id);
        $dataparsing->parsing = $parser;
        $dataparsing->save();

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

        // $dataorder_users_id_count = count($dataorder_users_id);
        // $dataorder_satu_terbaru = Order::Where('users_id', '=', auth()->user()->id)->latest()->first();
        $dataprosesnlpall = Prosesnlp_detail::where('prosesnlp_id', '=', $tblprosesnlp->id)->get();

        $data = Auth::user()->kalimat()->with('order')->get();
        $orders = $data->pluck('order');
        $orders = $orders->filter();
        $dataorder_users_id = count($orders);

        // $dataorder_users_id = Order::whereIn('id', $orders->pluck('id'));


        //aturan 1
        //         tampilkan
        // - tampilkan seluruh daftar pesanan saya
        // - tampilkan seluruh daftar produk yang ada
        // - tampilakn nama produk, harga
        // - tampilkan status pesanan nomer NMT13929
        if ($dataparsing->parsing != null) {
            if ($dataparsing->parsing == "aturan1") {

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
                    if ($p->kata == "kode") {
                        $kode = 1;
                    }
                    if ($p->kata == "status") {
                        $status = 1;
                    }
                    if ($p->kata == "seluruh") {
                        $seluruh = 1;
                    }
                }

                if ($flag == 1) {
                    if ($kalimat == "tampilkan seluruh produk"  || $kalimat == "tampilkan nama produk" || $kalimat == "tampilkan harga produk" || $kalimat == "tampilkan kode produk") {
                        foreach ($dataprodukall as $p) {
                            if ($seluruh == 1) {
                                $pesan = $pesan . "Kode Produk " . $p->kode . "Nama Produk " . $p->nama . " harga " . $p->harga . " Deskripsi " . $p->deskripsi . "<br>";
                            } elseif ($nama == 1 && $seluruh != 1) {
                                $pesan = $pesan . "Nama Produk " . $p->nama .  "<br>";
                            } elseif ($harga == 1 && $seluruh != 1) {
                                $pesan = $pesan . "Nama Produk " . $p->nama . " harga " . $p->harga .  "<br>";
                            } elseif ($kode == 1 && $seluruh != 1) {
                                $pesan = $pesan . "Kode <b>(" . $p->kode . " )</b> Nama :" . $p->nama .  "<br>";
                            }
                        }
                        return response()->json(['pesan' => $pesan], 200);
                    } elseif ($kalimat == "tampilkan seluruh pesanan" || $kalimat == "tampilkan status pesanan") {



                        if ($dataorder_users_id == 0) {
                            $pesan = "Maaf, Kami tidak menemukan pesanan yang pernah anda lakukan";
                            return response()->json(['pesan' => $pesan], 200);
                        } else {

                            foreach ($orders as $p) {
                                if ($seluruh == 1) {
                                    $pesan = $pesan . "Nomer Pesanan " . $p->id . " Total Biaya Rp. " . $p->total . " Status " . $p->status . "<br>";
                                } elseif ($status == 1 && $seluruh != 1) {
                                    $pesan = $pesan . "Nomer Pesanan " . $p->id . " Status " . $p->status . "<br>";
                                }
                            }
                            return response()->json(['pesan' => $pesan], 200);
                        }
                    } else {
                        $pesan = "Maaf, Kami tidak mengerti pesan yang anda masukkan";
                        return response()->json(['pesan' => $pesan], 200);
                    }
                }
            }

            //aturan 2
            // pesan
            // - saya mau pesan kue b10 :10, b5 : 5...
            elseif ($dataparsing->parsing == "aturan2") {

                $order = new Order;
                $order->id = "o" . date("Ymds");
                // $order->users_id = auth()->user()->id;
                $order->prosesnlp_id = $tblprosesnlp->id;
                $order->status = "Menunggu Diproses";
                $order->save();
                $pesan = "Pesanan Dengan Nomer " . $order->id . " isi kue :";
                $totalharga = 0;
                for ($i = 0; $i < $arr_pesandipecah; $i++) {
                    foreach ($dataprodukall as $produk) {
                        if ($pesandipecah[$i] == $produk->kode) {
                            $pesan = $pesan . " <br> Kode<b>(" . $produk->kode . ")</b>";
                            $pesan = $pesan . "Nama " . $produk->nama;
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
            elseif ($dataparsing->parsing == "aturan3") {

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
            elseif ($dataparsing->parsing == "aturan4") {
                if ($dataorder_satu_terbaru == null) {
                    $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $id = $dataorder_satu_terbaru->id;
                    $getddorder = OrderDetail::Where('order_id', '=', $id)->get();
                    $id = 0;
                    for ($i = 0; $i < $arr_pesandipecah; $i++) {
                        foreach ($getddorder as $order) {
                            if ($pesandipecah[$i] == $order->produk->kode) {
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
            elseif ($dataparsing->parsing == "aturan5") {

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
            elseif ($dataparsing->parsing == "aturan6") {

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
            elseif ($dataparsing->parsing == "aturan7") {

                foreach ($dataprosesnlpall as $p) {
                    foreach ($orders as $pp) {
                        if ($p->kata == $pp->id) {
                            $id = $pp->id;
                            $nomor = $pp->id;
                        }
                    }
                }

                $pesan = "";
                if ($kalimat == "apa pesanan nomor") {
                    $getddorder = OrderDetail::where('order_id', '=', $id)->get();
                    $pesan = $pesan . "Isi pesanan bernomor pesanan " . $nomor . " adalah <br>";
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
            // $data = Similarity::latest()->first();
            // if ($data == null) {
            //     $idtraining = 1;
            // } else {
            //     $idtraining = $data->training_id + 1;
            // }
            //pecah string berdasarkan string " "
            $chat = explode(" ", $pesan2spasi);
            $datachat = Dataset::all();
            foreach ($datachat as $p) {
                $ss = $p->chat;
                $ss = explode(" ", $ss);
                $result = array_intersect($chat, $ss);
                $result = count($result);
                $totalsimilarity = $result / (count($chat) + count($ss) - $result);
                $tablesimilarity = new Similarity;
                // $tablesimilarity->kalimat_id = $idkalimat;
                $tablesimilarity->prosesnlp_id = $tblprosesnlp->id;
                $tablesimilarity->dataset_id = $p->id;
                // $tablesimilarity->balas = $p->balas;
                $tablesimilarity->similarity = $totalsimilarity;
                $tablesimilarity->save();
            }

            $max = Similarity::where('prosesnlp_id', '=', $tblprosesnlp->id)->get();
            $idmax = 0;
            $hasilsimilarity = 0;
            foreach ($max as $p) {
                if ($p->similarity >= $hasilsimilarity) {
                    $idmax = $p->id;
                    $hasilsimilarity = $p->similarity;
                }
            }

            if ($hasilsimilarity == 0) {
                $pesan = "Maaf, Kami tidak mengerti pesan yang anda masukkan";
                return response()->json(['pesan' => $pesan], 200);
            } else {

                $datareturn = Similarity::where('id', '=', $idmax)->get();
                foreach ($datareturn as $d) {
                    $tbldataset = Dataset::where('id', '=', $d->dataset_id)->get();
                    foreach ($tbldataset as $tblds) {
                        $pesan = $tblds->balas;
                    }
                }
                return response()->json(['pesan' => $pesan], 200);
            }
        }
    }

    public function indexdataset(Request $request)
    {
        if ($request->has('cari')) {
            $data = Dataset::where('chat', 'LIKE', '%' . $request->cari . '%')->paginate(5);
        } else {
            $data = Dataset::paginate(5);
        }
        return view('admin.dataset', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'chat' => 'required',
            'balas' => 'required'
        ]);

        $dataset = Dataset::all();

        foreach ($dataset as $p) {
            if ($p->chat == $request->chat) {
                return Redirect::back()->with('delete', 'Dataset sudah ada');
            }
        }
        $data = new Dataset();
        $data->chat = $request->chat;
        $data->balas = $request->balas;
        $data->save();
        return redirect('/admin/dataset')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function getdatabyid($id)
    {
        $data = Dataset::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'chat' => 'required',
            'balas' => 'required'
        ]);
        $dataset = Dataset::all();
        foreach ($dataset as $p) {
            if ($p->chat == $request->chat) {
                return Redirect::back()->with('delete', 'Dataset sudah ada');
            }
        }
        $data = Dataset::find($request->id);
        $data->chat = $request->chat;
        $data->balas = $request->balas;
        $data->save();
        return redirect('/admin/dataset')->with('sukses', 'Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        $data = Dataset::find($id);
        $data->delete();
        return redirect('/admin/dataset')->with('sukses', 'Data Berhasil Dihapus');
    }
}
