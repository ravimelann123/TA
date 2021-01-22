@extends('master.masterlayout')
@section('content')
<div class="row">

    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active"><a href="/admin/users" style="color: #212529">
                                    <b>Users</b>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>

                    </div>
                </div>

                <form method="GET" action="/admin/users">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#akunModal"><i class="fas fa-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Biodata</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datausers as $no=>$p)
                                <tr class="text-center">
                                    <td>{{$datausers->firstItem()+$no}}</td>
                                    <td>{{ $p->username }}</td>
                                    <td>{{ $p->role }}</td>
                                    {{-- <td>{{ $p->role }}</td> --}}
                                    <td>@if($p->role == "admin")
                                        -
                                        @else
                                        <a href="/users/biodata/{{$p->id}}" name="id" value="" class="btn btn-primary">
                                            Detail
                                        </a></td>
                                    @endif

                                    <td>
                                        @if($p->role == "admin")
                                        <a href="#" style="color: grey;"><i class="fas fa-edit"></i></a>
                                        <a href="#" style="color: grey;"><i class="fas fa-trash-alt"></i></a>
                                        @else
                                        <a href="javascript:void(0)" onclick="editAkun({{$p->id}})"
                                            style=" color: orange;"><i class="fas fa-edit"></i></a>
                                        <a href="#" class=" delete" users-id="{{$p->id}}" style="color: red;"><i
                                                class="fas fa-trash-alt"></i></a>
                                        @endif


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



<!-- Modal Create-->
<div class="modal fade" id="akunModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/users/create" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username"
                                class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                                value="{{old('username')}}">
                            @if($errors->has('username'))
                            <span class="invalid-feedback">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password"
                                class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                value="{{old('password')}}">

                            @if($errors->has('password'))
                            <span class="invalid-feedback">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Pilih Role</label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control {{$errors->has('role') ? 'is-invalid' : ''}}">
                                <option value="admin" {{(old('role') == 'admin' ) ? ' selected' : ''}}>Admin
                                </option>
                                <option value="user" {{(old('role') == 'user' ) ? ' selected' :''}}>User
                                </option>
                            </select>

                            @if($errors->has('role'))
                            <span class="invalid-feedback">{{$errors->first('role')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end modal create --}}
<!-- Modal edit-->
<div class="modal fade" id="akuneditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="akuneditform" action="/users/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username"
                                class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}">

                            @if($errors->has('username'))
                            <span class="invalid-feedback">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password"
                                class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                            @if($errors->has('password'))
                            <span class="invalid-feedback">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Pilih Role</label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control {{$errors->has('role') ? 'is-invalid' : ''}}">
                                <option value="admin">Admin
                                </option>
                                <option value="user">User</option>
                            </select>

                            @if($errors->has('role'))
                            <span class="invalid-feedback">{{$errors->first('role')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal edit --}}

@stop

@section('footer')

<script>
    function editAkun(id){
    $.get('/users/'+id,function(d){
        $("#id").val(d.id);
        $("#username").val(d.username);
        $("#akuneditModal").modal("toggle");
    });
}
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
            window.location = "/admin/users";
        }
        })

    });
</script>
@stop
