<!doctype html>
<html lang="en">

<head>
    @include('master.head')

</head>

<body>
    @include('master.navlogin')

    <div class="container-fluid">
        <div class="row justify-content-center ">

            <div class="col-md-8">
                <div class="card" style="min-height:85vh">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold">Products</h4>
                            </div>
                            <div class="col"><input type="text" name="search"
                                    class="form-control form-control-sm col-sm-12 float-right"
                                    placeholder="Search Product..."></div>
                            <div class="col-sm-3"><button type="submit"
                                    class="btn btn-primary btn-sm float-right btn-block">Cari Product</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            @foreach ( $photo as $p)
                            <div class="col">
                                <form action="/transcation/addproduct/{{$p->produk->id}}" method="POST">
                                    @csrf
                                    {{-- <label class="card-text text-center" style="text-transform: capitalize;"> --}}
                                    <div class="card mb-3" style="width: 18rem;">
                                        <img src="images/produk/{{$p->namafoto}}" class="card-img-top gambar"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$p->produk->nama}}</h5>
                                            <p class="card-text">{{$p->produk->deskripsi}}</p>
                                            <div class="row">
                                                <div class="col text-left mt-2"> Rp.{{$p->produk->harga}}</div>
                                                <div class="col text-right mb-1 mt-1 "> <button class="btn btn-primary">
                                                        <i class="lnr lnr-cart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                            @endforeach </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">

                <div class="card" style="min-height:85vh">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col">Cart</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="overflow-y:auto;min-height:53vh;max-height:53vh" class="mb-3">
                            <table class="table table-sm">
                                <thead>
                                    <tr>

                                        <th width="30%">Nama Produk</th>
                                        <th width="30%">Jumlah</th>
                                        <th width="30%" class="text-right">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('master.s') </body>

</html>
