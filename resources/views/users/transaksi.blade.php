@extends('master.masterlayout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center ">
        <div class="col-sm">
            <div class="card" style="min-height:85vh">
                {{-- <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">Keranjang</div>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            {{ $order->nomerpesanan }}
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
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                @php
                                $grandTotal = 0;
                                $total = 0;
                                @endphp
                                @foreach($orderd as $p)
                                <tbody>
                                    <tr>
                                        @php
                                        $total = $p->jumlah * $p->produk->harga;
                                        $grandTotal += $total;
                                        @endphp
                                        <td> {{$p->produk->nama}}</td>
                                        <td>{{$p->jumlah}}</td>
                                        <td>{{$p->produk->harga}}</td>
                                        <td>{{$p->jumlah * $p->produk->harga}}</td>
                                    </tr>

                                </tbody>
                                @endforeach
                                {{ $grandTotal }}
                            </table>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection