@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <h3>Edit Data User</h3>
    </div>
</div>
<div class="row">
    <div class="col">
        <form method="post" action="/akun/update/{{ $akun->id }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value=" {{ $akun->nama }}">

                @if($errors->has('nama'))
                <span class="help-block">{{$errors->first('nama')}}</span>
                @endif

            </div>
            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value=" {{ $akun->email }}">

                @if($errors->has('email'))
                <span class="help-block">{{$errors->first('email')}}</span>
                @endif

            </div>
            <div class="form-group {{$errors->has('nohp') ? 'has-error' : ''}}">
                <label>No. Hp</label>
                <input type="number" name="nohp" class="form-control" value=" {{ $akun->nohp }}">
                @if($errors->has('nohp'))
                <span class="help-block">{{$errors->first('nohp')}}</span>
                @endif

            </div>

            <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ $akun->alamat }}</textarea>

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

@endsection
