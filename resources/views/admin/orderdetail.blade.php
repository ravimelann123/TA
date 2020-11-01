@extends('master.masterlayout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-3">
        @include('master.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item"><a href="/indexorder">Pesanan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-right">
                            <a href="#" class="btn"><i class="fas fa-file-pdf"></i></a>

                            <a href="#" class="btn"><i class="fas fa-print"></i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderdetail as $p)
                                        <tr>
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
@endsection
