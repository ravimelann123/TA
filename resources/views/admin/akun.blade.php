@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/akun">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-5">
                            <h3>Biodata</h3>
                        </div>
                        <div class="col-md-4"><input type="text" name="cari" class="form-control" placeholder="Cari"
                                style="border-radius: 20px">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="border-radius: 20px">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
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
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection
