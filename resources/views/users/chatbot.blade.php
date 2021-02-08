@extends('master.masterlayout')
@section('content')

<div class="row">
    <div class="col-md">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="wrapper">

                    <div class="title">
                        Chatbot
                    </div>
                    <div class="form">
                        {{-- <div class="bot-inbox inbox">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="msg-header">
                                <p>halllo ini pesan dari chatbot</p>
                            </div>
                        </div>
                        <div class="user-inbox inbox">
                            <div class="msg-header">

                                <p>asd</p>

                            </div>
                        </div> --}}
                    </div>
                    <div class="typing-field">
                        <a class="btn" data-toggle="modal" data-target="#infoModal"><i class="fas fa-info-circle"></i>
                        </a>
                        <div class="input-data">
                            <input id="data" type="text" placeholder="ketikan sesuatu" required>
                            <button id="send-btn">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aturan Produksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Tampilkan seluruh produk, tampilkan seluruh pesanan, tampilkan nama
                        produk,tampilkan harga produk, tampilkan nama harga produk, tampilkan status pesanan</li>
                    <li class="list-group-item">Saya mau pesan kue <b>nama kue</b> : <b>jumlah</b> ...</li>
                    <li class="list-group-item">batal pesanan nomor <b>nomor pesanan</b>
                    </li>
                    <li class="list-group-item">ubah pesanan <b>nama kue</b> : <b>jumlah</b> ...</li>
                    <li class="list-group-item">berapa jumlah pesanan, berapa jumlah biaya pesanan </li>
                    <li class="list-group-item"> kapan pesanan nomor <b>nomor pesanan</b> terjadi</li>
                    <li class="list-group-item"> apa pesanan nomor <br>apa produk ditawarkan</li>
                </ul>

            </div>

        </div>
    </div>
</div>
{{-- end modal create --}}
@stop

@section('footer')
<script>
    $(document).ready(function(){
    $("#send-btn").on("click",function(){
        var value = $("#data").val();

       $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+value+'</p></div></div>';
       $(".form").append($msg);
       $("#data").val('');
            $.ajax({
            type: "POST",
            url: '/chatbot/chat',
            data: { pesan:value,  _token: '{{csrf_token()}}' },
            success: function(Response) {
               var msg = Response.pesan
                $replay =' <div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+msg+'</p> </div>';
                $(".form").append($replay);
                $(".form").scrollTop($(".form")[0].scrollHeight);
            },
        });
    });
});
</script>
@stop
