@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/users">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                style="border-radius: 15px"><i class="lnr lnr-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-7">
                            <h3>Buat Akun</h3>
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
                                <li class="breadcrumb-item active" aria-current="page">Akun</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
                                <tr>
                                    <th>Username</th>
                                    {{-- <th>Pasword</th> --}}
                                    <th>Role</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datausers as $p)
                                <tr>
                                    <td>{{ $p->username }}</td>
                                    {{-- <td>{{ $p->password }}</td> --}}
                                    <td>{{ $p->role }}</td>
                                    <td>
                                        <a href="/users/edit/{{ $p->id }}" class="btn btn-warning"
                                            style="border-radius: 15px"><i class="lnr lnr-pencil"></i></a>
                                        <a href="#" class="btn btn-danger delete" users-id="{{$p->id}}"
                                            style="border-radius: 15px"><i class="lnr lnr-trash"></i></a>
                                        {{-- /users/hapus/{{ $p->id }} --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col">{{$datausers->links()}}</div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Akun </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/users/create" method="POST">

                    {{ csrf_field() }}

                    <div class="form-group row {{$errors->has('username') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" value="{{old('username')}}">

                            @if($errors->has('username'))
                            <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('password') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" value="{{old('password')}}">

                            @if($errors->has('password'))
                            <span class="help-block">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('role') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Pilih Role</label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control">
                                <option value="admin" {{(old('role') == 'admin' ) ? ' selected' : ''}}>Admin
                                </option>
                                <option value="user" {{(old('role') == 'user' ) ? ' selected' :''}}>User</option>
                            </select>

                            @if($errors->has('role'))
                            <span class="help-block">{{$errors->first('role')}}</span>
                            @endif
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>
{{-- END MODAL --}}


@stop

@section('footer')
<script>
    $('.delete').click(function(){
                var users_id = $(this).attr('users-id');
                swal({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ users_id+"??",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/users/hapus/"+users_id+"";

        } else {

            window.location = "/users";

        }
        });

    });
</script>
@stop
