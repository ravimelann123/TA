<div class="row">
    @foreach ( $photo as $p)
    <div class="col-md-3 mb-3 kartubox">
        <div class="row">
            <img src="images/produk/{{$p->namafoto}}" class="card-img-top sizegrid " alt="Card image cap">
        </div>
        <div class="row">
            <div class="col mt-2 text-left">
                <h5>{{$p->produk->nama}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>
                    {{$p->produk->deskripsi}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-5 mt-2"> Rp.{{$p->produk->harga}}</div>
            <div class="col-7 text-right mb-1 mt-1"> <button class="btn btn-warning">+</button></div>
        </div>
    </div>
    @endforeach


</div>
