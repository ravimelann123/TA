@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/tambahstok">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                style="border-radius: 15px"><i class="lnr lnr-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-7">
                            <h3>Tambah Stok</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">Cari</button>
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
                                <li class="breadcrumb-item active" aria-current="page">Tambah Stok</li>
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
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Stok Bertambah</th>
                                    <th>Penanggung jawab</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $tambahstok as $p)
                                <tr>

                                    <td>{{$p->produk->nama}}</td>
                                    <td>{{$p->stok}}</td>
                                    <td>{{$p->users->akun->nama}}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger delete" tambahstok-id="{{$p->id}}"
                                            style="border-radius: 15px"><i class="lnr lnr-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col">{{$tambahstok->links()}}</div>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahstok/create" method="POST">

                    {{ csrf_field() }}

                    <div class="form-group row {{$errors->has('produk_id') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Nama Produk</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="produk_id">
                                @foreach($produk as $p)
                                <option value="{{$p->id}}">{{$p->nama}}</option>
                                @endforeach
                            </select>

                            @if($errors->has('produk_id'))
                            <span class="help-block">{{$errors->first('produk_id')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('stok') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Stok</label>
                        <div class="col-sm-8">
                            <input type="text" name="stok" class="form-control" value="{{old('stok')}}">

                            @if($errors->has('stok'))
                            <span class="help-block">{{$errors->first('stok')}}</span>
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
                var tambahstok_id = $(this).attr('tambahstok-id');
                swal({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ tambahstok_id+"??",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/tambahstok/hapus/"+tambahstok_id+"";

        } else {

            window.location = "/users";

        }
        });

    });
</script>
@stop
