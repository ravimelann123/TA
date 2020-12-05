@extends('master.masterlayout')
@section('content')


<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">halaman Utama</a></li>
                            <li class="breadcrumb-item"><a href="/pesanan">Pesanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">

                            <h5>Pesanan</h5>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderdetail as $no=>$p)
                                                <tr>
                                                    <td>{{$no+1}}</td>
                                                    <td>{{$p->produk->nama}}</td>
                                                    <td>{{$p->jumlah}}</td>
                                                    <td>{{$p->produk->harga}}</td>
                                                    <td>{{$p->jumlah * $p->produk->harga}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
