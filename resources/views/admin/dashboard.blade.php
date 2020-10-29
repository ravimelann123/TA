@extends('master.masterlayout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center ">
        <div class="col-md-3 mb-3">
            <div class="card" style="min-height:85vh">
                {{-- <div class="card-header bg-white">
                </div> --}}
                <div class="card-body">
                    <div class="sidebar">
                        <a href="/dashboard" class="btn">Home</a>
                        <a class="dropdown-btn btn">Master
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container">
                            <a class="dropdown-item" href="/akun">Biodata</a>
                            <a class="dropdown-item" href="/users">Akun</a>
                            <a class="dropdown-item" href="/produk">Produk</a>
                            <a class="dropdown-item" href="/tambahstok">Tambah Stok</a>
                        </div>
                        <a href="/indexorder" class="btn">Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card" style="min-height:85vh">
                {{-- <div class="card-header bg-white">
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>Dashboard</h4>
                        </div>
                        <div class="col text-right" style="color: gray; font-size: 14px">Selamat datang.
                            {{auth()->user()->username}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md mb-3">
                            <div class=" card bg-primary" style=" color: white; border-radius: 10px">
                                <div class="card-body">
                                    <h5>{{$akun}}</h5>
                                </div>
                                <div class="card-footer">
                                    Data Akun Pelanggan
                                </div>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="card bg-primary" style=" color: white; border-radius: 10px">
                                <div class="card-body">
                                    <h5>{{$order}}</h5>
                                </div>
                                <div class="card-footer">
                                    Pesanan
                                </div>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="card bg-primary" style=" color: white; border-radius: 10px">
                                <div class="card-body">
                                    <h5>{{$produk}}</h5>
                                </div>
                                <div class="card-footer">
                                    Data Produk
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
