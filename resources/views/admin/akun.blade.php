@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/akun">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Biodata</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari"
                                    style="border-bottom-left-radius: 20px;border-top-left-radius: 20px">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"
                                        style="border-bottom-right-radius: 20px; border-top-right-radius: 20px">Cari</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Biodata</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Hp</th>
                                    <th>Alamat</th>
                                    <th>Avatar</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataakun as $p)
                                <tr>
                                    <td>{{ $p->nama}}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->nohp }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>
                                        <img src="/images/{{ $p->avatar }}" width="75" height="75">
                                    </td>
                                    <td>
                                        <a href="/akun/edit/{{ $p->id }}" class="btn btn-warning"
                                            style="border-radius: 15px"><i class="lnr lnr-pencil"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col">{{$dataakun->links()}}</div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
