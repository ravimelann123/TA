@extends('master.masterlayout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @include('master.sidebar')
        <div class="col-md-9">
            <div class="card" style="min-height:85vh">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item"><a href="/users">Akun</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rubah Data Akun</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class=" col">
                            <h3>Rubah Data Akun</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <form method="post" action="/users/update/{{ $users->id }}">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group row {{$errors->has('username') ? 'has-error' : ''}}">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control"
                                            value=" {{ $users->username }}">

                                        @if($errors->has('username'))
                                        <span class="help-block">{{$errors->first('username')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row {{$errors->has('password') ? 'has-error' : ''}}">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" value="">

                                        @if($errors->has('password'))
                                        <span class="help-block">{{$errors->first('password')}}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pilih Role</label>
                                    <div class="col-sm-10">
                                        <select name="role" class="form-control">
                                            <option value="admin" @if($users->role == 'admin') selected @endif>Admin
                                            </option>
                                            <option value="user" @if($users->role == 'user') selected @endif>User
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col text-right">
                                        <input type="submit" class="btn btn-warning" value="Simpan"
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
</div>
@endsection
