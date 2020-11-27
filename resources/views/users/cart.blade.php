@extends('master.masterlayout')

@section('content')
<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        Clear All Product
                    </div>
                    <div class="col text-right">
                        <a href="/clearcart" class="btn" style="border-radius: 15px; color: red;">
                            <i class="lnr lnr-trash"></i></a>
                    </div>
                </div>
                <form action="/cart/addproduk" method="post">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col">
                            Product
                            <select name="produk" class="selectpicker w-50" data-live-search="true">
                                @foreach($produk as $p)
                                <option value="{{$p->id}}">{{$p->nama ." | Rp. ".$p->harga}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col text-right">
                            <button class="btn" type="submit" style="border-radius: 15px"><i
                                    class="fas fa-plus-square"></i></button>
                        </div>

                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
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
                                        <td><input type="text" name="jumlah[]" style="width:100px;"
                                                placeholder=" {{$c->jumlah}}" class="form-control"></td>
                                        <td>Rp. {{$c->produk->harga}}</td>
                                        <td class="text-right"> <a href="/clearcartitem/{{$c->id}}" class="btn"
                                                style="border-radius: 15px; color: red;">
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
                            Pesan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
