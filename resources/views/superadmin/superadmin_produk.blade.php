@extends('master.masterlayout')
@section('content')

<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Produk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <a href="/superadmin_produk" class="btn btn-info">
                            Produk <i class="fas fa-sync"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="/superadmin_produk">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="cari" placeholder="Cari">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type=" button"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                                <div class="row">
                                    <div class="col table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="thead-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Stok</th>
                                                    <th>Create</th>
                                                    <th>Update</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $data as $no=>$p)
                                                <tr>
                                                    <td>{{$data->firstItem()+$no}}</td>
                                                    <td>{{$p->nama}}</td>
                                                    <td>{{ $p->stok }}</td>
                                                    <td>{{$p->created_at}}</td>
                                                    <td>{{$p->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col">{{$data->links()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
