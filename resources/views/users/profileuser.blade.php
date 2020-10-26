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
                                <a href="/myprofile" type="button" class="btn btn-primary">Profile Saya</a>
                                <a href="/changepassword" type="button" class="btn btn-primary">Ganti Kata Sandi</a>
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
                                <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-2">
                        <div class="row">
                            <div class="col">
                                <img src="{{auth()->user()->akun->getAvatar()}}">
                                <h5>{{auth()->user()->username}}</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-10">

                        <div class="row mb-3 mt-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md">
                                        45 <br><span>My Order</span>
                                    </div>
                                    <div class="col-md">
                                        15 <br><span>
                                            order complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                Nama
                            </div>
                            <div class="col-10">
                                {{auth()->user()->akun->nama}}
                            </div>

                            <div class="col-2">
                                Email
                            </div>
                            <div class="col-10">
                                {{auth()->user()->akun->email}}
                            </div>

                            <div class="col-2">
                                Nomer HP
                            </div>
                            <div class="col-10">
                                {{auth()->user()->akun->nohp}}
                            </div>

                            <div class="col-2">
                                Alamat
                            </div>
                            <div class="col-10">
                                {{auth()->user()->akun->alamat}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-right"><a href="/changemyprofile" class="btn warnaku lnr lnr-pencil"
                                    style="border-radius: 20px"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
