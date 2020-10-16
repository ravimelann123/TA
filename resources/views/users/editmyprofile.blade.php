@extends('master.masterlayout')
@section('content')
{{-- JUMBOTRON  --}}
<div class="jumbotron jumbotron-fluid jumbotronuser">
    <div class="container">
    </div>
</div>
{{-- END JUMBOTRON --}}
<div class="row justify-content-center">
    <div class="col-4 info-panel">
        <div class="row">
            <div class="col-lg justify-content-center">
                <div class="col-lg ">
                    <form method="post" action="/changemyprofile/update" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control"
                                value=" {{ auth()->user()->username}}">
                            @if($errors->has('username'))
                            <span class="help-block">{{$errors->first('username')}}</span>
                            @endif

                        </div>

                        <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control"
                                value=" {{  auth()->user()->akun->nama }}">

                            @if($errors->has('nama'))
                            <span class="help-block">{{$errors->first('nama')}}</span>
                            @endif

                        </div>
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value=" {{ auth()->user()->akun->email  }}">

                            @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                            @endif

                        </div>
                        <div class="form-group {{$errors->has('nohp') ? 'has-error' : ''}}">
                            <label>No. Hp</label>
                            <input type="text" name="nohp" class="form-control"
                                value=" {{ auth()->user()->akun->nohp  }}">
                            @if($errors->has('nohp'))
                            <span class="help-block">{{$errors->first('nohp')}}</span>
                            @endif

                        </div>

                        <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control">{{auth()->user()->akun->alamat  }}</textarea>
                            @if($errors->has('alamat'))
                            <span class="help-block">{{$errors->first('alamat')}}</span>
                            @endif

                        </div>

                        <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
                            <label>Avatar</label>
                            <input type="file" name="avatar" class=" form-control">
                            @if($errors->has('avatar'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
