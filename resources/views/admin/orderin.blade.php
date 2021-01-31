@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active"><a href="/admin/pesananmasuk" style="color: #212529">
                                    <b>Pesanan Masuk</b>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pesanan Masuk</li>
                        </ol>
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
                                            {{-- <a href="/admin/pesanan/detail/{{$p->id}}" style="color: red"> <i
                                                class="fas fa-file-pdf"></i></a> --}}
                                            @if($p->status == "Menunggu Diproses")
                                            <a href="/updatetosd/{{$p->id}}" class="btn btn-success"> Terima <i
                                                    class="fas fa-check"></i></a>
                                            {{-- @if($p->status == "Sedang Diproses")
                                            <a href="/updatetops/{{$p->id}}" style="color: orange"><i
                                                class="fas fa-edit"></i></a>
                                            @else
                                            <a href="/indexorder" style="color: gray"><i
                                                    class="fas fa-edit"></i></a>--}}
                                            @endif

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
            </div>
        </div>
    </div>
</div>



</div>
</div>
</div>
</div>

@endsection
