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
use App\slangword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Swift_LoadBalancedTransport;
use Illuminate\Support\Facades\Auth;
use Sastrawi\Stemmer\StemmerFactory;

class ChatbotController extends Controller
{

    public function index()
    {
        return view('users.chatbot');
    }

    public function test()
    {
        $slangword = slangword::all();
        $sentence = "tampilkan seluruh";
        $pesandipecah = explode(" ", $sentence);
        $count = count($pesandipecah);
        foreach ($slangword as $a) {
            for ($i = 0; $i < $count; $i++) {
                if ($a->slangword == $pesandipecah[$i]) {
                    $pesandipecah[$i] = $a->formal;
                }
            }
        }
        echo $pesandipecah[0];
        // $slangword = slangword::all();

        // echo "slang word : " . $sentence . "<br>";
        // $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        // $stemmer = $stemmerFactory->createStemmer();
        // // stem

        // $output = $stemmer->stem($sentence);
        // echo "menjadi kata dasar : " . $output . "\n";
        // ekonomi indonesia sedang dalam tumbuh yang bangga

        // echo $stemmer->stem('Mereka meniru-nirukannya') . "\n";
        // mereka tiru
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
            array("kata perintah", "tampil"),
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
            array("kata", "mau"),
            array("kata", "produk"),
            array("kata", "ditawarkan"),
            array("kata tanya", "kapan"),
            array("kata tanya", "apa"),
            array("kata tanya", "berapa"),

        );

        $listaturan = array(
            array("aturan1", "tampil seluruh produk"),
            array("aturan1", "tampil seluruh pesan"),
            array("aturan1", "tampil kode produk"),
            array("aturan1", "tampil nama produk"),
            array("aturan1", "tampil harga produk"),
            array("aturan1", "tampil status pesan"),
            array("aturan2", "mau pesan"),
            array("aturan3", "batal pesan nomor"),
            array("aturan4", "ubah pesan"),
            array("aturan5", "berapa jumlah pesan"),
            array("aturan5", "berapa biaya pesan"),
            array("aturan6", "kapan pesan nomor"),
            array("aturan7", "apa pesan nomor"),
        );

        $slangword = slangword::all();
        // menggambil id data kalimat terbaru yang di inputkan
        $idkalimat = 0;
        $datakalimat = Kalimat::where('users_id', '=', auth()->user()->id)->latest()->first();
        $idkalimat = $datakalimat->id;
        $arr_pesandipecah = count($pesandipecah);

        foreach ($slangword as $a) {
            for ($i = 0; $i < $arr_pesandipecah; $i++) {
                if ($a->slangword == $pesandipecah[$i]) {
                    $pesandipecah[$i] = $a->formal;
                }
            }
        }

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
        $dataprosesnlpid = Prosesnlp_detail::where('prosesnlp_id', '=', $tblprosesnlp->id)->get();
        $dataprosesnlpall = Prosesnlp_detail::all();

        $data = Auth::user()->kalimat()->with('order')->get();
        $orders = $data->pluck('order');
        $orders = $orders->filter();

        $data1 = Auth::user()->kalimat()->with('order')->latest()->get();
        $orders1 = $data1->pluck('order');
        $orders1 = $orders1->filter()->first();
        //aturan 1
        //         tampilkan
        // - tampilkan seluruh daftar pesan saya
        // - tampilkan seluruh daftar produk yang ada
        // - tampilakn nama produk, harga
        // - tampilkan status pesan nomer NMT13929

        if ($dataparsing->parsing == "aturan1") {

            foreach ($dataprosesnlp_token as $p) {
                if ($p->kata == "tampil") {
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
                if ($kalimat == "tampil seluruh produk"  || $kalimat == "tampil nama produk" || $kalimat == "tampil harga produk" || $kalimat == "tampil kode produk") {

                    $pesan = $pesan . "<b>-List Data-</b><br>";
                    foreach ($dataprodukall as $p) {
                        if ($seluruh == 1) {
                            $pesan = $pesan . $number . ". Kode: " . $p->kode . " Nama: " . $p->nama . " Harga:  " . $p->harga . " <br>Deskripsi: " . $p->deskripsi . "<br>";
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
                } elseif ($kalimat == "tampil seluruh pesan" || $kalimat == "tampil status pesan") {

                    if (count($orders) == 0) {
                        $pesan = "Silahkan lakukan pemesanan terlebih dahulu<br>dengan format sebagai berikut.
                            <br>Pesan kue [<b>Kode kue 1</b>]: [<b>Jumlah</b>], [<b>Kode kue 2</b>]: [<b>Jumlah</b>], Dll..";
                        return response()->json(['pesan' => $pesan], 200);
                    } else {
                        $pesan = $pesan . "<b>-List Data-</b><br>";
                        foreach ($orders as $p) {
                            if ($seluruh == 1) {
                                $pesan = $pesan . $number . ". " . "Nomer pesan:  " . $p->id . "<br>Total Biaya: Rp. " . $p->total . "<br>Status:  " . $p->status . "<br>";
                                $number++;
                            } elseif ($status == 1 && $seluruh != 1) {
                                $pesan = $pesan . $number . ". " . "Nomer pesan: " . $p->id . "<br>Status: " . $p->status . "<br>";
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
            if (count($pesandipecah) < 4) {
                $pesan = "mau pesan apa? <br>Silahkan lakukan pemesanan menggunakan format sebagai berikut. <br>Pesan kue [Kode kue 1]: [Jumlah], [Kode kue 2]: [Jumlah], Dll..";
                return response()->json(['pesan' => $pesan], 200);
            }
            $order = new Order;
            $order->id = "inv" . date("ms") . auth()->user()->id;
            // $order->users_id = auth()->user()->id;
            $order->prosesnlp_id = $tblprosesnlp->id;
            $order->status = "Menunggu Diproses";
            $order->save();
            $pesan = "Nomor pesan : " . $order->id;
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
                $pesan = "Kami Tidak Menemukan Produk Yang mau anda pesan<br>cobalah ketikan [tampilkan semua produk] <br>untuk menampilkan daftar produk<br>lalu silahkan lakukan pemesanan menggunakan format sebagai berikut.
                Pesan kue [Kode kue 1]: [Jumlah], [Kode kue 2]: [Jumlah], Dll..";
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
        // - batal\\\ pesan bernomor NMT13929
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
                            $pesan = "Nomer pesan: <b>" . $nomer . "</b><br>Berhasil Dibatalkan, Terima kasih.";
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
                $pesan = "Nomor pesan: <b>" . $nomer . "</b> <br>Tidak dapat dibatalkan,<br>
                    Karena pesan sudah diproses.<br>sihlahkan lakukan perubahan jika ingin merubah pemesanan.<br>
                    <br>Ubah pesan [<b>Kode kue 1</b>]: [<b>Jumlah</b>], [<b>Kode kue 2</b>]: [<b>Jumlah</b>], Dll..";
                return response()->json(['pesan' => $pesan], 200);
            }
            if ($z < 1) {
                $pesan = "pesan tidak ditemukan";
                return response()->json(['pesan' => $pesan], 200);
            }
        }

        //aturan 4
        // ubah
        // - ubah pesan hari ini kue b10:5,b5:10...
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
                    $pesan = "pesan Berhasil Diubah";
                    return response()->json(['pesan' => $pesan], 200);
                }
            }
        }

        //aturan 5
        // berapa
        // - berapa jumlah pesan hari ini
        // - berapa jumlah biaya pesan hari ini
        elseif ($dataparsing->parsing == "aturan5") {

            if ($kalimat == "berapa jumlah pesan") {
                if ($orders1 == null) {
                    $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $id = $orders1->id;
                    $datadetailorder = OrderDetail::where('order_id', '=', $id)->get();
                    foreach ($datadetailorder as $gddo) {
                        $jumlah = $jumlah + $gddo->jumlah;
                    }
                    $pesan = $pesan . "Jumlah pesan Terbaru adalah " . $jumlah;
                    return response()->json(['pesan' => $pesan], 200);
                }
            } else {
                if ($orders1 == null) {
                    $pesan = "Anda Belum Pernah Melakukan Pemesanan";
                    return response()->json(['pesan' => $pesan], 200);
                } else {
                    $pesan = $pesan . "Jumlah Biaya pesan Terbaru adalah Rp." . $orders1->total;
                    return response()->json(['pesan' => $pesan], 200);
                }
            }
        }

        //aturan 6
        // kapan
        // - kapan pesan nomer NMT13929 terjadi
        elseif ($dataparsing->parsing == "aturan6") {

            foreach ($dataprosesnlpid as $p) {
                foreach ($orders as $pp) {
                    if ($p->kata == $pp->id) {
                        $id = $pp->id;
                        $flag = 1;
                    }
                }
            }
            $pesan = "";
            if ($flag == 1) {
                $getddorder = Order::where('id', '=', $id)->get();
                $pesan = $pesan . " pesan nomor: " . $id . "<br>terjadi pada: ";
                foreach ($getddorder as $p) {
                    $pesan = $pesan . $p->created_at;
                }
                return response()->json(['pesan' => $pesan], 200);
            }
            $pesan = $pesan . "nomor tidak ada";
            return response()->json(['pesan' => $pesan], 200);
        }


        //aturan 7
        //         apa
        // - apa saja isi pesan nomer NMT13929

        elseif ($dataparsing->parsing == "aturan7") {

            foreach ($dataprosesnlpid as $p) {
                foreach ($orders as $pp) {
                    if ($p->kata == $pp->id) {
                        $id = $pp->id;
                        $flag = 1;
                    }
                }
            }
            $pesan = "";
            if ($flag == 1) {
                $getddorder = OrderDetail::where('order_id', '=', $id)->get();
                $pesan = $pesan . "pesan nomor : " . $id . " <br> Berikut daftar produk : <br>";
                foreach ($getddorder as $p) {
                    $pesan = $pesan . $number . ". <b>[" . $p->produk->kode . "]</b> " . $p->produk->nama . "<br>jumlah: " . $p->jumlah . "<br>";
                    $number++;
                }
                $number = 0;
                return response()->json(['pesan' => $pesan], 200);
            } else {
                $pesan = $pesan . "nomor tidak ada";
                return response()->json(['pesan' => $pesan], 200);
            }
        }
        //jika tidak ada kondisi dari 7 aturan produksi
        // else {
        //     $pesan = "Maaf, Kami tidak mengerti pesan yang anda masukkan";
        //     return response()->json(['pesan' => $pesan], 200);
        // }
        elseif ($dataparsing->parsing == null) {
            //PROSES JACCARD SIMILARITY
            // $data = Similarity::latest()->first();
            // if ($data == null) {
            //     $idtraining = 1;
            // } else {
            //     $idtraining = $data->training_id + 1;
            // }
            //pecah string berdasarkan string " "

            //$chat = explode(" ", $pesan2spasi);

            $datachat = Dataset::all();
            foreach ($datachat as $p) {
                $ss = $p->chat;
                $ss = explode(" ", $ss);
                $result = array_intersect($pesandipecah, $ss);
                $result = count($result);
                $totalsimilarity = $result / (count($pesandipecah) + count($ss) - $result);
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
            $data = Dataset::where('chat', 'LIKE', '%' . $request->cari . '%')->paginate(4);
        } else {
            $data = Dataset::paginate(4);
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
        // $dataset = Dataset::all();
        // foreach ($dataset as $p) {
        //     if ($p->chat == $request->chat) {
        //         return Redirect::back()->with('delete', 'Dataset sudah ada');
        //     }
        // }
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
