@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Halaman Utama</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Proses NLP</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <a href="/admin/proses_nlp" class="btn btn-info">
                                    Refresh
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">

                                        <form method="GET" action="/admin/proses_nlp">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="cari"
                                                            placeholder="Cari">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info" type=" button"><i
                                                                    class="fas fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        @foreach($data as $d)
                                        <div class="row mb-4">
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
                                                            @php $value= "Bukan Termasuk Aturan Produksi";
                                                            @endphp
                                                            @else
                                                            @php $value = $d->parsing; @endphp
                                                            @endif
                                                            <input type="text" class="form-control" value="{{$value}}"
                                                                disabled>
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
                                                            <input type="text" class="form-control"
                                                                value="{{$d->kalimat}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col table-responsive">
                                                        <div class="scrollable">
                                                            <table class="table table-hover table-bordered">
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
                                        @endforeach

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
