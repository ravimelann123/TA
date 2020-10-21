@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/photoproduk">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <a href="/produk" class="btn btn-danger"><i class="lnr lnr-chevron-left"></i>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <h3>Detail Foto</h3>
                        </div>
                        <div class="col-md-6">
                        </div>

                    </div>
                </div>
            </form>
            <div class="card-body">

                <div class="row">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-white">
                                <tr>

                                    <th>Image</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($photo as $p)
                                <tr>

                                    <td><img src="/images/produk/{{$p->namafoto}}" width="125" height="125"></td>
                                    <td>
                                        <a href="" class="btn btn-warning" data-toggle="modal"
                                            data-target="#exampleModal" style="border-radius: 15px"><i
                                                class="lnr lnr-pencil"></i></a>
                                        <a href="/photoproduk/hapus/{{$p->id}}" class="btn btn-danger"
                                            style="border-radius: 15px"><i class="lnr lnr-trash"></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
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

                    <div class="form-group row {{$errors->has('namafoto') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Upload Image</label>
                        <div class="col-sm-8">
                            <input type="file" name="namafoto" class=" form-control-file">
                            @if($errors->has('namafoto'))
                            <span class="help-block">{{$errors->first('namafoto')}}</span>
                            @endif
                        </div>
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
{{-- END MODAL --}}


@endsection
