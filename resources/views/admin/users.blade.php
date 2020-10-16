@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="panel-title">Buat Acount</h3>
    </div>
    <div class="col-3">
        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                class="lnr lnr-plus-circle"></i>
        </button>
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
                <form action="/users/create" method="POST">

                    {{ csrf_field() }}
                    <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username"
                            value="{{old('username')}}">


                        @if($errors->has('username'))
                        <span class="help-block">{{$errors->first('username')}}</span>
                        @endif
                    </div>




                    <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password"
                            value="{{old('password')}}">

                        @if($errors->has('password'))
                        <span class="help-block">{{$errors->first('password')}}</span>
                        @endif

                    </div>

                    <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                        <label>Pilih Role</label>
                        <select name="role" class="form-control">
                            <option value="admin" {{(old('role') == 'admin' ) ? ' selected' : ''}}>Admin
                            </option>
                            <option value="user" {{(old('role') == 'user' ) ? ' selected' :''}}>User</option>
                        </select>
                        @if($errors->has('role'))
                        <span class="help-block">{{$errors->first('role')}}</span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{old('nama')}}">

                        @if($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="{{old('email')}}">

                        @if($errors->has('email'))
                        <span class="help-block">{{$errors->first('email')}}</span>
                        @endif

                    </div>
                    <div class="form-group {{$errors->has('nohp') ? 'has-error' : ''}}">
                        <label>No. Hp</label>
                        <input type="number" name="nohp" class="form-control" placeholder="No. HP"
                            value="{{old('nohp')}}">

                        @if($errors->has('nohp'))
                        <span class="help-block">{{$errors->first('nohp')}}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Alamat">{{old('alamat')}}</textarea>
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

<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
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
                        <a href="/users/edit/{{ $p->id }}" class="btn btn-warning">Edit</a>
                        <a href="/users/hapus/{{ $p->id }}" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



</div>
</div>


@endsection
