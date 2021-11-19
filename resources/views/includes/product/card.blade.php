<div class="card-group h-100 justify-content-center align-items-center">
    <p class="text-center">
                    @foreach($product -> getCoins() as $coin)
                        <span class="badge badge-info mx-auto">{{ strtoupper(\App\Purchase::coinDisplayName($coin)) }}</span>
                    @endforeach
                </p>
@if($product->user->vendor->canUseFe() || $product->user->vendor->isTrusted())
                                    <p class="corner"><span class="align-middle">Trusted</span></p>
                @endif
    <img class="card-img-top" src="{{ asset('storage/'  . $product -> frontImage() -> image) }}" alt="{{ $product -> name }}">
    </p>
    <div class="card-body">
        <a href="{{ route('product.show', $product) }}"><h4 class="card-title-custom">{{str_limit($product -> name, $limit = 50)}}</h4></a>
        @if($product -> isPhysical())
                                <p>Ships {{ $product -> specificProduct() -> shipsTo() }}: <em>{{ $product -> specificProduct() -> countriesLong() }}</em></p>
                            @endif
        <p class="card-subtitle">From: <strong>{{ $product->getLocalPriceFrom() }} {{ \App\Marketplace\Utility\CurrencyConverter::getLocalSymbol() }}</strong></p>
@foreach($product -> getTypes() as $type)
                                            <span class="badge badge-mblue">{{ \App\Purchase::$types[$type] }}</span>
                                        @endforeach
        <p class="card-subtitle"> {{ $product -> category -> name }} - <span class="badge badge-info">{{ $product -> type }}</span></p>
        <p class="card-subtitle"> By <a href="{{ route('vendor.show', $product -> user) }}" class="badge badge-info">{{ $product -> user -> username }}</a>, <strong>{{ $product -> quantity }}</strong> left</p>
        <a href="{{ route('product.show', $product) }}" class="btn btn-primary d-block">Buy now</a>
    </div>
</div>