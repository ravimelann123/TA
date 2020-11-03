@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="/myprofile">Profil Saya</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="/changepassword">Rubah Kata Sandi</a>
                            </li>

                        </ul>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{auth()->user()->akun->getAvatar()}}">
                        <h5 style="text-transform: capitalize">{{auth()->user()->username}}</h5>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col">
                                <h4 style="border-bottom: 2px solid gray;">
                                    Biodata
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-3">
                                        Nama
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->nama}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        Email
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->email}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        Nomer HP
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->nohp}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        Alamat
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->alamat}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col"><a href="/changemyprofile" style=" color: orange;"><i
                                        class="fas fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection