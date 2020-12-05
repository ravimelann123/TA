{{-- NAVBAR USER--}}
@if(auth()->user()->role=='user')
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="#">KUE BOLU RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">

            <div class="btn-group">
                <a href="/dashboard" class="btn btn-primary"
                    style="border-bottom-left-radius: 20px;border-top-left-radius: 20px"><i
                        class=" fas fa-home"></i></a>
                <a href="/cart" class="btn btn-primary"><i class="fas fa-shopping-basket"></i></a>
                <a href="/chatbot" class="btn btn-primary"
                    style="border-bottom-right-radius: 20px;border-top-right-radius: 20px"><i class=" fas
                    fa-comments"></i></a>
            </div>
            <a class="nav-item nav-link" href="/pesanan">PESANAN</a>
        </ul>
        <span>
            <a class="btn btn-danger" type="submit" href="/logout">Log
                out <i class="fas fa-sign-out-alt"></i></a>

        </span>
    </div>
</nav>

@endif
{{-- NAVBAR ADMIN--}}
@if(auth()->user()->role=='admin')
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="#">KUE BOLU RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <a class="btn btn-primary" href="/dashboard" style="border-radius: 20px"><i class=" fas fa-home"></i></a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MASTER
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/users">Akun</a>
                    <a class="dropdown-item" href="/produk">Produk</a>
                    <a class="dropdown-item" href="/tambahstok">Tambah Stok</a>
                    {{-- <div class="dropdown-divider"></div> --}}

                </div>
            </li>
            <a class="nav-item nav-link" href="/indexorder">PESANAN</a>
        </ul>
        <span>
            <a class="btn btn-danger" type="submit" href="/logout">Log
                out <i class="fas fa-sign-out-alt"></i></a>
        </span>
    </div>
</nav>

@endif
<!-- END NAVBAR -->
{{-- NAVBAR SUPERADMIN--}}
@if(auth()->user()->role=='superadmin')
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="#">KUE BOLU RM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <a class="btn btn-primary" href="/dashboard" style="border-radius: 20px"><i class=" fas fa-home"></i></a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MASTER
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/superadmin_users">Akun</a>
                    <a class="dropdown-item" href="/superadmin_produk">Produk</a>
                    <a class="dropdown-item" href="/superadmin_tambahstok">Tambah Stok</a>
                    {{-- <div class="dropdown-divider"></div> --}}

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    PROSES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/superadmin_aturan">Aturan</a>
                    <a class="dropdown-item" href="/superadmin_bahasaalami">Bahasa Alami</a>
                    <a class="dropdown-item" href="/superadmin_datasetchatbot">Dataset Chatbot</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/superadmin_Prosess_NLP">Proses NLP</a>
                </div>
            </li>

        </ul>
        <span>
            <a class="btn btn-danger" type="submit" href="/logout">Log
                out <i class="fas fa-sign-out-alt"></i></a>
        </span>
    </div>
</nav>


@endif
<!-- END NAVBAR -->
