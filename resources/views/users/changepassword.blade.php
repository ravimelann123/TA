@extends('master.masterlayout')
@section('content')
{{-- JUMBOTRON  --}}
<div class="jumbotron jumbotron-fluid jumbotronuser">
    <div class="container">
    </div>
</div>
{{-- END JUMBOTRON --}}
<div class="row justify-content-center">
    <div class="col-4 info-panel">
        <div class="row">
            <div class="col-lg">
                <form method="post" action="/changepassword/update" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group {{$errors->has('passwordlama') ? 'has-error' : ''}}">
                        <label>Katasanti Lama</label>
                        <input type="password" name="passwordlama" class="form-control" value="">

                        @if($errors->has('passwordlama'))
                        <span class="help-block">{{$errors->first('passwordlama')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('passwordbaru') ? 'has-error' : ''}}">
                        <label>Katasandi Baru</label>
                        <input type="password" name="passwordbaru" class="form-control" value="">

                        @if($errors->has('passwordbaru'))
                        <span class="help-block">{{$errors->first('passwordbaru')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('konfirmasipassword') ? 'has-error' : ''}}">
                        <label>Konfirmasi Katasandi</label>
                        <input type="password" name="konfirmasipassword" class="form-control" value="">

                        @if($errors->has('konfirmasipassword'))
                        <span class="help-block">{{$errors->first('konfirmasipassword')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> @endsection
