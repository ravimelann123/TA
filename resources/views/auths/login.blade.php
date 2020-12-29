<!doctype html>
<html lang="en">

<head>
    @include('master.head')

</head>

<body style="background-color: #e9ecef">
    <!-- NAVBAR -->
    {{-- @include('master.navlogin') --}}
    {{-- END NAVBAR --}}

    {{-- JUMBOTRON  --}}
    {{-- <div class="jumbotron jumbotron-fluid jumbotronhome">
        <div class="container">
            <h1 class="display-4">START YOUR DAY <br>WITH <span>DELICIOUS</span> <br>BREAKFAST</h1>
        </div>
    </div> --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/postlogin" method="POST">
                            <div class="row mb-2">
                                <div class="col-md text-center">
                                    <h3 class="modal-title">KUE BOLU RM</h3>
                                </div>
                            </div>

                            {{ csrf_field() }}
                            <div class="row mb-2">
                                <div class="col-md ">
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
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    @include('master.s')

</body>

</html>
