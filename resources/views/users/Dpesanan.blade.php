@extends('master.masterlayout')
@section('content')


<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item active" style="color: #212529">
                            <b>Detail Pesanan</b>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/plgn/pesanan">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </div>
            </div>




            <div class="row mb-2">
                <div class="col-2">
                    <b>Nomer Pesanan</b> <br>
                    <b>Tanggal </b><br>
                    <b>Nama </b>
                </div>
                <div class="col-10">
                    <b>:</b> {{$data->nomerpesanan}}<br>
                    <b>:</b> {{$data->created_at}}<br>
                    <b>:</b> {{$data->users->akun->nama}}
                </div>

            </div>
            @php
            $total45 = 0;
            $total35 = 0;
            @endphp
            @foreach($orderdetail as $p)
            @if($p->produk->harga == 45000)
            @php
            $total45 += $p->jumlah ;
            @endphp
            @else
            @php
            $total35 += $p->jumlah ;
            @endphp
            @endif
            @endforeach
            @php
            $harga45 = $total45 * 45000 ;
            $harga35 = $total35 * 35000 ;
            @endphp
            <div class="row mb-2">
                <div class="col-2">
                    Rp. 45000 x {{$total45}} <br>
                    Rp. 35000 x {{$total35}}
                </div>
                <div class="col-10">
                    : Rp. {{$harga45}} <br>
                    : Rp. {{$harga35}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    {{-- <th>Price</th> --}}
                                    {{-- <th>Total</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderdetail as $p)
                                <tr>
                                    {{-- <td>{{$no+1}}</td> --}}
                                    <td>{{$p->produk->nama}}</td>
                                    <td>{{$p->jumlah}}</td>
                                    {{-- <td>{{$p->produk->harga}}</td> --}}
                                    {{-- <td>{{$p->jumlah * $p->produk->harga}}</td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <a href="/plgn/pesanan/detail/print/{{$data->id}}" class="btn btn-danger">Export <i
                            class="fas fa-file-pdf"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
