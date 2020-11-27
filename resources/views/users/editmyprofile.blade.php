@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="/myprofile">My Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <h3>Rubah Profil</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form method="post" action="/changemyprofile/update" enctype="multipart/form-data">

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
                                    <input type="text" name="nama" class="form-control"
                                        value="{{auth()->user()->akun->nama}}">
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
                                    <input type="text" name="nohp" class="form-control"
                                        value="{{auth()->user()->akun->nohp}}">
                                    @if($errors->has('nohp'))
                                    <span class="help-block">{{$errors->first('nohp')}}</span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row {{$errors->has('alamat') ? 'has-error' : ''}}">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea name="alamat"
                                        class="form-control">{{auth()->user()->akun->alamat  }}</textarea>
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
                            <div class="form-group row">
                                <div class="col-sm text-right">
                                    <input type="submit" class="btn btn-warning" value="Save"
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
