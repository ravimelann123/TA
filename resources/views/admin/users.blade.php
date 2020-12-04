@extends('master.masterlayout')
@section('content')
<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Akun</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <a href="/users" class="btn btn-info">
                        Akun <i class="fas fa-sync"></i>
                    </a>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#akunModal"
                        style="border-radius: 5px">Tambah <i class="fas fa-plus-square"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">

                            <form method="GET" action="/users">
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
                                        <thead class="thead-white">
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Biodata</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datausers as $no=>$p)
                                            <tr>
                                                <td>{{$datausers->firstItem()+$no}}</td>
                                                <td>{{ $p->username }}</td>
                                                {{-- <td>{{ $p->role }}</td> --}}
                                                <td><a href="/users/biodata/{{$p->id}}" name="id" value="">View Detail
                                                    </a></td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="editAkun({{$p->id}})"
                                                        style=" color: orange;"><i class="fas fa-edit"></i></a>
                                                    <a href="#" class=" delete" users-id="{{$p->id}}"
                                                        style="color: red;"><i class="fas fa-trash-alt"></i></a>
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

                    <div class="form-group row {{$errors->has('username') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username" class="form-control">

                            @if($errors->has('username'))
                            <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('password') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password" class="form-control">
                            @if($errors->has('password'))
                            <span class="help-block">{{$errors->first('password')}}</span>
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
            window.location = "/users";
        }
        })

    });
</script>
@stop
