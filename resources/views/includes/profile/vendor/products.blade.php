<h3 class="mt-3">My Products</h3>
<hr>

@if(auth() -> user() -> products -> isNotEmpty())
   <div class="col text-center">
            <div class="btn-group vacation_group" role="group" aria-label="Basic example">
            <p class="vacation_mode" style="">Vacation Mode</p>
                <a href="{{ route('profile.disableproduct', true) }}" class="btn @if(auth() -> user() -> vacation == true) btn-success @else btn-outline-success @endif">On</a>
                <a href="{{ route('profile.disableproduct', 0) }}" class="btn @if(auth() -> user() -> vacation == false) btn-danger @else btn-outline-danger @endif">Off</a>

            </div>
        </div>
        @if($myProducts->isNotEmpty())
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price from</th>
                <th>Category</th>
                <th>Type</th>
                <th></th>

            </tr>
        </thead>
 
        <tbody>
            @foreach($myProducts as $product)
           
                <tr>
                    <td><a href="{{ route('product.show', $product) }}">{{ $product -> name }}</a></td>
                    <td class="text-right">{{ $product -> quantity }}</td>
                    <td class="text-right">@include('includes.currency', ['usdValue' => $product -> price_from ])</td>
                    <td><a href="{{ route('category.show', $product -> category) }}">{{ $product -> category -> name }}</a></td>
                    <td><span class="badge badge-primary">{{ $product -> isDigital() ? 'Digital' : 'Physical' }}</span></td>
                    <td class="text-right">
                        <a href="{{ route('profile.vendor.product.clone.show', $product ) }}" class="btn btn-sm btn-info">
                            Clone
                        </a>
                        <a href="{{ route('profile.vendor.product.edit', $product -> id) }}" class="btn btn-sm btn-primary">
                            <img src="/img/ed.ico">
                        </a>
                        <a href="{{ route('profile.vendor.product.remove.confirm', $product -> id) }}" class="btn btn-sm btn-danger">
                            <img src="/img/trash.ico">
                        </a>
   

                    </td>
                </tr>
            @endforeach

        </tbody>
            
    </table>
@else
    <div class="alert alert-warning text-center">
        You are in Vacation Mode!
    </div>
@endif
    {{{ $myProducts -> links('includes.paginate') }}}

@else
    <div class="alert alert-warning text-center">
        You don't have any products!
    </div>
@endif

<style>
p.vacation_mode {
    width: 80%;
    font-weight: 700;
    text-align: left !important;
}
.vacation_group{
    width:100%;
}
.vacation_group a{
    
    width: 10%;
    margin-bottom: 6px;
}
.btn-group > .btn:hover,
.btn-group-vertical > .btn:hover {
  z-index: 1;
}

.btn-group > .btn:focus,
.btn-group > .btn:active,
.btn-group > .btn.active,
.btn-group-vertical > .btn:focus,
.btn-group-vertical > .btn:active,
.btn-group-vertical > .btn.active {
  z-index: 1;
}
</style>