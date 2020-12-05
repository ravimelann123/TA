@extends('master.masterlayout')
@section('content')

<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Biodata Saya</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <a href="/myprofile">
                                <h5>Biodata</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img width="150" height="150" src="{{auth()->user()->akun->getAvatar()}}">
                                    <h5 style="text-transform: capitalize">{{auth()->user()->username}}</h5>
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#passwordModal" style="border-radius: 5px">Rubah Kata sandi
                                    </button>
                                </div>

                                <div class="col-md-8">

                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-3">
                                                    Nama
                                                </div>
                                                <div class="col-9">
                                                    {{auth()->user()->akun->nama}}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-3">
                                                    Email
                                                </div>
                                                <div class="col-9">
                                                    {{auth()->user()->akun->email}}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-3">
                                                    Nomer Handphone
                                                </div>
                                                <div class="col-9">
                                                    {{auth()->user()->akun->nohp}}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-3">
                                                    Alamat
                                                </div>
                                                <div class="col-9">
                                                    {{auth()->user()->akun->alamat}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#biodataModal" style="border-radius: 5px;">Update <i
                                                    class="fas fa-edit"></i>
                                            </button>

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
</div>


<!-- Modal Create-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rubah Kata sandi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/changepassword/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class=" form-group row {{$errors->has('passwordlama') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">Kata Sandi Lama</label>
                        <div class="col-md-8">
                            <input type="password" name="passwordlama" class="form-control" value="">

                            @if($errors->has('passwordlama'))
                            <span class="help-block">{{$errors->first('passwordlama')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{$errors->has('passwordbaru') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">
                            Kata Sandi Baru</label>
                        <div class="col-md-8">
                            <input type="password" name="passwordbaru" class="form-control" value="">

                            @if($errors->has('passwordbaru'))
                            <span class="help-block">{{$errors->first('passwordbaru')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{$errors->has('konfirmasipassword') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">
                            Konfirmasi Kata Sandi</label>
                        <div class="col-md-8">
                            <input type="password" name="konfirmasipassword" class="form-control" value="">

                            @if($errors->has('konfirmasipassword'))
                            <span class="help-block">{{$errors->first('konfirmasipassword')}}</span>
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


<!-- Modal Create-->
<div class="modal fade" id="biodataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rubah Kata sandi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/changemyprofile/update" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group row {{$errors->has('username') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">Username</label>
                        <div class="col-md-8">
                            <input type="text" name="username" class="form-control"
                                value="{{ auth()->user()->username}}">
                            @if($errors->has('username'))
                            <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('nama') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" class="form-control" value="{{auth()->user()->akun->nama}}">
                            @if($errors->has('nama'))
                            <span class="help-block">{{$errors->first('nama')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('email') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">E-mail</label>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control"
                                value="{{auth()->user()->akun->email}}">
                            @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('nohp') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label"> Phone number</label>
                        <div class="col-md-8">
                            <input type="text" name="nohp" class="form-control" value="{{auth()->user()->akun->nohp}}">
                            @if($errors->has('nohp'))
                            <span class="help-block">{{$errors->first('nohp')}}</span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group row {{$errors->has('alamat') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">Address</label>
                        <div class="col-md-8">
                            <textarea name="alamat" class="form-control">{{auth()->user()->akun->alamat  }}</textarea>
                            @if($errors->has('alamat'))
                            <span class="help-block">{{$errors->first('alamat')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('avatar') ? 'has-error' : ''}}">
                        <label class="col-md-4 col-form-label">Profile Picture</label>
                        <div class="col-md-8">
                            <input type="file" name="avatar" class=" form-control-file">
                            @if($errors->has('avatar'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
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
@stop
