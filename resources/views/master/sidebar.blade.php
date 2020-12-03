{{-- NAVBAR admin--}}
@if(auth()->user()->role=='admin')
<div class="col-md-3 mb-3">
    <div class="card" style="min-height:85vh">
        {{-- <div class="card-header bg-white">
        </div> --}}
        <div class="card-body">
            <div class="sidebar" style="background-color:#075e54; border-radius: 10px">
                <div class="row">
                    <div class="col">
                        <a href="/dashboard" class="btn" style="color: white">Home</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="dropdown-btn btn" style="color: white">Master
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container mb-2 mt-2 ml-2 mr-2" style="background-color: white;">
                            <a class="dropdown-item" href="/users">Account</a>
                            <a class="dropdown-item" href="/produk">Product</a>
                            <a class="dropdown-item" href="/tambahstok">Add Stock</a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/indexorder" class="btn" style="color: white">Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- NAVBAR USER--}}
@if(auth()->user()->role=='user')
<div class="col-md-3 mb-3">
    <div class="card" style="min-height:85vh">
        {{-- <div class="card-header bg-white">
        </div> --}}
        <div class="card-body">
            <div class="sidebar" style="background-color:#075e54; border-radius: 10px">
                <div class="row">
                    <div class="col">
                        <a href="/dashboard" class="btn" style="color: white">Home</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/chatbot" class="btn" style="color: white">Chatbot</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="/pesanan" class="btn" style="color: white">My Order</a>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col">
                        <a href="/allproduk" class="btn" style="color: white">Produk</a>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
@endif

{{-- NAVBAR super admin--}}
@if(auth()->user()->role=='superadmin')
<div class="col-md-3 mb-3">
    <div class="card" style="min-height:85vh">
        {{-- <div class="card-header bg-white">
        </div> --}}
        <div class="card-body">
            <div class="sidebar" style="background-color:#075e54; border-radius: 10px">
                <div class="row">
                    <div class="col">
                        <a href="/dashboard" class="btn" style="color: white">Home</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="dropdown-btn btn" style="color: white">Master
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container mb-2 mt-2 ml-2 mr-2" style="background-color: white;">
                            <a class="dropdown-item" href="/superadmin_users">Account</a>
                            <a class="dropdown-item" href="/superadmin_produk">Product</a>
                            <a class="dropdown-item" href="/superadmin_tambahstok">Add Stock</a>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <a class="dropdown-btn btn" style="color: white">Proses
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container mb-2 mt-2 ml-2 mr-2" style="background-color: white;">
                            <a class="dropdown-item" href="/superadmin_Prosess_NLP">Proses NLP</a>
                            <a class="dropdown-item" href="/superadmin_aturan">Aturan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
