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
                        <div class="bot-inbox inbox">
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
                        </div>


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
       $value= $("#data").val();
       $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+$value+'</p></div></div>';
       $(".form").append($msg);
       $("#data").val('');
    $.ajax({
        url:'/chatbot/chat',
        type:'POST',
        data:'text='+$value,
        success:function(result){
            $replay=' <div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i> </div><div class="msg-header"><p>'+result+'</p> </div></div>';
            $(".form").append($replay);
            $(".form").scrollTop($(".form")[0].scrollheight);
            }
        });
    });
});
</script>
@stop
{{-- <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chatbot</li>
                            </ol>
                        </nav>
                    </div>
                </div> --}}

{{-- <div class="row">
                    <div class="col">
                        <form method="post" action="/chatbot/chat" enctype="multipart/form-data">

                            {{ csrf_field() }}
<div class="form-group row {{$errors->has('chat') ? 'has-error' : ''}}">
    <label class="col-sm-2 col-form-label">Chat</label>
    <div class="col-sm-10">
        <input type="text" name="chat" class="form-control" value="">

        @if($errors->has('chat'))
        <span class="help-block">{{$errors->first('chat')}}</span>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-sm text-right">
        <input type="submit" class="btn warnaku" value="Simpan" style="border-radius: 20px">
    </div>
</div>
</form>
</div>
</div> --}}
