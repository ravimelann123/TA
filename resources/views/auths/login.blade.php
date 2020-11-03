<!doctype html>
<html lang="en">

<head>
    @include('master.head')

</head>

<body style="background-color: #e9ecef">
    <!-- NAVBAR -->
    @include('master.navlogin')
    {{-- END NAVBAR --}}

    {{-- JUMBOTRON  --}}
    <div class="jumbotron jumbotron-fluid jumbotronhome">
        <div class="container">
            <h1 class="display-4">START YOUR DAY <br>WITH <span>DELICIOUS</span> <br>BREAKFAST</h1>

        </div>
    </div>
    {{-- END JUMBOTRON --}}
    <div class="container">

        <div class="row justify-content-center mb-3">
            <div class="col-md-12 info-panelview">
                @include('master.grid')
            </div>
        </div>

    </div>

    @include('master.s')

</body>

</html>