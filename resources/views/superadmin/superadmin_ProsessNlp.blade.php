@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Proses NLP</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <form method="GET" action="/superadmin_Prosess_NLP">
                    <div class="row mb-3">

                        <div class="col-md-8">
                            <h3>Proses NLP</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>


                @foreach($data as $d)
                <div class="row mb-4">
                    <div class="col">
                        <div class="card " style="border-top: 5px solid #075e54; box-shadow: 3px 4px 5px #b6b6b6;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="width: 45px"><i
                                                                class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{$d->users->akun->nama}}" disabled>
                                                </div>
                                                <div> </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Parsing</span>
                                                    </div>
                                                    @if($d->parsing == null)
                                                    @php $value= "Bukan Termasuk Aturan Produksi"; @endphp
                                                    @else
                                                    @php $value = $d->parsing; @endphp
                                                    @endif
                                                    <input type="text" class="form-control" value="{{$value}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="width: 45px"><i
                                                                class="fas fa-comments"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$d->kalimat}}"
                                                        disabled>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col table-responsive">
                                                <div class="scrollable">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Kata</th>
                                                                <th>Token</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($data1 as $p)
                                                            @if($p->kalimat_id == $d->id)
                                                            <tr>
                                                                <td>{{$p->kata}}</td>
                                                                <td>{{$p->token}}
                                                                </td>

                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @stop

    {{-- @section('footer')

    <script>
        $('.delete').click(function(){
        var tambahstok_id = $(this).attr('tambahstok-id');
        Swal.fire({
        title: "Yakin?",
        text: "Mau dihapus data Tambahstok dengan id "+ tambahstok_id+"??",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {

        setTimeout(function(){ window.location = "/tambahstok/hapus/"+tambahstok_id+""; }, 250);

        }else{
            window.location = "/tambahstok";
        }
        })
    });
    </script>
    @stop --}}
