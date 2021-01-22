@extends('master.masterlayout')
@section('content')

<div class="col">
    <div class="card" style="min-height:85vh">
        {{-- <div class="card-header"> --}}

        {{-- </div> --}}
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item active"><a href="/plgn/pesanan" style="color: #212529">
                                <b>Pesanan</b>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    {{-- <div class="card">
                         <div class="card-header">
                        </div>
                    <div class="card-body"> --}}

                    <form method="GET" action="/plgn/pesanan">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="input-group">
                                    <select class="custom-select" name="cari">
                                        <option>
                                            Pilih Status Pesanan</option>
                                        <option value="Menunggu Diproses">
                                            Menunggu Diproses</option>
                                        <option value="Sedang Diproses">Sedang Diproses</option>
                                        <option value="Pesanan Selesai">Pesanan Selesai</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type=" button"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="row mb-3">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomer Pesanan</th>
                                            <th>Status</th>
                                            <th>Total Harga</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $no=>$p)
                                        <tr>

                                            <td>{{$data->firstItem()+$no}}</td>
                                            <td>{{$p->nomerpesanan}}</td>
                                            <td>{{$p->status}}</td>
                                            <td>Rp. {{$p->total}}</td>
                                            <td>
                                                <a href="/plgn/pesanan/detail/{{$p->id}}" style="color: red">
                                                    <i class="fas fa-file-pdf"></i></a>
                                                <a href="/Dpesanan/{{$p->id}}" style="color: gray"> <i
                                                        class="fas fa-eye"></i></a>

                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">{{$data->links()}}</div>
                    </div>

                    {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
