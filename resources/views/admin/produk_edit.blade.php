@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-md">
                        <h3>Edit Produk</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="/produk/update/{{ $produk->id }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group row {{$errors->has('nama') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value=" {{ $produk->nama }}">

                                    @if($errors->has('nama'))
                                    <span class="help-block">{{$errors->first('nama')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{$errors->has('deskripsi') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="deskripsi" class="form-control"
                                        value=" {{ $produk->deskripsi }}">

                                    @if($errors->has('deskripsi'))
                                    <span class="help-block">{{$errors->first('deskripsi')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{$errors->has('harga') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" name="harga" class="form-control" value=" {{ $produk->harga }}">

                                    @if($errors->has('harga'))
                                    <span class="help-block">{{$errors->first('harga')}}</span>
                                    @endif
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

@endsection
