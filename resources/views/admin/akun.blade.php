@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <h3>Profile</h3>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
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
                    <td>{{ $p->avatar }}</td>
                    <td>
                        <a href="/akun/edit/{{ $p->id }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
