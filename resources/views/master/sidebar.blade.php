{{-- NAVBAR admin--}}
@if(auth()->user()->role=='admin')
<div class="col-md-3 mb-3">
    <div class="card" style="min-height:85vh">
        {{-- <div class="card-header bg-white">
        </div> --}}
        <div class="card-body">
            <div class="sidebar" style="background-color:#007bff; border-radius: 10px">
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
                            <a class="dropdown-item" href="/users">Akun</a>
                            <a class="dropdown-item" href="/akun">Biodata</a>
                            <a class="dropdown-item" href="/produk">Produk</a>
                            <a class="dropdown-item" href="/tambahstok">Tambah Stok</a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/indexorder" class="btn" style="color: white">Pesanan</a>
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
            <div class="sidebar" style="background-color:#007bff; border-radius: 10px">
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
                        <a href="#" class="btn" style="color: white">Pesanan</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/allproduk" class="btn" style="color: white">Produk</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif