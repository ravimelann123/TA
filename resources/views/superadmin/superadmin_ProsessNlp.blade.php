@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <ul class="nav nav-tabs">

                            <li class="nav-item">
                                <a class="nav-link active" href="/superadmin_tambahstok">Proses NLP </a>
                            </li>

                        </ul>
                    </div>
                </div>
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

                <div class="row ">
                    <div class="col table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kalimat Input</th>
                                    <th>Detail</th>
                                    <th>Parsing</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td>{{$d->users->akun->nama}}</td>
                                    <td>{{$d->kalimat}}</td>
                                    <td><a href="superadmin_Prosess_NLP/{{$d->id}}">Tampilkan Detail</a></td>
                                    <td> @if($d->parsing == null)
                                        Null
                                        @else
                                        {{$d->parsing}}
                                        @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">{{$data->links()}}
                    </div>

                </div>

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
