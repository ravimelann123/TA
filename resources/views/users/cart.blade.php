@extends('master.masterlayout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center ">
        <div class="col-sm">
            <div class="card">
                {{-- <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">Keranjang</div>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    @if(session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col">
                            Hapus Semua Produk
                        </div>
                        <div class="col text-right">
                            <a href="/clearcart" class="btn" style="border-radius: 15px">
                                <i class="lnr lnr-trash"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Opsi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="/ordercart/{{auth()->user()->id}}" method="POST">
                                        {{ csrf_field() }}
                                        @foreach ($cart as $c)
                                        <tr>
                                            <td>{{$c->produk->nama}} <input type="hidden" name="produk_id[]"
                                                    value="{{$c->produk_id}}" class="form-control"></td>
                                            <td><input type="number" name="jumlah[]" style="width:100px;"
                                                    placeholder=" {{$c->jumlah}}" class="form-control"></td>
                                            <td>Rp. {{$c->produk->harga}}</td>
                                            <td class="text-right"> <a href="/clearcartitem/{{$c->id}}"
                                                    class="btn btn-danger" style="border-radius: 15px">
                                                    <i class="lnr lnr-cross"></i></a></td>
                                        </tr>
                                        @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <button class="btn btn-primary" style="border-radius: 15px">
                                Pay</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
