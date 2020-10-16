@extends('master.masterlayout')
@section('content')
{{-- JUMBOTRON  --}}
<div class="jumbotron jumbotron-fluid jumbotronuser">
    <div class="container">
    </div>
</div>
{{-- END JUMBOTRON --}}
<div class="row justify-content-center">
    <div class="col-6 info-panel">
        <div class="row">
            <div class="col-lg justify-content-center">
                <img src="images/bg/mp.png">
                <h5><a href="/myprofile">My Profile</a></h5>
            </div>
            <div class="col-lg justify-content-center">
                <div class="col-lg ">
                    <img src="images/bg/cp.png">
                    <h5><a href="/changepassword">Change Password</a></h5>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
