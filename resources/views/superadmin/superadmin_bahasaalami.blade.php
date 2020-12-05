@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bahasa Alami</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="/superadmin_bahasaalami" class="btn btn-info">
                                    <i class="fas fa-sync"></i>
                                </a>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#aturanModal" style="border-radius: 5px">Tambah <i
                                        class="fas fa-plus-square"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="/superadmin_bahasaalami">
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
                                                    <th>Tag</th>
                                                    <th>Kata</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="datatable">
                                                @foreach( $data as $no =>$p)
                                                <tr>
                                                    <td>{{$data->firstItem()+$no}}</td>
                                                    <td>{{$p->tag}}</td>
                                                    <td>{{ $p->kata}}</td>
                                                    <td> <a href="javascript:void(0)" onclick="editAturan({{$p->id}})"
                                                            style=" color: orange;"><i class="fas fa-edit"></i></a>
                                                        <a href="#" bahasaalami-id="{{$p->id}}" class="delete"
                                                            style="color: red;"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{$data->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create-->
<div class="modal fade" id="aturanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Bahasa Alami</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/superadmin_bahasaalami/create" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row {{$errors->has('tag') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Tag</label>
                        <div class="col-sm-8">
                            <input type="text" name="tag" class="form-control" value="{{old('tag')}}">

                            @if($errors->has('tag'))
                            <span class="help-block">{{$errors->first('tag')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('kata') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Kata</label>
                        <div class="col-sm-8">
                            <input type="text" name="kata" class="form-control" value="{{old('kata')}}">

                            @if($errors->has('kata'))
                            <span class="help-block">{{$errors->first('kata')}}</span>
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
{{-- end modal create --}}

<!-- Modal edit-->
<div class="modal fade" id="aturaneditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Bahasa Alami</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aturaneditform" action="/superadmin_bahasaalami/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group row {{$errors->has('tag') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Tag</label>
                        <div class="col-sm-8">
                            <input type="text" id="tag" name="tag" class="form-control">

                            @if($errors->has('tag'))
                            <span class="help-block">{{$errors->first('tag')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('kata') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">kata</label>
                        <div class="col-sm-8">
                            <input type="text" id="kata" name="kata" class="form-control">
                            @if($errors->has('kata'))
                            <span class="help-block">{{$errors->first('kata')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
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
    function editAturan(id){
    $.get('/superadmin_bahasaalami/'+id,function(d){
        $("#id").val(d.id);
        $("#tag").val(d.tag);
        $("#kata").val(d.kata);
        $("#aturaneditModal").modal("toggle");
    });
}
    $('.delete').click(function(){
        var bahasaalami_id = $(this).attr('bahasaalami-id');
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ bahasaalami_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {

        if (result.isConfirmed) {
        setTimeout(function(){ window.location = "/superadmin_bahasaalami/"+bahasaalami_id+"/delete"; }, 250);
        }else{
            window.location = "/superadmin_bahasaalami";
        }
        })
    });
</script>
@stop
