@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active"><a href="/admin/pesanan" style="color: #212529">
                                    <b>Pesanan</b>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                        </ol>
                    </div>
                </div>

                <form method="GET" action="/admin/pesanan">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="input-group">
                                <select class="custom-select" name="cari">
                                    <option>
                                        Pilih Status Pesanan</option>
                                    <option value="Sedang Diproses">Sedang Diproses</option>
                                    <option value="Pesanan Selesai">Pesanan Selesai</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="row mb-2">
                    <div class="col">
                        <div class="alert alert-success">
                            <strong>{{$orderin}}</strong> Pesanan Baru, <a href="/admin/pesananmasuk"
                                style="color: #155724">Lihat.</a>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Number Pesanan</th>
                                        <th>Status</th>
                                        <th>Total Price</th>
                                        <th>Detail Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($data as $no=>$p)
                                    <tr>
                                        <td>{{$data->firstItem()+$no}}</td>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->status}}</td>
                                        <td>Rp. {{$p->total}}</td>
                                        <td class="text-center">

                                            <a href="/admin/pesanan/detail/{{$p->id}}" class="btn btn-danger btn-sm"
                                                style="width: 30px"> <i class="fas fa-file-pdf"></i></a>
                                            {{-- @if($p->status == "Menunggu Diproses")
                                            <a href="/updatetosd/{{$p->id}}" style="color: orange"><i
                                                class="fas fa-edit"></i></a> --}}
                                            @if($p->status == "Sedang Diproses")
                                            <a href="/updatetops/{{$p->id}}" class="btn btn-warning btn-sm">Update
                                                Status
                                            </a>
                                            @else
                                            <button type="button" class="btn btn-success btn-sm">Pesanan
                                                Selesai</button>
                                            @endif</td>
                                    </tr> @endforeach </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">{{$data->links()}}</div>
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
