@extends('master.masterlayout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center ">
        <div class="col-sm">
            <div class="card">
                {{-- <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">Keranjang</div>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col">

                            @foreach($order as $p)
                            {{$p->id}}
                            @endforeach

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">

                        </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
