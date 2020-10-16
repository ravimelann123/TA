@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col-9">
        <h3 class="panel-title">Detail Photo</h3>
    </div>
    <div class="col-3">
        <h3 class="panel-title"><a href="/produk"> Back</a></h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-hover text-left">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Image</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photo as $p)
                <tr>
                    <td>{{$p->namafoto}}</td>
                    <td><img src="/images/produk/{{$p->namafoto}}" width="100" height="100"></td>
                    <td>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Edit</a>
                        <a href="/photoproduk/hapus/{{$p->id}}" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- MODAL --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/photoproduk/edit/{{$p->id}}" method="POST" enctype="multipart/form-data">

                            {{ csrf_field() }}


                            <div class="form-group {{$errors->has('namafoto') ? 'has-error' : ''}}">
                                <label>Update Image</label>
                                <input type="file" name="namafoto" class=" form-control">
                                @if($errors->has('namafoto'))
                                <span class="help-block">{{$errors->first('namafoto')}}</span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
