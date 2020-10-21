{{-- NAVBAR USER--}}
@if(auth()->user()->role=='user')

<nav class="navbar navbar-expand-lg navbar-light">

    <a class="navbar-brand" href="#">Bolu RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class=" nav-item nav-link navku" href="/dashboard">Home</a>
            <li class="nav-item dropdown dropdownku">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Pesanan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/cart">Pesan</a>
                    <a class="dropdown-item" href="/changepassword">s</a>

                </div>
            </li>
            <li class="nav-item dropdown dropdownku">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Pengaturan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/myprofile">My Profile</a>
                    <a class="dropdown-item" href="/changepassword">Change Password</a>
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
<nav class="navbar navbar-expand-lg navbar-light">

    <a class="navbar-brand" href="#">Bolu RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">

            <a class=" nav-item nav-link navku" href="/dashboard">Home</a>
            <a class=" nav-item nav-link navku" href="/indexorder">Daftar Penjualan</a>

            <li class="nav-item dropdown dropdownku">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Master
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/akun">Biodata</a>
                    <a class="dropdown-item" href="/users">Akun</a>
                    <a class="dropdown-item" href="/produk">Produk</a>
                    <a class="dropdown-item" href="/tambahstok">Tambah Stok</a>

                </div>
            </li>
            <a class="nav-item  btn btn-danger navkutombol tombol" type="submit" href="/logout">Log Out</a>

        </div>
    </div>

</nav>
@endif
<!-- END NAVBAR -->
