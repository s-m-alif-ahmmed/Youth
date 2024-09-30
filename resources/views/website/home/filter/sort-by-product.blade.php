<div class="row" id="product-list">
    @foreach($products as $product)
        <div class="col-md-3 py-3">
            <div class="card border-0">
                <div class="card-header p-0 position-relative">
                    <a href="{{ route('home.product.detail', $product->product_slug) }}">
                        <img class="img-fluid object-fit-cover w-100" src="{{ asset($product->image) }}" alt="{{ $product->alt }}" style="height: 400px;">
                        @if($product->stock == 0)
                            <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                <span class="fs-1">Stock Out</span>
                            </div>
                        @endif
                    </a>
                </div>
                <div class="card-body px-1 pb-0 my-0">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a class="text-decoration-none text-black pb-2" href="{{ route('home.product.detail', $product->product_slug) }}">
                                {{ $product->name }}
                            </a>
                            <p>৳ {{ $product->selling_price }} tk
                                @if($product->regular_price)
                                (
                                <span class="text-decoration-line-through" style="font-size: 12px;">৳ {{ $product->regular_price }} tk</span>
                                )
                                @endif
                            </p>
                        </div>
                        <div class="">
                            <form action="">
                                <a href="" class="pe-1"><i class="fa-regular fa-heart text-black"></i></a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="justify-content-between">
                    @if($product->offer_id)
                        <p class="float-start offer-ribbon">
                            {{$product->offer->name}}
                        </p>
                    @endif
                    <a class="btn btn-sm btn-dark text-white float-end" href="{{ route('home.product.detail', $product->product_slug) }}">Read More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

