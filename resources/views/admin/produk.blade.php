@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col-9">
        <h3 class="panel-title">Produk</h3>
    </div>
    <div class="col-3 text-right">
        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                class="lnr lnr-plus-circle"></i>
        </button>
    </div>
</div>
{{-- MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/produk/create" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                        <label>Nama Produk</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk"
                            value="{{old('nama')}}">


                        @if($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('deskripsi') ? 'has-error' : ''}}">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi"
                            value="{{old('deskripsi')}}">

                        @if($errors->has('deskripsi'))
                        <span class="help-block">{{$errors->first('deskripsi')}}</span>
                        @endif

                    </div>



                    <div class="form-group {{$errors->has('harga') ? 'has-error' : ''}}">
                        <label>Stok</label>
                        <input type="number" name="harga" class="form-control" placeholder="harga" value="">

                        @if($errors->has('harga'))
                        <span class="help-block">{{$errors->first('harga')}}</span>
                        @endif

                    </div>

                    <div class="form-group {{$errors->has('namafoto') ? 'has-error' : ''}}">
                        <label>Foto</label>
                        <input type="file" name="namafoto[]" class=" form-control" multiple>
                        @if($errors->has('namafoto'))
                        <span class="help-block">{{$errors->first('namafoto')}}</span>
                        @endif
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>
{{-- END MODAL --}}

<div class="row">
    <div class="col-12">
        <table class="table table-hover text-left">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $produk as $p)
                <tr>
                    <td>{{$p->nama}}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>{{ $p->harga }}</td>
                    <td><a href="/photoproduk/{{$p->id}}">Detail foto</a></td>
                    <td>
                        <a href="/produk/edit/{{$p->id}}" class="btn btn-warning">Edit</a>
                        <a href="/produk/hapus/{{$p->id}}" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- END MODAL --}}
    </div>
</div>



</div>
</div>

@endsection
