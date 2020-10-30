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

            <a class=" nav-item nav-link navku" href="/cart"><i class="lnr lnr-cart">
                </i><span class="badge badge-primary">{{$totalcart}}</span>
            </a>
            <li class="nav-item dropdown dropdownku">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Pesanan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/allproduk">Produk</a>
                </div>
            </li>
            <li class="nav-item dropdown dropdownku">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Pengaturan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/myprofile">Profil Saya</a>
                    <a class="dropdown-item" href="/changepassword">Rubah Kata Sandi</a>
                    <a class="dropdown-item" href="/order">Pesan Langsung</a>
                </div>
            </li>
            <a class="nav-item btn btn-danger navkutombol tombol" type="submit" href="/logout">Log Out</a>
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

            <a class=" nav-item nav-link navku" href="/dashboard"><i class="fas fa-bell"></i></a>
            <a class=" nav-item nav-link navku" href="/dashboard"><i class=" fas fa-home"></i></a>

            <a class="nav-item  btn btn-danger navkutombol tombol" type="submit" href="/logout"><i
                    class="fas fa-sign-out-alt"></i></a>

        </div>
    </div>

</nav>

@endif
<!-- END NAVBAR -->
