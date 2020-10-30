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
                                    <li class="breadcrumb-item"><a href="/produk">Produk </a> </li>
                                    <li class="breadcrumb-item active" aria-current=" page">Rubah Data Produk</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <h3>Rubah Data Produk</h3>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <form method="post" action="/produk/update/{{ $produk->id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group row {{$errors->has('nama') ? 'has-error' : ''}}">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control"
                                            value=" {{ $produk->nama }}">

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
                                        <input type="text" name="harga" class="form-control"
                                            value=" {{ $produk->harga }}">

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
</div>
@endsection
