@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/produk">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                                    class="lnr lnr-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-5">
                            <h3>Produk</h3>
                        </div>
                        <div class="col-md-4"><input type="text" name="cari" class="form-control" placeholder="Cari"
                                style="border-radius: 20px">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="border-radius: 20px">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">

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
                                        <a href="/produk/hapus/{{ $p->id }}" class="btn btn-danger"
                                            style="border-radius: 15px"><i class="lnr lnr-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
                </form>
            </div>
        </div>

    </div>
</div>
{{-- END MODAL --}}

@endsection
