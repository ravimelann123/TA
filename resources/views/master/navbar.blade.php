{{-- NAVBAR USER--}}
@if(auth()->user()->role=='user')

<nav class="navbar navbar-expand-lg navbar-light bg-white">

    <a class="navbar-brand" href="/dashboard">Bolu RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">

            <a class=" nav-item nav-link navku" href="/dashboard"><i class=" fas fa-home"
                    style="margin-right: 5px"></i></a>
            <a class=" nav-item nav-link navku" href="/cart"><i class="fas fa-shopping-basket"
                    style="margin-right: 5px"></i></a>
            <a class=" nav-item nav-link navku" href="/chatbot"><i class="fas fa-comments"
                    style="margin-right: 5px"></i></a>
            <a class=" nav-item nav-link navku" href="/myprofile"><i class="fas fa-cog"
                    style="margin-right: 5px"></i></a>
            <a class="nav-item btn btn-danger navkutombol tombol" type="submit" href="/logout">Log out<i
                    class="fas fa-sign-out-alt" style="margin-left: 5px"></i></a>
        </div>
    </div>

</nav>
@endif
{{-- NAVBAR ADMIN--}}
@if(auth()->user()->role=='admin')
<nav class="navbar navbar-expand-lg navbar-light bg-white">

    <a class="navbar-brand" href="/dashboard">Bolu RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">

            {{-- <a class=" nav-item nav-link navku" href="/dashboard"><i class="fas fa-bell"></i></a> --}}
            <a class=" nav-item nav-link navku" href="/dashboard"><i class=" fas fa-home"></i></a>

            <a class="nav-item  btn btn-danger navkutombol tombol" type="submit" href="/logout">Log Out<i
                    class="fas fa-sign-out-alt" style="margin-left: 5px"></i></a>

        </div>
    </div>

</nav>

@endif
<!-- END NAVBAR -->
