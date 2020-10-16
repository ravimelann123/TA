<!doctype html>
<html lang="en">

<head>
    @include('master.head')

</head>

<body>
    <!-- NAVBAR -->
    @include('master.navlogin')
    {{-- END NAVBAR --}}


    <div class="container">

        {{-- JUMBOTRON  --}}
        <div class="jumbotron jumbotron-fluid jumbotronhome">
            <div class="container">
                <h1 class="display-4">START YOUR DAY <br>WITH <span>DELICIOUS</span> <br>BREAKFAST</h1>

            </div>
        </div>
        {{-- END JUMBOTRON --}}
        <div class="row justify-content-center">
            <div class="col-md-12 viewall info-panelview">
                <div class="row">
                    <div class="col-12 text-center mb-2 mt-2 mr-2"><a href="/viewall">View ALL</a></div>
                </div> @include('master.grid')
            </div>
        </div>

    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="dashboard.js"></script> --}}
    <!-- Javascript -->

    @include('master.s')

</body>

</html>
