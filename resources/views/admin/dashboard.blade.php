@extends('master.masterlayout')
@section('content')

<div class="col">
    <div class="card" style="min-height:85vh">
        {{-- <div class="card-header bg-white">
                </div> --}}
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Halaman Utama
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
                <div class="col-md mb-3">
                    <div class="card " style="border-left: 5px solid #075e54; box-shadow: 3px 4px 5px #b6b6b6;">
                        <div class="card-body">
                            <div class="row  align-items-center">
                                <div class="col mr-2">
                                    <div class="  text-uppercase mb-1">
                                        Account
                                    </div>
                                    {{$akun}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md mb-3">
                    <div class="card " style="border-left: 5px solid #075e54; box-shadow: 3px 4px 5px #b6b6b6;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-uppercase mb-1">
                                        Order
                                    </div>
                                    {{$order}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md mb-3">
                    <div class="card " style="border-left: 5px solid #075e54; box-shadow: 3px 4px 5px #b6b6b6;">
                        <div class="card-body">
                            <div class="row  align-items-center">
                                <div class="col mr-2">
                                    <div class=" text-uppercase mb-1">
                                        Product
                                    </div>
                                    {{$produk}}
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

@endsection
