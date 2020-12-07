{{-- NAVBAR LOGIN--}}
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="#">KUE BOLU RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li> --}}

        </ul>
        <span class="navbar-text">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                style="border-radius: 20px"> <i class="fas fa-sign-in-alt"></i></button>

        </span>
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
            <form action="/postlogin" method="POST">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row mb-2">
                        <div class="col-md">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text lnr lnr-user"></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name="username">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text lnr lnr-lock"></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Go</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
{{-- END MODAL --}}
