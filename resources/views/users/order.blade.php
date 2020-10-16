@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col-12">
        <h3 class="panel-title">Order</h3>
    </div>
</div>
<form action="/order/create" method="POST">
    {{ csrf_field() }}
    <div class="row">
        @foreach($produk as $p)
        <div class="col-md-3 mb-3">
            <div class="row">
                <div class="col-5 bg-primary ">
                    {{$p->nama}}
                </div>
                <div class="col-5 bg-warning">
                    Stok :{{$p->stok}}</div>
            </div>
            <div class="row">
                <label class="col-10">Jumlah</label>
            </div>
            <div class="row">
                <div class="col-10">
                    <input type="hidden" name="produk_id[]" value="{{$p->id}}" class="form-control">
                    <input type="number" name="jumlah[]" class="form-control">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Order</button>
        </div>
    </div>
</form>
@endsection
