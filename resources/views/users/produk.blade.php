@extends('master.masterlayout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-3">
        <div class="col-md">
            <div class="card">
                <form method="GET" action="/dashboard">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Produk</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cari" placeholder="Cari">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-deck">
                            @foreach ( $photo as $p)
                            <div class="col-md-3">
                                <form action="/cart/addproduk/{{$p->produk->id}}" method="POST">
                                    {{ csrf_field() }}
                                    {{-- <label class="card-text text-center" style="text-transform: capitalize;"> --}}
                                    <div class="card mb-3">
                                        <img src="images/produk/{{$p->namafoto}}" class="card-img-top gambar"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <a href="#">
                                                <h5 class="card-title">{{$p->produk->nama}}</h5>
                                            </a>
                                            <p class="card-text">{{$p->produk->deskripsi}}</p>
                                            <div class="row">
                                                <div class="col text-left mt-2"> Rp.{{$p->produk->harga}}</div>
                                                <div class="col text-right mb-1 mt-1 "> <button class="btn btn-primary">
                                                        <i class="lnr lnr-cart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
