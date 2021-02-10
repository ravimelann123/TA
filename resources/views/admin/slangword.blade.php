@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item active"><a href="/admin/slangword" style="color: #212529">
                                    <b>Table Data Slang Word</b>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Slang Word</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col">




                    </div>
                </div>

                <form method="GET" action="/admin/slangword">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#slangwordModal"><i class="fas fa-plus-square"></i>
                                    </button>
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
                                    <th>Slang Word</th>
                                    <th>Formal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="datatable">
                                @foreach( $data as $no =>$p)
                                <tr>
                                    <td>{{$data->firstItem()+$no}}</td>
                                    <td>{{$p->slangword}}</td>
                                    <td>{{ $p->formal}}</td>
                                    <td> <a href="javascript:void(0)" onclick="editSlang({{$p->id}})"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" slangw-id="{{$p->id}}" class="delete btn btn-danger btn-sm"><i
                                                class="fas fa-trash-alt"></i></a>


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
<div class="modal fade" id="slangwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="/admin/slangword/create" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Slang word</label>
                        <div class="col-sm-8">
                            <input type="text" name="slangword"
                                class="form-control {{$errors->has('slangword') ? 'is-invalid' : ''}}"
                                value="{{old('slangword')}}">

                            @if($errors->has('slangword'))
                            <span class="invalid-feedback">{{$errors->first('slangword')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Formal</label>
                        <div class="col-sm-8">
                            <input type="text" name="formal"
                                class="form-control {{$errors->has('formal') ? 'is-invalid' : ''}}"
                                value="{{old('formal')}}">

                            @if($errors->has('formal'))
                            <span class="invalid-feedback">{{$errors->first('formal')}}</span>
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
<div class="modal fade" id="slangwordeditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Salngword</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/slangword/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Slang Word</label>
                        <div class="col-sm-8">
                            <input type="text" id="slangword" name="slangword"
                                class="form-control {{$errors->has('slangword') ? 'is-invalid' : ''}}">

                            @if($errors->has('slangword'))
                            <span class="invalid-feedback">{{$errors->first('slangword')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-sm-4 col-form-label">Formal</label>
                        <div class="col-sm-8">
                            <input type="text" id="formal" name="formal"
                                class="form-control {{$errors->has('formal') ? 'is-invalid' : ''}}">
                            @if($errors->has('formal'))
                            <span class="invalid-feedback">{{$errors->first('formal')}}</span>
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
    function editSlang(id){
    $.get('/admin/slangword/'+id,function(p){
        $("#id").val(p.id);
        $("#slangword").val(p.slangword);
        $("#formal").val(p.formal);
        $("#slangwordeditModal").modal("toggle");
    });
}
    $('.delete').click(function(){
        var slangw = $(this).attr('slangw-id');
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data user dengan id "+ slangw +"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {

        if (result.isConfirmed) {
        setTimeout(function(){ window.location = "/admin/slangword/"+slangw+"/delete"; }, 250);
        }else{
            window.location = "/admin/slangword";
        }
        })
    });
</script>
@stop
