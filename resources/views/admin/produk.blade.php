@extends('master.masterlayout')
@section('content')
<div class="row">

    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active"><a href="/admin/produk" style="color: #212529">
                                    <b>Table Data Product</b>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>

                    </div>
                </div>

                <form method="GET" action="/admin/produk">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#produkModal"><i class="fas fa-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-white">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    {{-- <th>Stok</th> --}}
                                    <th>Price</th>
                                    {{-- <th>Picture</th> --}}
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $data as $no=>$d)
                                <tr>
                                    <td>{{$data->firstItem()+$no}}</td>
                                    <td>{{$d->kode}}</td>
                                    <td>{{$d->nama}}</td>
                                    <td>{{ $d->deskripsi }}</td>
                                    {{-- <td>{{ $d->stok }}</td> --}}
                                    <td>{{ $d->harga }}</td>
                                    {{-- <td><a href="/photoproduk/{{$d->id}}" class="btn btn-secondary"><i
                                        class="fas fa-info"></i> Info
                                    </a></td>--}}
                                    <td>
                                        <a href="javascript:void(0)" onclick="editProduk({{$d->id}})"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" produk-id="{{$d->id}}" class="delete btn btn-danger btn-sm"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col">{{$data->links()}}</div>
                </div>
                {{-- </div>
                        </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
{{-- MODAL --}}
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/produk/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Kode Produk</label>
                        <div class="col-sm-8">
                            <input type="text" name="kode"
                                class="form-control {{$errors->has('kode') ? 'is-invalid' : ''}}"
                                value="{{old('kode')}}">

                            @if($errors->has('kode'))
                            <span class="invalid-feedback">{{$errors->first('kode')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Nama Produk</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama"
                                class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}"
                                value="{{old('nama')}}">

                            @if($errors->has('nama'))
                            <span class="invalid-feedback">{{$errors->first('nama')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" name="deskripsi"
                                class="form-control {{$errors->has('deskripsi') ? 'is-invalid' : ''}}"
                                value="{{old('deskripsi')}}">

                            @if($errors->has('deskripsi'))
                            <span class="invalid-feedback">{{$errors->first('deskripsi')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Harga</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga"
                                class="form-control {{$errors->has('harga') ? 'is-invalid' : ''}}"
                                value="{{old('harga')}}">

                            @if($errors->has('harga'))
                            <span class="invalid-feedback">{{$errors->first('harga')}}</span>
                            @endif
                        </div>
                    </div>


                    {{-- <div class="form-group row ">
                        <label class="col-4 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <input type="file" name="namafoto[]"
                                class=" form-control-file {{$errors->has('namafoto[]') ? 'is-invalid' : ''}}" multiple>
                    @if($errors->has('namafoto[]'))
                    <span class="invalid-feedback">{{$errors->first('namafoto[]')}}</span>
                    @endif
            </div>
        </div> --}}

        <div class="row">
            <div class="col text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>
{{-- END MODAL --}}
<!-- Modal edit-->
<div class="modal fade" id="produkeditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="produkeditform" action="/produk/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Kode</label>
                        <div class="col-sm-8">
                            <input type="text" id="kode" name="kode"
                                class="form-control {{$errors->has('kode') ? 'is-invalid' : ''}}">

                            @if($errors->has('kode'))
                            <span class="invalid-feedback">{{$errors->first('kode')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">nama</label>
                        <div class="col-sm-8">
                            <input type="text" id="nama" name="nama"
                                class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}">

                            @if($errors->has('nama'))
                            <span class="invalid-feedback">{{$errors->first('nama')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" id="deskripsi" name="deskripsi"
                                class="form-control {{$errors->has('deskripsi') ? 'is-invalid' : ''}}">
                            @if($errors->has('deskripsi'))
                            <span class="invalid-feedback">{{$errors->first('deskripsi')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Harga</label>
                        <div class="col-sm-8">
                            <input type="text" id="harga" name="harga"
                                class="form-control {{$errors->has('harga') ? 'is-invalid' : ''}}">
                            @if($errors->has('harga'))
                            <span class="invalid-feedback">{{$errors->first('harga')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal edit --}}
@stop

@section('footer')
<script>
    function editProduk(id){
    $.get('/produk/'+id,function(d){
        $("#id").val(d.id);
        $("#kode").val(d.kode);
        $("#nama").val(d.nama);
        $("#deskripsi").val(d.deskripsi);
        $("#harga").val(d.harga);
        $("#produkeditModal").modal("toggle");
    });
}
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
            window.location = "/admin/produk";
        }
        })
    });
</script>
@stop
