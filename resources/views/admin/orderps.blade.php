@extends('master.masterlayout')
@section('content')

<div class="row justify-content-center ">

    <div class="col-md-12">
        <div class="card" style="min-height:85vh">
            <div class="card-header bg-white">
                <div class="row text-center ">
                    <div class="col">
                        <a href="/indexorder" class="btn btn-outline-success">Semua</a>
                        <a href="/orderbd" class="btn btn-outline-success">Belum Diproses</a>
                        <a href="/ordersd" class="btn btn-outline-success">Sedang Diproses</a>
                        <a href="/orderps" class="btn btn-outline-success">Pesanan Selesai</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row-12">
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                                </p>
                                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source
                                        Title</cite></footer>
                            </blockquote>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-outline-secondary"> <span class="lnr lnr-eye"></span></a>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
