@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/produk">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                style="border-radius: 15px"><i class="lnr lnr-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-7">
                            <h3>Produk</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari"
                                    style="border-bottom-left-radius: 20px;border-top-left-radius: 20px">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"
                                        style="border-bottom-right-radius: 20px; border-top-right-radius: 20px">Cari</button>
                                </div>
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
                                <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
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

                                        <a href="/produk/edit/{{ $p->id }}" class="btn btn-warning"
                                            style="border-radius: 15px"><i class="lnr lnr-pencil"></i></a>
                                        <a href="#" produk-id="{{$p->id}}" class="btn btn-danger delete"
                                            style="border-radius: 15px"><i class="lnr lnr-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col">{{$produk->links()}}</div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/produk/create" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group row {{$errors->has('nama') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Nama Produk</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama" class="form-control" value="{{old('nama')}}">

                            @if($errors->has('nama'))
                            <span class="help-block">{{$errors->first('nama')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('deskripsi') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" name="deskripsi" class="form-control" value="{{old('deskripsi')}}">

                            @if($errors->has('deskripsi'))
                            <span class="help-block">{{$errors->first('usdeskripsiername')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('harga') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Harga</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga" class="form-control" value="{{old('harga')}}">

                            @if($errors->has('harga'))
                            <span class="help-block">{{$errors->first('harga')}}</span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row {{$errors->has('namafoto') ? 'has-error' : ''}}">
                        <label class="col-4 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <input type="file" name="namafoto[]" class=" form-control-file" multiple>
                            @if($errors->has('namafoto'))
                            <span class="help-block">{{$errors->first('namafoto')}}</span>
                            @endif
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
            </form>
        </div>

    </div>
</div>
{{-- END MODAL --}}

@stop

@section('footer')
<script>
    $('.delete').click(function(){
                var produk_id = $(this).attr('produk-id');
                swal({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ produk_id+"??",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/produk/hapus/"+produk_id+"";

        } else {

            window.location = "/produk";

        }
        });

    });
</script>
@stop
