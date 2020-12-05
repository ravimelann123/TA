@extends('master.masterlayout')
@section('content')

<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Stok</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="/superadmin_tambahstok" class="btn btn-info">
                                    <i class="fas fa-sync"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="/superadmin_tambahstok">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="cari" placeholder="Cari">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type=" button"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Stok Ditambahkan</th>
                                                    <th>Nama Admin</th>
                                                    <th>Created</th>
                                                    {{-- <th>Penanggung jawab</th> --}}

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $data as $no=>$p)
                                                <tr>
                                                    <td>{{$data->firstItem()+$no}}</td>
                                                    <td>{{$p->produk->nama}}</td>
                                                    <td>{{$p->stok}}</td>
                                                    <td>{{$p->users->akun->nama}}</td>
                                                    <td>{{$p->created_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-2">
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
@stop
