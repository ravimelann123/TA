@extends('master.masterlayout')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center mb-3">
        @include('master.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="indexorder">Semua</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/orderbd">Belum Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/ordersd">Sedang Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/orderps">Pesanan Selesai</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            @foreach($order as $o)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">Nomer Pesanan<br>({{$o->nomerpesanan}})</div>
                                        <div class="col">Status Pesanan<br>{{$o->status}} </div>
                                        <div class="col">Total Belanja<br>Rp. {{$o->total}}</div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat
                                            a ante.
                                        </p>
                                        <footer class="blockquote-footer">Someone famous in <cite
                                                title="Source Title">Source
                                                Title</cite></footer>
                                    </blockquote>
                                </div>
                                <div class="card-footer">
                                    <a href="" class="btn"> <i class="fas fa-eye"></i></a>

                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    @endsection
