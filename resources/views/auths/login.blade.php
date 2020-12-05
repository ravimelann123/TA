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
    {{-- <div class="jumbotron jumbotron-fluid jumbotronhome">
        <div class="container">
            <h1 class="display-4">START YOUR DAY <br>WITH <span>DELICIOUS</span> <br>BREAKFAST</h1>
        </div>
    </div> --}}

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Fluid jumbotron</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>

    @include('master.s')

</body>

</html>
