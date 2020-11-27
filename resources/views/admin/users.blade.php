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
                                <a class="nav-link active" href="/users">Account</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="/akun">Biodata</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/produk">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/tambahstok">Add Stock</a>
                            </li>

                        </ul>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Account</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <form method="GET" action="/users">
                    <div class="row mb-3">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                style="border-radius: 15px"><i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="col-md-7">
                            <h3>Create Account</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
                                <tr>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datausers as $p)
                                <tr>
                                    <td>{{ $p->username }}</td>
                                    <td>{{ $p->role }}</td>
                                    <td>
                                        <a href="/users/edit/{{ $p->id }}" style=" color: orange;"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" class=" delete" users-id="{{$p->id}}" style="color: red;"><i
                                                class="fas fa-trash-alt"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Create Account </h5>
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
                        <label class="col-sm-4 col-form-label">Select Role</label>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
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
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ users_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {


        setTimeout(function(){ window.location = "/users/hapus/"+users_id+""; }, 250);

        }else{
            window.location = "/users";
        }
        })

    });
</script>
@stop
