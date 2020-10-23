@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/photoproduk">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md">
                            <h3>Detail Foto</h3>
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
                                <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Photo Detail</li>
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
                                    <th>nama</th>
                                    <th>Image</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($photo as $p)
                                <tr>
                                    <td>{{$p->namafoto}}</td>
                                    <td><img src="/images/produk/{{$p->namafoto}}" width="125" height="125"></td>
                                    <td>

                                        <a href="#" class="btn btn-danger delete" photo-id="{{$p->id}}"
                                            style="border-radius: 15px"><i class="lnr lnr-trash"></i></a>
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


@stop

@section('footer')
<script>
    $('.delete').click(function(){
                var photo_id = $(this).attr('photo-id');
                swal({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ photo_id+"??",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/photoproduk/hapus/"+photo_id+"";

        } else {

            window.location = "/users";

        }
        });

    });
</script>
@stop
