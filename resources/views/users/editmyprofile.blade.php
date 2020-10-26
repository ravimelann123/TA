@extends('master.masterlayout')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/akun">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/myprofile" type="button" class="btn btn-primary">Profile Saya</a>
                                <a href="/changepassword" type="button" class="btn btn-primary">Ganti Kata Sandi</a>
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
                                <li class="breadcrumb-item"><a href="/myprofile">Profil Saya</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Rubah Profil</li>
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
                    <div class="col">
                        <form method="post" action="/changemyprofile/update" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group row {{$errors->has('username') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control"
                                        value="{{ auth()->user()->username}}">
                                    @if($errors->has('username'))
                                    <span class="help-block">{{$errors->first('username')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{$errors->has('nama') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control"
                                        value="{{auth()->user()->akun->nama}}">
                                    @if($errors->has('nama'))
                                    <span class="help-block">{{$errors->first('nama')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{$errors->has('email') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control"
                                        value="{{auth()->user()->akun->email}}">
                                    @if($errors->has('email'))
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{$errors->has('nohp') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Nomer Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nohp" class="form-control"
                                        value="{{auth()->user()->akun->nohp}}">
                                    @if($errors->has('nohp'))
                                    <span class="help-block">{{$errors->first('nohp')}}</span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row {{$errors->has('alamat') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat"
                                        class="form-control">{{auth()->user()->akun->alamat  }}</textarea>
                                    @if($errors->has('alamat'))
                                    <span class="help-block">{{$errors->first('alamat')}}</span>
                                    @endif
                                </div>


                            </div>

                            <div class="form-group row{{$errors->has('avatar') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Foto Profil</label>
                                <div class="col-sm-10">
                                    <input type="file" name="avatar" class=" form-control-file">
                                    @if($errors->has('avatar'))
                                    <span class="help-block">{{$errors->first('avatar')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm text-right">
                                    <input type="submit" class="btn warnaku " value="Simpan"
                                        style="border-radius: 20px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
