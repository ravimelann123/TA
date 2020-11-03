@extends('master.masterlayout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <form method="GET" action="/akun">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-md">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <a href="/myprofile" type="button" class="btn btn-primary">Profile Saya</a>
                                <a href="/changepassword" type="button" class="btn btn-primary">Ganti Kata Sandi</a> --}}
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
                                <li class="breadcrumb-item active" aria-current="page">Chatbot</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <form method="post" action="/chatbot/chat" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            <div class="form-group row {{$errors->has('chat') ? 'has-error' : ''}}">
                                <label class="col-sm-2 col-form-label">Chat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="chat" class="form-control" value="">

                                    @if($errors->has('chat'))
                                    <span class="help-block">{{$errors->first('chat')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm text-right">
                                    <input type="submit" class="btn warnaku" value="Simpan" style="border-radius: 20px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
