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
                                <li class="breadcrumb-item"><a href="/admin/produk">Produk</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gambar</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="/tambahstok" class="btn btn-info">
                                    <i class="fas fa-sync"></i>
                                </a>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#exampleModal" style="border-radius: 5px">Tambah <i
                                        class="fas fa-plus-square"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="thead-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Gambar</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $no=>$d)
                                                <tr>
                                                    <td>{{$data->firstItem()+$no}}</td>
                                                    <td>{{$d->namafoto}}</td>
                                                    <td><img src="/images/produk/{{$d->namafoto}}" width="125"
                                                            height="125">
                                                    </td>
                                                    <td>

                                                        <a href="#" class=" delete" photo-id="{{$d->id}}"
                                                            style="color: red;"><i class="fas fa-trash-alt"></i></a>
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
                <form action="/photo/create" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group row ">
                        <label class="col-4 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="id" value="{{$d->produk_id}}">
                            <input type="file" name="namafoto[]"
                                class=" form-control-file {{$errors->has('namafoto') ? 'is-invalid' : ''}}" multiple>
                            @if($errors->has('namafoto'))
                            <span class="invalid-feedback">{{$errors->first('namafoto')}}</span>
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
{{-- END MODAL --}}
@stop

@section('footer')
<script>
    $('.delete').click(function(){
        var photo_id = $(this).attr('photo-id');
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data photo dengan id "+ photo_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {


        setTimeout(function(){ window.location = "/photoproduk/hapus/"+photo_id+""; }, 250);

        }else{
            window.location = "/photoproduk";
        }
        })

    });
</script>

@stop
