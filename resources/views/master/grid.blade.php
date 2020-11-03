<div class="card-deck">
    @foreach ( $photo as $p)
    <div class="col-md-4">

        {{ csrf_field() }}
        {{-- <label class="card-text text-center" style="text-transform: capitalize;"> --}}
        <div class="card mb-3 mt-3 kartubox">
            <img src="images/produk/{{$p->namafoto}}" class="card-img-top" alt="Card image cap" width="200px"
                height="250px">
        </div>

    </div>
    @endforeach

</div>