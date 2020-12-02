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
                                <a class="nav-link active" href="/myprofile">My Profile</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="/changepassword">Change Password</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4 text-center">
                        <img width="150" height="150" src="{{auth()->user()->akun->getAvatar()}}">
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
                                        Name
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->nama}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        E-mail
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->email}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        Phone Number
                                    </div>
                                    <div class="col-9">
                                        {{auth()->user()->akun->nohp}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        Address
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
