@extends('master.masterlayout')
@section('content')
<div class="row">
    <div class="col-9">
        <h3 class="panel-title">Produk</h3>
    </div>
    <div class="col-3 text-right">
        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                class="lnr lnr-plus-circle"></i>
        </button>
    </div>
</div>
{{-- MODAL --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahstok/create" method="POST">

                    {{ csrf_field() }}
                    <div class="form-group {{$errors->has('produk_id') ? 'has-error' : ''}}">
                        <label>Nama Produk</label>
                        <select class="form-control" name="produk_id">
                            @foreach($produk as $p)
                            <option value="{{$p->id}}">{{$p->nama}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('produk_id'))
                        <span class="help-block">{{$errors->first('produk_id')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('stok') ? 'has-error' : ''}}">
                        <label>Nama Produk</label>
                        <input type="text" name="stok" class="form-control" placeholder="Tambah Stok"
                            value="{{old('stok')}}">


                        @if($errors->has('stok'))
                        <span class="help-block">{{$errors->first('stok')}}</span>
                        @endif
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>
{{-- END MODAL --}}

<div class="row">
    <div class="col-12">
        <table class="table table-hover text-left">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Stock Add</th>
                    <th>Users Admin</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $tambahstok as $p)
                <tr>
                    <td>{{$p->produk->nama}}</td>
                    <td>{{$p->stok}}</td>
                    <td>{{$p->users->akun->nama}}</td>
                    <td>
                        <a href="/tambahstok/hapus/{{$p->id}}" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- END MODAL --}}
    </div>
</div>



</div>
</div>

@endsection
