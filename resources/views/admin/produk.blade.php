@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row mb-3">

                    <div class="col">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="/users">Account</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="/produk">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/tambahstok">Add Stock</a>
                            </li>

                        </ul>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <form method="GET" action="/produk">

                    <div class="row mb-3">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                style="border-radius: 15px"><i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="col-md-7">
                            <h3>Product</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>



                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Picture</th>
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
                                    <td><a href="/photoproduk/{{$p->id}}" style="color:gray"><i class="fas fa-eye"></i>
                                        </a></td>
                                    <td>
                                        <a href="/produk/edit/{{ $p->id }}" style="color: orange;"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" produk-id="{{$p->id}}" class="delete" style="color: red;"><i
                                                class="fas fa-trash-alt"></i></a>
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
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data produk dengan id "+ produk_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {

        setTimeout(function(){ window.location = "/produk/hapus/"+produk_id+""; }, 250);

        }else{
            window.location = "/produk";
        }
        })

    });
</script>
@stop
