@extends('master.masterlayout')
@section('content')
{{-- JUMBOTRON  --}}
<div class="jumbotron jumbotron-fluid jumbotronuser">
    <div class="container">
    </div>
</div>
{{-- END JUMBOTRON --}}

<div class="row justify-content-center">
    <div class="col-8 info-panelfoto">
        <div class="row">
            <div class="col">
                <img src="{{auth()->user()->akun->getAvatar()}}">
                <h5>{{auth()->user()->username}}</h5>
            </div>
        </div>

    </div>

</div>
<div class="row justify-content-center">
    <div class="col-10 info-panelbiodata">
        <div class="row">
            <div class="col-lg justify-content-center">
                <div class="row ">
                    <div class="col-md-6 text-center warnaku kotakku">
                        45 <br><span>My Order</span>
                    </div>
                    <div class="col-md-6 text-center warnaku kotakku">
                        15 <br><span>
                            order complete</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg">
                <p><span>"</span>Perkenalkan Saya <span>{{auth()->user()->akun->nama}}</span>. <br>Saya memiliki Email
                    loh,
                    yaitu
                    : <span>{{auth()->user()->akun->email}}</span>.<br> Nomer Hanphone saya adalah
                    <span> {{auth()->user()->akun->nohp}}</span> <br>Dan saya tinggal Di<span>
                        {{auth()->user()->akun->alamat}}"</span>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg text-right"><a href="/changemyprofile" class="btn warnaku lnr lnr-pencil"></a>
            </div>
        </div>
    </div>
</div>
@endsection
