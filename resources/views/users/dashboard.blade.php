@extends('master.masterlayout')
@section('content')

<div class="row mb-3">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                {{-- <form method="GET" action="/dashboard">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h3>Produk</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form> --}}
                {{--
                <div class="row">
                    <div class="card-deck">
                        @foreach ( $photo as $p)
                        <div class="col-md-4"> --}}
                {{-- <form action="/cart/addproduk/{{$p->produk->id}}" method="POST"> --}}
                {{-- {{ csrf_field() }} --}}
                {{-- <label class="card-text text-center" style="text-transform: capitalize;">
                            <div class="card mb-3">
                                <img src="images/produk/{{$p->namafoto}}" class="card-img-top gambar"
                alt="Card image cap">
                <div class="card-body">
                    <a href="#">
                        <h5 class="card-title">{{$p->produk->nama}}</h5>
                    </a>
                    <p class="card-text">{{$p->produk->deskripsi}}</p>
                    <div class="row">
                        <div class="col text-left mt-2"> Rp.{{$p->produk->harga}}</div>
                        <div class="col text-right mb-1 mt-1 "> <button data-id="{{$p->produk->id}}"
                                class="btn btn-primary send-btn">
                                <i class="lnr lnr-cart"></i></button>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- </form> --}}
            {{-- </div>
                        @endforeach

                    </div>

                </div> --}}
        </div>
    </div>
</div>

</div>

@stop
@section('footer')
<script>
    $(document).ready(function(){
    $(".send-btn").on("click",function(){
    var id = $(this).attr('data-id');
        // Swal.fire(id);
    $.ajax({
        type: "POST",
        url: '/cart/addproduk/'+id+'',
        data: { _token: '{{csrf_token()}}' },
            success: function(Response) {

                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });
                Toast.fire({
                    icon: 'success',
                    title: "Berhasil Ditambahkan"
                });


            },
            error: function(Response) {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });
                Toast.fire({
                    icon: 'error',
                    title: "Produk Sudah ada di keranjang"
                });
            },
        });
    });
});
</script>
@stop
