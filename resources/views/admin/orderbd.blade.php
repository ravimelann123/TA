@extends('master.masterlayout')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-3">
        @include('master.sidebar')
        <div class="col-md-9">
            <div class="card" style="min-height:85vh">
                <div class="card-body">
                    <div class="row mb-3">

                        <div class="col">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="indexorder">Semua</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link active" href="/orderbd">Belum Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/ordersd">Sedang Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/orderps">Pesanan Selesai</a>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <form method="GET" action="/orderbd">
                        <div class="row mb-3">

                            <div class="col-md-8">
                                <h3>Pesanan</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cari" placeholder="Cari">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type=" button"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nomer Pesanan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Total Harga</th>
                                            <th scope="col" class="text-center">Detail Pesanan</th>
                                            <th scope="col" class="text-center">Rubah Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order as $p)
                                        <tr>
                                            <td>{{$p->nomerpesanan}}</td>
                                            <td>{{$p->status}}</td>
                                            <td>Rp. {{$p->total}}</td>
                                            <td class="text-center">
                                                <a href="/detailpesanan/{{$p->id}}" style="color: gray"> <i
                                                        class="fas fa-eye"></i></a>
                                            </td>
                                            <td class="text-center"> <a href="/updatetosd/{{$p->id}}"
                                                    style="color: orange"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">{{$order->links()}}</div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @endsection
