@extends('master.masterlayout')
@section('content')

<div class="row">
    <div class="col-md">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="wrapper">
                    <div class="title">
                        Simpel Chatbot
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
