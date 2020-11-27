@extends('master.masterlayout')
@section('content')

<div class="row">
    @include('master.sidebar')
    <div class="col-md-9">
        <div class="card" style="min-height:85vh">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <form method="GET" action="/pesanan">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h3>My Orders</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <select class="custom-select" name="cari">
                                    <option>
                                        Select Order Status</option>

                                    <option value="Menunggu Diproses">
                                        Waiting to be Processed</option>
                                    <option value="Sedang Diproses">Being Processed</option>
                                    <option value="Pesanan Selesai">Order Complete</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type=" button"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mb-3">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col" class="text-center">Order Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $p)
                                    <tr>
                                        <td>{{$p->nomerpesanan}}</td>
                                        <td>{{$p->status}}</td>
                                        <td>Rp. {{$p->total}}</td>
                                        <td class="text-center">
                                            <a href="/Dpesanan/{{$p->id}}" style="color: gray"> <i
                                                    class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">{{$order->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
