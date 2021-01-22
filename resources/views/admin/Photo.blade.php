@extends('master.masterlayout')
@section('content')
<div class="row">

    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active" style="color: #212529">
                                <b>Product Picture</b>

                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="/admin/produk">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Picture</li>
                        </ol>

                    </div>
                </div>
                <form action="/photo/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="text" name="id" value="4">
                                    <input type="file" class="custom-file-input" name="namafoto[]" multiple>
                                    <label class=" custom-file-label">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- <div class="row mb-2">
                    <div class="col text-left">


                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus-square"></i> Add Product Picture
                        </button>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover table-striped">
                            {{-- <thead class="thead-white">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead> --}}
                            <tbody>
                                {{-- @if($data) --}}

                                {{-- @else --}}

                                @foreach($data as $no=>$d)
                                <tr>
                                    <td>{{$data->firstItem()+$no}}</td>
                                    <td>{{$d->namafoto}}</td>
                                    <td><img src="/images/produk/{{$d->namafoto}}" width="125" height="125">
                                    </td>
                                    <td>
                                        <a href="#" class=" delete" photo-id="{{$d->id}}" style="color: red;"><i
                                                class="fas fa-trash-alt"></i></a>



                                    </td>
                                </tr>
                                @endforeach
                                {{-- @endif --}}
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
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Picture</h5>
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
        <input type="file" name="namafoto[]" class=" form-control-file {{$errors->has('namafoto') ? 'is-invalid' : ''}}"
            multiple>
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
</div> --}}
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
            window.location = "/photoproduk/";
        }
        })

    });
</script>

@stop
