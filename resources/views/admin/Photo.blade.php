@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Foto</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <form method="GET" action="/photoproduk">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                style="border-radius: 15px"><i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="col">
                            <h3>Detail Foto</h3>
                        </div>
                    </div>
                </form>





                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
                                <tr>
                                    <th>nama</th>
                                    <th>Image</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($photo as $p)
                                <tr>
                                    <td>{{$p->namafoto}}</td>
                                    <td><img src="/images/produk/{{$p->namafoto}}" width="125" height="125">
                                    </td>
                                    <td>

                                        <a href="#" class=" delete" photo-id="{{$p->id}}" style="color: red;"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col">{{$photo->links()}}</div>
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


                    <div class="form-group row {{$errors->has('namafoto') ? 'has-error' : ''}}">
                        <label class="col-4 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="id" value="{{$p->produk_id}}">
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