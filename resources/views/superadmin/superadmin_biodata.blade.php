@extends('master.masterlayout')
@section('content')

<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                                <li class="breadcrumb-item"><a href="/superadmin_users">Akun</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Biodata</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-white">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>E-mail</th>
                                                    <th>Phone Number</th>
                                                    <th>Address</th>
                                                    <th>Profile Picture</th>
                                                    <th>Updated_at</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $p)
                                                <tr>
                                                    <td>{{ $p->nama}}</td>
                                                    <td>{{ $p->email }}</td>
                                                    <td>{{ $p->nohp }}</td>
                                                    <td>{{ $p->alamat }}</td>
                                                    <td>
                                                        <img src="/images/{{ $p->avatar }}" width="75" height="75">
                                                    </td>
                                                    <td>{{$p->updated_at}}</td>
                                                    <td>
                                                        <a href="/superadmin_biodata/{{ $p->id }}/edit"
                                                            style=" color: orange;"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
