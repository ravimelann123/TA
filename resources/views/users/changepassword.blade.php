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
                                <li class="breadcrumb-item active" aria-current="page">Rubah Kata Sandi</li>
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
                        <form method="post" action="/changepassword/update" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group row {{$errors->has('passwordlama') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Kata Sandi Lama</label>
                                <div class="col-sm-10">
                                    <input type="password" name="passwordlama" class="form-control" value="">

                                    @if($errors->has('passwordlama'))
                                    <span class="help-block">{{$errors->first('passwordlama')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{$errors->has('passwordbaru') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Kata Sandi Baru</label>
                                <div class="col-sm-10">
                                    <input type="password" name="passwordbaru" class="form-control" value="">

                                    @if($errors->has('passwordbaru'))
                                    <span class="help-block">{{$errors->first('passwordbaru')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{$errors->has('konfirmasipassword') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Konfirmasi Kata Sandi</label>
                                <div class="col-sm-10">
                                    <input type="password" name="konfirmasipassword" class="form-control" value="">

                                    @if($errors->has('konfirmasipassword'))
                                    <span class="help-block">{{$errors->first('konfirmasipassword')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm text-right">
                                    <input type="submit" class="btn warnaku" value="Simpan" style="border-radius: 20px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
