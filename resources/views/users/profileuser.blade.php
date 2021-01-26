@extends('master.masterlayout')
@section('content')

<div class="col">
    <div class="card" style="min-height:85vh">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col text-center">
                    <h1>
                        Biodata
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 text-center">
                    <img width="150" height="150" src="{{auth()->user()->getAvatar()}}">
                    <h5 style="text-transform: capitalize">{{auth()->user()->username}}</h5>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#passwordModal"
                        style="border-radius: 5px">Ubah Kata Sandi
                    </button>
                </div>

                <div class="col-md-6">

                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-3">
                                    Nama
                                </div>
                                <div class="col-9">
                                    {{auth()->user()->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    Email
                                </div>
                                <div class="col-9">
                                    {{auth()->user()->email}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    Nomer Handphone
                                </div>
                                <div class="col-9">
                                    {{auth()->user()->nohp}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    Alamat
                                </div>
                                <div class="col-9">
                                    {{auth()->user()->alamat}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#biodataModal" style="border-radius: 5px;"><i class="fas fa-edit"></i>
                            </button>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>


<!-- Modal Create-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kata sandi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/changepassword/update" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class=" form-group row">
                        <label class="col-md-4 col-form-label">Kata Sandi Lama</label>
                        <div class="col-md-8">
                            <input type="password" name="passwordlama"
                                class="form-control {{$errors->has('passwordlama') ? 'is-invalid' : ''}}" value="">

                            @if($errors->has('passwordlama'))
                            <span class="invalid-feedback">{{$errors->first('passwordlama')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-4 col-form-label">
                            Kata Sandi Baru</label>
                        <div class="col-md-8">
                            <input type="password" name="passwordbaru"
                                class="form-control {{$errors->has('passwordbaru') ? 'is-invalid' : ''}}" value="">

                            @if($errors->has('passwordbaru'))
                            <span class="invalid-feedback">{{$errors->first('passwordbaru')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-4 col-form-label">
                            Konfirmasi Kata Sandi</label>
                        <div class="col-md-8">
                            <input type="password" name="konfirmasipassword"
                                class="form-control {{$errors->has('konfirmasipassword') ? 'is-invalid' : ''}}"
                                value="">

                            @if($errors->has('konfirmasipassword'))
                            <span class="invalid-feedback">{{$errors->first('konfirmasipassword')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end modal create --}}


<!-- Modal Create-->
<div class="modal fade" id="biodataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Biodata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/changemyprofile/update" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Username</label>
                        <div class="col-md-8">
                            <input type="text" name="username"
                                class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                                value="{{ auth()->user()->username}}">

                            @if($errors->has('username'))
                            <span class="invalid-feedback">{{$errors->first('username')}}</span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama"
                                class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}"
                                value="{{auth()->user()->nama}}">
                            @if($errors->has('nama'))
                            <span class="invalid-feedback">{{$errors->first('nama')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">E-mail</label>
                        <div class="col-md-8">
                            <input type="email" name="email"
                                class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                                value="{{auth()->user()->email}}">
                            @if($errors->has('email'))
                            <span class="invalid-feedback">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"> No. HP</label>
                        <div class="col-md-8">
                            <input type="text" name="nohp"
                                class="form-control {{$errors->has('nohp') ? 'is-invalid' : ''}}"
                                value="{{auth()->user()->nohp}}">
                            @if($errors->has('nohp'))
                            <span class="invalid-feedback">{{$errors->first('nohp')}}</span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea name="alamat"
                                class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}">{{auth()->user()->alamat  }}</textarea>
                            @if($errors->has('alamat'))
                            <span class="invalid-feedback">{{$errors->first('alamat')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Foto Profil</label>
                        <div class="col-md-8">
                            <input type="file" name="avatar"
                                class=" form-control-file {{$errors->has('avatar') ? 'is-invalid' : ''}}">
                            @if($errors->has('avatar'))
                            <span class="invalid-feedback">{{$errors->first('avatar')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end modal create --}}
@stop
