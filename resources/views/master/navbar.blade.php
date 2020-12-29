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

            <a class="nav-item nav-link" href="/dashboard"><i class=" fas fa-home"></i> </a>
            <li class="nav-item dropdown">
                <a class="nav-link" href="" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MASTER
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/plgn/pesanan"><i class="fas fa-book"></i> Pesanan</a>
                    {{-- <a class="dropdown-item" href="/cart"><i class="fas fa-shopping-basket"></i> Keranjang</a> --}}
                    <a class="dropdown-item" href="/plgn/biodata"><i class="fas fa-user"></i> Biodata</a>
                    {{-- <div class="dropdown-divider"></div> --}}

                </div>
            </li>
            <a class="nav-item nav-link" href="/plgn/chatbot">CHATBOT</a>
        </ul>
        <span>
            <a class="btn btn-danger" type="submit" href="/logout" style="border-radius: 20px"> <i
                    class="fas fa-sign-out-alt"></i></a>

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
            <a class="nav-item nav-link" href="/dashboard"><i class=" fas fa-home"></i></a>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MASTER
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/users"><i class="fas fa-user-friends"></i> Users</a>
                    <a class="dropdown-item" href="/admin/produk"><i class="fas fa-clipboard-list"></i> Produk</a>
                    <a class="dropdown-item" href="/admin/pesanan"><i class="fas fa-book"></i> Pesanan</a>
                    <a class="dropdown-item" href="/admin/biodata"><i class="fas fa-user"></i> Biodata</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    PROSES NLP
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/admin/dataset"><i class="fas fa-database"></i> Dataset</a>
                    <a class="dropdown-item" href="/admin/proses_nlp"><i class="fas fa-laptop-code"></i> Proses Nlp</a>
                    <a class="dropdown-item" href="/admin/similarity"><i class="fas fa-balance-scale"></i>
                        Similarity</a>
                </div>
            </li>
            <a class="nav-item nav-link" href="/indexorder"></a>
        </ul>
        <span>
            <a class="btn btn-danger" type="submit" href="/logout" style="border-radius: 20px"><i
                    class="fas fa-sign-out-alt"></i></a>
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

            <li class="nav-item dropdown">
                <a class="nav-link" href="" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/dashboard"><i class=" fas fa-home"></i> Home</a>


                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
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
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
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
            <a class="btn btn-danger" type="submit" href="/logout" style="border-radius: 20px"><i
                    class="fas fa-sign-out-alt"></i></a>
        </span>
    </div>
</nav>


@endif
<!-- END NAVBAR -->
