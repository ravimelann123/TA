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
                                <a class="nav-link " href="/myprofile">Profile Saya</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="/changepassword">Rubah Kata Sandi</a>
                            </li>

                        </ul>
                    </div>

                </div>
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

                <div class="row">
                    <div class="col">
                        <form method="post" action="/changepassword/update" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group row {{$errors->has('passwordlama') ? 'has-error' : ''}}">
                                <label class="col-md-4 col-form-label">Kata Sandi Lama</label>
                                <div class="col-md-8">
                                    <input type="password" name="passwordlama" class="form-control" value="">

                                    @if($errors->has('passwordlama'))
                                    <span class="help-block">{{$errors->first('passwordlama')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{$errors->has('passwordbaru') ? 'has-error' : ''}}">
                                <label class="col-md-4 col-form-label">Kata Sandi Baru</label>
                                <div class="col-md-8">
                                    <input type="password" name="passwordbaru" class="form-control" value="">

                                    @if($errors->has('passwordbaru'))
                                    <span class="help-block">{{$errors->first('passwordbaru')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{$errors->has('konfirmasipassword') ? 'has-error' : ''}}">
                                <label class="col-md-4 col-form-label">Konfirmasi Kata Sandi</label>
                                <div class="col-md-8">
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
</div>

@endsection