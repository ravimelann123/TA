@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <h3>EDIT Data Users</h3>
    </div>

</div>
<div class="row">
    <div class="col">
        <form method="post" action="/users/update/{{ $users->id }}">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                <label>username</label>
                <input type="text" name="username" class="form-control" value=" {{ $users->username }}">

                @if($errors->has('username'))
                <span class="help-block">{{$errors->first('username')}}</span>
                @endif

            </div>

            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                <label>password</label>
                <input type="password" name="password" class="form-control" value="">

                @if($errors->has('password'))
                <span class="help-block">{{$errors->first('password')}}</span>
                @endif

            </div>

            <div class="form-group">
                <label>Pilih Role</label>
                <select name="role" class="form-control">
                    <option value="admin" @if($users->role == 'admin') selected @endif>Admin</option>
                    <option value="user" @if($users->role == 'user') selected @endif>User</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection
