<?php

namespace App\Http\Controllers;

use App\Aturan;
use App\Chatbot;
use App\Cart;
use App\Dataset;
use App\Kalimat;
use App\Kata;
use App\Order;
use DB;
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
        $number = 1;
        //get data tabel
        $dataprodukall = Produk::all();
        // $dataorder_satu_terbaru = Order::Where('users_id', '=', auth()->user()->id)->latest()->first();
        $dataprosesnlpall = Prosesnlp_detail::where('prosesnlp_id', '=', $tblprosesnlp->id)->get();

        $data = Auth::user()->kalimat()->with('order')->get();
        $orders = $data->pluck('order');
        $orders = $orders->filter();

        $data1 = Auth::user()->kalimat()->with('order')->latest()->get();
        $orders1 = $data1->pluck('order');
        $orders1 = $orders1->filter()->first();
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

                        $pesan = $pesan . "<b>-List Data-</b><br>";
                        foreach ($dataprodukall as $p) {
                            if ($seluruh == 1) {
                                $pesan = $pesan . $number . ". Kode: " . $p->kode . "<br> Nama: " . $p->nama . "<br>Harga:  " . $p->harga . "<br>Deskripsi: <br>" . $p->deskripsi . "<br>";
                                $number++;
                            } elseif ($nama == 1 && $seluruh != 1) {
                                $pesan = $pesan . $number . ". " . $p->nama .  "<br>";
                                $number++;
                            } elseif ($harga == 1 && $seluruh != 1) {
                                $pesan = $pesan .  $number . ". " . "Nama:  " . $p->nama . "<br>Harga: " . $p->harga .  "<br>";
                                $number++;
                            } elseif ($kode == 1 && $seluruh != 1) {
                                $pesan = $pesan . $number . ". " . "Kode: <b>[" . $p->kode . "]</b> <br>Nama: " . $p->nama .  "<br>";
                                $number++;
                            }
                        }
                        $number = 0;
                        return response()->json(['pesan' => $pesan], 200);
                    } elseif ($kalimat == "tampilkan seluruh pesanan" || $kalimat == "tampilkan status pesanan") {

                        if (count($orders) == 0) {
                            $pesan = "Silahkan lakukan pemesanan terlebih dahulu<br>dengan format sebagai berikut.
                            <br>Pesan kue [<b>Kode kue 1</b>]: [<b>Jumlah</b>], [<b>Kode kue 2</b>]: [<b>Jumlah</b>], Dll..";
                            return response()->json(['pesan' => $pesan], 200);
                        } else {
                            $pesan = $pesan . "<b>-List Data-</b><br>";
                            foreach ($orders as $p) {
                                if ($seluruh == 1) {
                                    $pesan = $pesan . $number . ". " . "Nomer Pesanan:  " . $p->id . "<br>Total Biaya: Rp. " . $p->total . "<br>Status:  " . $p->status . "<br>";
                                    $number++;
                                } elseif ($status == 1 && $seluruh != 1) {
                                    $pesan = $pesan . $number . ". " . "Nomer Pesanan: " . $p->id . "<br>Status: " . $p->status . "<br>";
                                    $number++;
                                }
                            }
                            $number = 0;
                            return response()->json(['pesan' => $pesan], 200);
                        }
                    } else {
                        $pesan = "Mohon Maaf, Saya tidak mengerti maksud anda.";
                        return response()->json(['pesan' => $pesan], 200);
                    }
                }
            }

            //aturan 2
            // pesan
            // - saya mau pesan kue b10 :10, b5 : 5...
            elseif ($dataparsing->parsing == "aturan2") {

                $order = new Order;
                $order->id = "inv" . date("ms") . auth()->user()->id;
                // $order->users_id = auth()->user()->id;
                $order->prosesnlp_id = $tblprosesnlp->id;
                $order->status = "Menunggu Diproses";
                $order->save();
                $pesan = "Nomor Pesanan : " . $order->id;
                $totalharga = 0;
                for ($i = 0; $i < $arr_pesandipecah; $i++) {
                    foreach ($dataprodukall as $produk) {
                        if ($pesandipecah[$i] == $produk->kode) {
                            $pesan = $pesan . "<br>" . $number . ". Kode<b>[" . $produk->kode . "]</b>";
                            $pesan = $pesan . " jumlah " . $pesandipecah[$i + 1];
                            $jumlahharga = $pesandipecah[$i + 1] * $produk->harga;
                            $totalharga = $totalharga + $jumlahharga;
                            $orderdetail = new OrderDetail;
                            $orderdetail->order_id = $order->id;
                            $orderdetail->produk_id = $produk->id;
                            $orderdetail->jumlah = $pesandipecah[$i + 1];
                            $orderdetail->save();
                            $flag = 1;
                            $number++;
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
                    $number = 0;
                    $pesan = $pesan . "<br>Terima kasih telah melakukan pemesanan.";
                    return response()->json(['pesan' => $pesan], 200);
                }
            }

            //aturan 3
            // batal
            // - batalkan\\\ pesanan bernomor NMT13929
            elseif ($dataparsing->parsing == "aturan3") {
                $z = 0;
                for ($i = 0; $i < $arr_pesandipecah; $i++) {
                    foreach ($orders as $order) {
                        if ($pesandipecah[$i] == $order->id) {
                            $nomer =  $order->id;
                            $findorder = Order::find($order->id);
                            if ($findorder->status == "Menunggu Diproses") {
                                OrderDetail::where('order_id', '=', $order->id)->delete();
                                $findorder->delete();
                                $pesan = "Nomer Pesanan: <b>" . $nomer . "</b><br>Berhasil Dibatalkan, Terima kasih.";
                                return response()->json(['pesan' => $pesan], 200);
                            } else {
                                $flag = 1;
                            }
                        } else {
                            $z = $z + 1;
                        }
                    }
                }
                if ($flag == 1) {
                    $pesan = "Nomor Pesanan: <b>" . $nomer . "</b> <br>Tidak dapat dibatalkan,<br>
                    Karena pesanan sudah diproses.<br>sihlahkan lakukan perubahan jika ingin merubah pemesanan.<br>
                    <br>Ubah pesanan [<b>Kode kue 1</b>]: [<b>Jumlah</b>], [<b>Kode kue 2</b>]: [<b>Jumlah</b>], Dll..";
                    return response()->json(['pesan' => $pesan], 200);
                }
                if ($z < 1) {
                    $pesan = "Pesanan tidak ditemukan";
                    return response()->json(['pesan' => $pesan], 200);
                }
            }

            //aturan 4
            // ubah
            // - ubah pesanan hari ini kue b10:5,b5:10...
            elseif ($dataparsing->parsing == "aturan4") {

                //return response()->json(['pesan' => 'test'], 200);
                if ($orders1 == null) {
                    $pesan = "Anda belum pernah melakukan pemesanan,<br>Silahkan Lakukan Pemesanan dengan format.
                    <br>Pesan kue [<b>Kode kue 1</b>]: [<b>Jumlah</b>], [<b>Kode kue 2</b>]: [<b>Jumlah</b>], Dll..";
                    return response()->json(['pesan' => $pesan], 200);
                } else {

                    $getddorder = OrderDetail::Where('order_id', '=', $orders1->id)->get();
                    for ($i = 0; $i < $arr_pesandipecah; $i++) {
                        foreach ($getddorder as $order) {
                            if ($pesandipecah[$i] == $order->produk->kode) {
                                $idproduk = Produk::where('kode', '=', $pesandipecah[$i])->get();
                                foreach ($idproduk as $a) {
                                    $asd = $a->id;
                                }

                                // $pesan = $pesandipecah[$i + 1];
                                DB::update('update orderdetail set jumlah = ? where order_id = ? and produk_id =?', [$pesandipecah[$i + 1], $orders1->id, $asd]);
                                // $update = OrderDetail::whete('order_id', '=', $orders1->id)->where('produk_id', '=', $pesandipecah[$i])->get();
                                // $update->jumlah = $pesandipecah[$i + 1];
                                // $update->save();
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
                    if ($orders1 == null) {
                        $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $id = $orders1->id;
                        $datadetailorder = OrderDetail::where('order_id', '=', $id)->get();
                        foreach ($datadetailorder as $gddo) {
                            $jumlah = $jumlah + $gddo->jumlah;
                        }
                        $pesan = $pesan . "Jumlah Pesanan Terbaru adalah " . $jumlah;
                        return response()->json(['pesan' => $pesan], 200);
                    }
                } else {
                    if ($orders1 == null) {
                        $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $pesan = $pesan . "Jumlah Biaya pesanan Terbaru adalah Rp." . $orders1->total;
                        return response()->json(['pesan' => $pesan], 200);
                    }
                }
            }

            //aturan 6
            // kapan
            // - kapan pesanan nomer NMT13929 terjadi
            elseif ($dataparsing->parsing == "aturan6") {

                foreach ($dataprosesnlpall as $p) {
                    foreach ($orders as $pp) {
                        if ($p->kata == $pp->id) {
                            $id = $pp->id;
                        }
                    }
                }

                $getddorder = Order::where('id', '=', $id)->get();
                $pesan = $pesan . " pesanan nomor: " . $id . "<br>terjadi pada: ";
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
                        }
                    }
                }

                $pesan = "";
                if ($kalimat == "apa pesanan nomor") {
                    $getddorder = OrderDetail::where('order_id', '=', $id)->get();
                    $pesan = $pesan . "pesanan nomor : " . $id . " <br> Berikut daftar produk : <br>";
                    foreach ($getddorder as $p) {
                        $pesan = $pesan . $number . ". <b>[" . $p->produk->kode . "]</b> " . $p->produk->nama . "<br>jumlah: " . $p->jumlah . "<br>";
                        $number++;
                    }
                    $number = 0;
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $pesan = $pesan . "<b>-List data Produk-</b><br>";
                    foreach ($dataprodukall as $p) {
                        $pesan = $pesan . $number . ". <b>[" . $p->kode . "]</b> " . $p->nama . " <br>Harga: " . $p->harga . "<br>";
                        $number++;
                    }
                    $number = 0;
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
