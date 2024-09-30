<div class="row row-xs mb-3 form-group-wrapper">
    <h3 class="card-title col-12">Review here:</h3>

    <form action="{{ route('product-review.store') }}" method="post" class="col-12" >
        @csrf
        @method('POST')

        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="col-md-12 my-3 d-flex">
            <label for="product_review" class="form-label me-2">Star: </label>
            <div id="full-stars-example-two" class="d-flex justify-content-between">
                <div class="d-flex">
                    <div class="rating-group">
                        <input checked class="rating__input rating__input--none" name="star" id="rating3-none" value="0" type="radio">
                        <label aria-label="1 star" class="rating__label" for="rating3-1" style="font-size: 18px;">
                            <i class="rating__icon rating__icon--star fa fa-star "></i>
                        </label>
                        <input class="rating__input" name="star" id="rating3-1" value="1" type="radio">
                        <label aria-label="2 stars" class="rating__label" for="rating3-2" style="font-size: 18px;">
                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                        </label>
                        <input class="rating__input" name="star" id="rating3-2" value="2" type="radio">
                        <label aria-label="3 stars" class="rating__label" for="rating3-3" style="font-size: 18px;">
                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                        </label>
                        <input class="rating__input" name="star" id="rating3-3" value="3" type="radio">
                        <label aria-label="4 stars" class="rating__label" for="rating3-4" style="font-size: 18px;">
                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                        </label>
                        <input class="rating__input" name="star" id="rating3-4" value="4" type="radio">
                        <label aria-label="5 stars" class="rating__label" for="rating3-5" style="font-size: 18px;">
                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                        </label>
                        <input class="rating__input" name="star" id="rating3-5" value="5" type="radio">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <label for="product_review" class="form-label">Review</label>
            <textarea class="form-control" name="product_review" id="product_review" rows="3" required></textarea>
        </div>

        <div class="col-md-12 my-2">
            <button class="btn btn-sm text-white float-end" type="submit" style="background-color: #212529;">Submit</button>
        </div>

    </form>
</div>
@foreach($product_reviews as $review)
    @if($review->status == 'active')
        <div class="row my-2">
            <div class="col-12 d-flex">
                <div class="">
                    @if($review->user->photo)
                        <img class="rounded-5 img-fluid" src="{{ asset($review->user->photo) }}" alt="User" style="height: 40px; width: 40px;" />
                    @else
                        <img class="rounded-5 img-fluid" src="{{asset('/')}}website/img/blank-profile.jpg" alt="User" style="height: 40px; width: 40px;"/>
                    @endif
                </div>
                <div class="ms-2" style="line-height: 5px !important;">
                    <p>{{ $review->user->name }}
                        (
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $review->star)
                                <i class="fa fa-star text-warning"></i>
                            @else
                                <i class="fa fa-star text-gray"></i>
                            @endif
                        @endfor
                    )</p>
                    <p>
                        <small class="text-muted">{{ $review->created_at->setTimezone('Asia/Dhaka')->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
            <div class="col-12">
                <p>
                    {{ $review->product_review }}
                </p>
            </div>
        </div>
    @endif
@endforeach
