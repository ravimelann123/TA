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

                <div class="row ml-1 mr-1">
                    <div class="col-6">
                        <div class="row" style="background-color: #e9ecef">

                            <div class="col text-center mt-2">
                                <img src="{{auth()->user()->akun->getAvatar()}}"
                                    style="border-radius: 100px; width: 200px; height: 200px;">
                                <h5 style="text-transform: capitalize">{{auth()->user()->username}}</h5>
                            </div>
                        </div>
                        <div class="row pt-2 pb-3" style="background-color: #00A0F0;">

                            <div class="col-md text-center">
                                {{$totalorder}}<br><span>Pesanan Saya</span>
                            </div>
                            <div class="col-md text-center">
                                {{$selesai}}<br><span>
                                    Pesanan Selesai</span>
                            </div>



                        </div>
                    </div>


                    <div class="col-6" style="background-color: #e9ecef">
                        <div class="row">
                            <div class="col">
                                <h4 style="border-bottom: 2px solid gray;">
                                    Biodata
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                Nama
                            </div>
                            <div class="col-9">
                                {{auth()->user()->akun->nama}}
                            </div>

                            <div class="col-3">
                                Email
                            </div>
                            <div class="col-9">
                                {{auth()->user()->akun->email}}
                            </div>

                            <div class="col-3">
                                Nomer HP
                            </div>
                            <div class="col-9">
                                {{auth()->user()->akun->nohp}}
                            </div>

                            <div class="col-3">
                                Alamat
                            </div>
                            <div class="col-9">
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
