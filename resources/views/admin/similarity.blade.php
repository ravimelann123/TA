@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active"><a href="/admin/similarity" style="color: #212529">
                                    <b>Table Data Similarity</b>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Similarity</li>
                        </ol>

                    </div>
                </div>



                <form method="GET" action="/admin/similarity">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
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
                                    <th>Id Training</th>
                                    <th>Users</th>
                                    <th>Pesan</th>
                                    <th>Perbandingan</th>
                                    <th>Similarity</th>
                                </tr>
                            </thead>
                            <tbody id="datatable">
                                @foreach( $data as $no =>$p)
                                <tr>
                                    <td>{{$data->firstItem()+$no}}</td>
                                    <td>{{ $p->training_id}}</td>
                                    <td>{{ $p->users->akun->nama}}</td>
                                    <td>{{ $p->pesan}}</td>
                                    <td>{{ $p->balas}}</td>
                                    <td>{{ $p->similarity}}</td>
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
<div class="modal fade" id="datasetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dataset Chatbot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/dataset/create" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row {{$errors->has('chat') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Chat</label>
                        <div class="col-sm-8">
                            <input type="text" name="chat" class="form-control" value="{{old('chat')}}">

                            @if($errors->has('chat'))
                            <span class="help-block">{{$errors->first('chat')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('balas') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Balas</label>
                        <div class="col-sm-8">
                            <input type="text" name="balas" class="form-control" value="{{old('balas')}}">

                            @if($errors->has('balas'))
                            <span class="help-block">{{$errors->first('balas')}}</span>
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
<div class="modal fade" id="dataseteditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="dataseteditform" action="/superadmin_datasetchatbot/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group row {{$errors->has('chat') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Chat</label>
                        <div class="col-sm-8">
                            <input type="text" id="chat" name="chat" class="form-control">

                            @if($errors->has('chat'))
                            <span class="help-block">{{$errors->first('chat')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('balas') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Balas</label>
                        <div class="col-sm-8">
                            <input type="text" id="balas" name="balas" class="form-control">
                            @if($errors->has('balas'))
                            <span class="help-block">{{$errors->first('balas')}}</span>
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
    $.get('/superadmin_datasetchatbot/'+id,function(d){
        $("#id").val(d.id);
        $("#chat").val(d.chat);
        $("#balas").val(d.balas);
        $("#dataseteditModal").modal("toggle");
    });
}
    $('.delete').click(function(){
        var dataset_id = $(this).attr('dataset-id');
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ dataset_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {

        if (result.isConfirmed) {
        setTimeout(function(){ window.location = "/superadmin_datasetchatbot/"+dataset_id+"/delete"; }, 250);
        }else{
            window.location = "/superadmin_datasetchatbot";
        }
        })
    });
</script>
@stop
