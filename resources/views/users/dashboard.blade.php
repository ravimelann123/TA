@extends('master.masterlayout')
@section('content')


<div class="col">
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
            <div class="row mb-3">
                <div class="col">
                    <h4>Dashboard</h4>
                </div>
                <div class="col text-right" style="color: gray; font-size: 14px">Welcome.
                    {{auth()->user()->username}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card " style="border-left: 5px solid #075e54; box-shadow: 3px 4px 5px #b6b6b6;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-uppercase mb-1">
                                        Pesanan
                                    </div>
                                    @php
                                    $count=0;
                                    @endphp
                                    @foreach($order as $p)
                                    @if($p->prosesnlp->kalimat->users->id == auth()->user()->id)
                                    @php
                                    $count = $count + 1;
                                    @endphp
                                    @endif
                                    @endforeach

                                    {{$count}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
