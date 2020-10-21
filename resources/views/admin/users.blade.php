@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/users">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                                    class="lnr lnr-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-5">
                            <h3>Buat Akun</h3>
                        </div>
                        <div class="col-md-4"><input type="text" name="cari" class="form-control" placeholder="Cari"
                                style="border-radius: 20px">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="border-radius: 20px">Cari</button>
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
                                    <th>Username</th>
                                    {{-- <th>Pasword</th> --}}
                                    <th>Role</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datausers as $p)
                                <tr>
                                    <td>{{ $p->username }}</td>
                                    {{-- <td>{{ $p->password }}</td> --}}
                                    <td>{{ $p->role }}</td>
                                    <td>
                                        <a href="/users/edit/{{ $p->id }}" class="btn btn-warning"
                                            style="border-radius: 15px"><i class="lnr lnr-pencil"></i></a>
                                        <a href="/users/hapus/{{ $p->id }}" class="btn btn-danger"
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
                <h5 class="modal-title" id="exampleModalLabel">Buat Akun </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/users/create" method="POST">

                    {{ csrf_field() }}

                    <div class="form-group row {{$errors->has('username') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" value="{{old('username')}}">

                            @if($errors->has('username'))
                            <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('password') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" value="{{old('password')}}">

                            @if($errors->has('password'))
                            <span class="help-block">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{$errors->has('role') ? 'has-error' : ''}}">
                        <label class="col-sm-4 col-form-label">Pilih Role</label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control">
                                <option value="admin" {{(old('role') == 'admin' ) ? ' selected' : ''}}>Admin
                                </option>
                                <option value="user" {{(old('role') == 'user' ) ? ' selected' :''}}>User</option>
                            </select>

                            @if($errors->has('role'))
                            <span class="help-block">{{$errors->first('role')}}</span>
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
