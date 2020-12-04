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
{{-- NAVBAR SUPERADMIN--}}
@if(auth()->user()->role=='superadmin')
<nav class="navbar navbar-expand-lg navbar-light bg-white">

    <a class="navbar-brand" href="/dashboard">Bolu RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Master
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/superadmin_users">Akun</a>
                    <a class="dropdown-item" href="/superadmin_produk">Produk</a>
                    <a class="dropdown-item" href="/superadmin_tambahstok">Tambah Stok</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/superadmin_tambahstok">Tambah Stok</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Proses
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/superadmin_aturan">Aturan</a>
                    <a class="dropdown-item" href="/superadmin_bahasaalami">Bahasa Alami</a>
                    <a class="dropdown-item" href="/superadmin_datasetchatbot">Dataset Chatbot</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/superadmin_Prosess_NLP">Proses NLP</a>
                </div>
            </li>
            {{-- <a class=" nav-item nav-link navku" href="/dashboard"><i class="fas fa-bell"></i></a> --}}
            <a class=" nav-item nav-link navku" href="/dashboard"><i class=" fas fa-home"></i></a>

            <a class="nav-item  btn btn-danger navkutombol tombol" type="submit" href="/logout">Log Out<i
                    class="fas fa-sign-out-alt" style="margin-left: 5px"></i></a>

        </div>
    </div>

</nav>

@endif
<!-- END NAVBAR -->
