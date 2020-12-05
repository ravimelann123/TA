@extends('master.masterlayout')
@section('content')

<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Stok</li>
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
                                data-target="#tambahstokModal" style="border-radius: 5px">Tambah <i
                                    class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="/tambahstok">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cari" placeholder="Search">
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
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Stok Ditambahkan</th>
                                                {{-- <th>Penanggung jawab</th> --}}
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $data as $no=>$p)
                                            <tr>
                                                <td>{{$data->firstItem()+$no}}</td>
                                                <td>{{$p->produk->nama}}</td>
                                                <td>{{$p->stok}}</td>
                                                {{-- <td>{{$p->users->akun->nama}}</td> --}}
                                                <td>
                                                    <a href="#" class="delete" tambahstok-id="{{$p->id}}"
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
<div class="modal fade" id="tambahstokModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                @foreach($data1 as $p)
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
        var tambahstok_id = $(this).attr('tambahstok-id');
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data Tambahstok dengan id "+ tambahstok_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {

        setTimeout(function(){ window.location = "/tambahstok/hapus/"+tambahstok_id+""; }, 250);

        }else{
            window.location = "/tambahstok";
        }
        })

    });
</script>
@stop
