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
                    <div class="row mb-3">
                        <div class="col text-center">
                            <div
                                style="border: 5px dashed rgba(198, 198, 198, 0.65);border-radius: 6px; padding: 15px;">
                                <input type="hidden" name="id" value="{{$idproduk}}">
                                <div class="icons fa-2x">
                                    <i class="fas fa-file-image"></i>
                                </div>
                                <input type="file" name="namafoto[]" multiple>
                                <button type="submit" class="btn btn-primary">Upload</button>

                            </div>
                        </div>
                    </div>
                </form>

                @if($count==0)
                <div class="row">
                    <div class="col text-center">
                        This product has no picture, please upload picture
                    </div>
                </div>
                @else
                <div class="row">
                    @foreach($data as $d)

                    <div class="col-md-3 text-center">
                        <img src="/images/produk/{{$d->namafoto}}" width="150" height="150">
                    </div>
                    <div class="col"> <a href="#" class="btn btn-danger delete" photo-id="{{$d->id}}"><i
                                class="fas fa-trash-alt"></i></a></div>

                    @endforeach
                    @endif
                </div>
                {{-- @endif --}}
                <div class="row mt-2">
                    <div class="col">{{$data->links()}}</div>
                </div>
            </div>

        </div>

    </div>
</div>
</div>
</div>
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
            window.location = "/photoproduk/"+{{$idproduk}};
        }
        })

    });
</script>

@stop
