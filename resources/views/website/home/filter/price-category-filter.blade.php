<div class="row" id="product-list">
    @if($products->isEmpty())
        <div class="col-md-12 py-3">
            <div class="alert alert-warning text-center" role="alert">
                No products found in this price range.
            </div>
        </div>
    @else
        @foreach($products as $product)
            @if($product->status == 'active')
                @if($product->offer_id == NULL)
                    <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                        <div class="card border-0">
                            <div class="card-header p-0 position-relative">
                                <a href="{{ route('home.product.detail', $product->product_slug) }}">
                                    <img class="img-fluid object-fit-cover w-100" src="{{ asset( $product->image ) }}" alt="{{ $product->alt }}" style="height: 400px;">
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
                                        <a class="text-decoration-none text-black pb-2" href="{{ route('home.product.detail', $product->product_slug) }}" style="font-size: 14px;">
                                            {{ $product->name }}
                                        </a>
                                        <p style="font-size: 14px;">
                                            ৳ {{ $product->selling_price }} tk
                                            @if($product->regular_price)
                                                (
                                                <span class="text-decoration-line-through" style="font-size: 12px;">
                                                ৳ {{ $product->regular_price }} tk
                                            </span>
                                                )
                                            @endif
                                        </p>
                                    </div>
                                    <div class="">
                                        @if(Auth::check())
                                            @php
                                                $favourite = Auth::user()->favourites()->where('product_id', $product->id)->first();
                                            @endphp
                                            @if($favourite)
                                                <form action="{{ route('favourite.destroy', $favourite->id )}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger bg-transparent border-0 p-0 m-0" type="submit">
                                                        <i class="fa-solid fa-heart"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('favourite.store') }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                    <button type="submit" class="btn bg-transparent p-0 m-0">
                                                        <i class="fa-regular fa-heart text-black"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <form action="{{ route('favourite.store') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="user_id" />
                                                <input type="hidden" name="product_id" />
                                                <button type="submit" class="btn bg-transparent p-0 m-0">
                                                    <i class="fa-regular fa-heart text-black"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between">
                                <a class="btn btn-sm btn-dark text-white float-end" href="{{ route('home.product.detail', $product->product_slug) }}" >
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endif

    <div class="pagination-simple col-md-12 pt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

