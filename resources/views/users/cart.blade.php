@extends('master.masterlayout')

@section('content')
<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <a href="/cart">
                                <h5>Keranjang</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="/cart/addproduk" method="post">
                                {{ csrf_field() }}
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <select name="produk" class="selectpicker" data-live-search="true">
                                            @foreach($data1 as $p)
                                            <option value="{{$p->id}}">{{$p->nama ." | Rp. ".$p->harga}}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn" type="submit" style="border-radius: 15px"><i
                                                class="fas fa-plus-square"></i></button>
                                    </div>
                                    <div class="col-6 text-right">
                                        Hapus Semua Produk
                                        <a href="/clearcart" class="btn" style="border-radius: 15px; color: red;">
                                            <i class="lnr lnr-trash"></i></a>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Opsi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="/ordercart/{{auth()->user()->id}}" method="POST">
                                                {{ csrf_field() }}
                                                @foreach ($data as $no=>$d)
                                                <tr>
                                                    <td>{{$no+1}}</td>
                                                    <td>{{$d->produk->nama}} <input type="hidden" name="produk_id[]"
                                                            value="{{$d->produk_id}}" class="form-control"></td>
                                                    <td><input type="text" name="jumlah[]" style="width:100px;"
                                                            placeholder=" {{$d->jumlah}}" class="form-control"></td>
                                                    <td>Rp. {{$d->produk->harga}}</td>
                                                    <td class="text-right"> <a href="/clearcartitem/{{$d->id}}"
                                                            class="btn" style="border-radius: 15px; color: red;">
                                                            <i class="lnr lnr-cross"></i></a></td>
                                                </tr>
                                                @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button class="btn btn-primary">
                                        Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
