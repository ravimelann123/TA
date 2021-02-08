<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid black;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        background-color: #17a2b8;
        color: white;
    }
</style>
<h1>KUE BOLU RM</h1>
<b>Nomer Pesanan</b><b>:</b> {{$data->id}}<br>
<b>Tanggal </b><b>:</b> {{$data->created_at}}<br>
<b>Nama </b><b>:</b> {{$data->prosesnlp->kalimat->users->nama}}

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



<table>
    <tbody>


    </tbody>
</table>

<table class="table">
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
        <tr>
            <td>
                45000 x {{$total45}}
                </b>
            </td>
            <td>
                Rp. {{$harga45}}

            </td>
        </tr>
        <tr>
            <td>
                35000 x {{$total35}}</b>
            </td>
            <td>
                {{$harga35}}
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                Total : {{$harga45 + $harga35}}
            </td>
        </tr>
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
