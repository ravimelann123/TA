@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <h3>Edit Data User</h3>
    </div>
</div>
<div class="row">
    <div class="col">
        <form method="post" action="/produk/update/{{ $produk->id }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value=" {{ $produk->nama }}">

                @if($errors->has('nama'))
                <span class="help-block">{{$errors->first('nama')}}</span>
                @endif

            </div>
            <div class="form-group {{$errors->has('deskripsi') ? 'has-error' : ''}}">
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" value=" {{ $produk->deskripsi }}">

                @if($errors->has('deskripsi'))
                <span class="help-block">{{$errors->first('deskripsi')}}</span>
                @endif

            </div>


            <div class="form-group {{$errors->has('harga') ? 'has-error' : ''}}">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value=" {{ $produk->harga }}">

                @if($errors->has('harga'))
                <span class="help-block">{{$errors->first('harga')}}</span>
                @endif

            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Simpan">
            </div>
        </form>
    </div>
</div>

@endsection
