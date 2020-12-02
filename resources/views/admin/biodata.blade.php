@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="/myprofile">Biodata</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="/users">Account</a></li>
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
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Profile Picture</th>
                                    <th>Opsi</th>
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
                                        <a href="/biodata/{{ $p->id }}/edit" style=" color: orange;"><i
                                                class="fas fa-edit"></i></a>
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


@endsection
