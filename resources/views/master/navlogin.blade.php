{{-- NAVBAR LOGIN--}}
<nav class="navbar navbar-expand-lg navbar-light bg-white">

    <a class="navbar-brand" href="#">Bolu RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class=" nav-item nav-link navku" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link navku" href="">Contact Us</a>
            <a class="nav-item  btn btn-primary navkutombol tombol" type="submit" data-toggle="modal"
                data-target="#exampleModal"><i class="fas fa-sign-out-alt"></i></a>

        </div>
    </div>

</nav>
<!-- END NAVBAR -->
{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-inline" action="/postlogin" method="POST">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-md">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text lnr lnr-user" id=""></span>
                                </div>
                                <input type="text" class="form-control" placeholder="username" name="username">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text lnr lnr-lock" id=""></span>
                                </div>
                                <input type="password" class="form-control" placeholder="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md text-right">
                            <button type="submit" class="btn btn-primary" style="border-radius: 20px">Go</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
{{-- END MODAL --}}
