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
                                <li class="breadcrumb-item"><a href="/users">Akun</a></li>
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
                                        <table class="table table-hover table-bordered">
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
                                                @foreach($data as $d)
                                                <tr>

                                                    <td>{{ $d->nama}}</td>
                                                    <td>{{ $d->email }}</td>
                                                    <td>{{ $d->nohp }}</td>
                                                    <td>{{ $d->alamat }}</td>
                                                    <td>
                                                        <img src="/images/{{ $d->avatar }}" width="75" height="75">
                                                    </td>

                                                    <td>
                                                        <a href="javascript:void(0)" onclick="editbiodata({{$d->id}})"
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
<!-- Modal edit-->
<div class="modal fade" id="biodataeditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Bahasa Alami</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="akuneditform" action="/users/biodata/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group row {{$errors->has('nama') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="nama" name="nama" class="form-control">

                            @if($errors->has('nama'))
                            <span class="help-block">{{$errors->first('nama')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('email') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">E-mail</label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control">

                            @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('nohp') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="text" id="nohp" name="nohp" class="form-control">

                            @if($errors->has('nohp'))
                            <span class="help-block">{{$errors->first('nohp')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('alamat') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <textarea type="text" id="alamat" name="alamat" class="form-control"></textarea>

                            @if($errors->has('alamat'))
                            <span class="help-block">{{$errors->first('alamat')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('avatar') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Profile Picture</label>
                        <div class="col-sm-8">
                            <input type="file" name="avatar" class="form-control-file">

                            @if($errors->has('avatar'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
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
    function editbiodata(id){
    $.get('/users/biodata/'+id+'/edit',function(d){
        $("#id").val(d.id);
        $("#nama").val(d.nama);
        $("#email").val(d.email);
        $("#nohp").val(d.nohp);
        $("#alamat").val(d.alamat);
        $("#biodataeditModal").modal("toggle");
    });
}
</script>
@stop
