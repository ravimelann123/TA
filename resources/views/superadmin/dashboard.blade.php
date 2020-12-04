@extends('master.masterlayout')
@section('content')

<div class="row justify-content-center">
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
            </div>
        </div>
    </div>
</div>

@endsection
