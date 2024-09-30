@extends('website.master')

@section('title')
    Shopping Cart
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="">
        <div class="container">
            @if(session('message'))
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center text-black py-2">{{ session('message') }}</p>
                        <p class="text-center text-black py-2">{{ session('search_message') }}</p>
                    </div>
                </div>
            @endif
            @if(session('search_message'))
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center text-black py-2">{{ session('search_message') }}</p>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <form action="{{ route('order.new') }}" class="" method="POST">
                        @csrf
                        <div class="row py-5 d-flex">
                            <div class="col-md-7">
                                <div class="card card-body border-0 mb-3" style="background-color: #212529;">
                                    <h1 class="fw-bolder text-white">Youth</h1>
                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-decoration-none text-white" href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a class="text-decoration-none text-white" href="{{ route('home.product.cart') }}">Cart</a>
                                            </li>
                                            <li class="breadcrumb-item text-white active" aria-current="page">Information</li>
                                        </ol>
                                    </nav>

                                    <style>
                                        .breadcrumb {
                                            --bs-breadcrumb-divider: '>';
                                        }

                                        .breadcrumb-item+.breadcrumb-item::before {
                                            color: white;
                                        }
                                    </style>

                                    @if (isset(Auth::user()->id))
                                        <h6 class="fw-bold py-3 mb-0 text-white">Contact</h6>
                                        <p class="mb-1 text-white">{{ Auth::user()->name }}</p>
                                    @else
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold py-3 mb-0 text-white">Contact</h6>
                                            <div class="d-flex pt-3">
                                                <p class="mb-1 text-white">Already have an account?</p>
                                                <a href="{{ route('login') }}" class="nav-link text-white"> Log in</a>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="text-white" />
                                    <h5 class="fw-bolder m-0 text-white">Shipping address</h5>
                                    <hr class="text-white" />

                                        <div class="row ">
                                            <div class="mb-3">
                                                <label for="name" class="fs-6 text-white ms-2"> Name</label>
                                                <input type="text" class="form-control input-focus" name="name" id="name" placeholder="Enter name" required />
                                                <x-input-error :messages="$errors->get('name')" class="my-2 text-white" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="address" class="fs-6 text-white ms-2">Delivery Address</label>
                                                <input type="text" class="form-control input-focus" name="address" id="address" placeholder="Enter delivery address" required />
                                                <x-input-error :messages="$errors->get('address')" class="my-2 text-white" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="city" class="fs-6 text-white ms-2">City</label>
                                                <input type="text" class="form-control input-focus" name="city" id="city" placeholder="City" required />
                                                <x-input-error :messages="$errors->get('city')" class="my-2 text-white" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="postal_code" class="fs-6 text-white ms-2">Postal code</label>
                                                <input type="number" class="form-control input-focus" name="postal_code" id="postal_code" placeholder="Postal code" />
                                                <x-input-error :messages="$errors->get('postal_code')" class="my-2 text-white" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="number" class="fs-6 text-white ms-2">Phone Number</label>
                                                <input type="number" class="form-control input-focus" name="number" id="number" placeholder="Enter phone number" required />
                                                <x-input-error :messages="$errors->get('number')" class="my-2 text-white" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="note" class="fs-6 text-white ms-2">Note</label>
                                                <textarea type="text" class="form-control input-focus" rows="5" name="note" id="note"></textarea>
                                                <x-input-error :messages="$errors->get('note')" class="my-2 text-white" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 py-3 mb-3">
                                                <p class="text-white" style="font-size: 14px;"> <input type="checkbox"
                                                                                                       name="all_terms" value="agree" required /> I AGREE WITH THE <a
                                                        href="{{ route('policy.terms') }}" class="text-decoration-none">TERMS AND CONDITIONS</a>, <a
                                                        href="{{ route('policy.privacy') }}" class="text-decoration-none">PRIVACY POLICY</a> AND <a
                                                        href="{{ route('policy.return') }}" class="text-decoration-none">RETURN REFUND POLICY</a> </p>
                                            </div>
                                            <x-input-error :messages="$errors->get('all_terms')" class="my-2 text-white text-decoration-none" />
                                        </div>

                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <a href="{{ route('home.product.cart') }}" class="text-decoration-none text-white pt-3">
                                                <span style="font-size: 14px;"><i
                                                        class="fa fa-chevron-up fa-rotate-270"></i> Return to cart</span>
                                            </a>

                                        </div>
                                    </div>

                                    <hr class="text-white" />
                                    <p class="text-white">All rights reserved by Youth.</p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-body border-0" style="background-color: #212529;">
                                    <div class="row pt-5 pb-3 px-2">
                                        @php($sum = 0)
                                        @foreach ($carts as $product)
                                            <div class="col-md-3 col-sm-3 col-3 mt-1">
                                                <p>
                                                    <a href="{{ route('home.product.detail', $product->product->product_slug) }}">
                                                        <img class="img-fluid checkout-img" src="{{ asset($product->product->image) }}" alt="{{ $product->product->alt }}" />
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-9 d-flex justify-content-between"
                                                 style="font-size: 14px;">
                                                <p class="text-white">
                                                    <a class="text-decoration-none text-white" href="{{ route('home.product.detail', $product->product->product_slug) }}">
                                                        {{ $product->product->name }}({{ $product->quantity }})
                                                    </a>
                                                    @if($product->product->offer_id)
                                                        <br>
                                                        Offer: {{ $product->product->offer->name }}
                                                    @endif
                                                    @if($product->product_size_id)
                                                        <br>
                                                        Size: {{ $product->productSize->name }}
                                                    @endif
                                                </p>
                                                <p class="text-white">৳{{ $product->product->selling_price * $product->quantity }}.00</p>
                                            </div>
                                            @php($sum = $sum + ($product->product->selling_price * $product->quantity))
                                        @endforeach
                                        <div class="col-md-12 py-3 pb-0 d-flex justify-content-between"
                                             style="font-size: 14px;">
                                            <p class="text-white">Subtotal</p>
                                            <p class="text-white">৳{{ $sum }}.00</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between" style="font-size: 14px;">
                                            <p class="text-white">-</p>
                                            <p class="text-white">-</p>
                                        </div>
                                        @foreach($delivery_taxes->take(1) as $vats)
                                            <div class="col-md-12 d-flex justify-content-between" style="font-size: 14px;">
                                                <p class="text-white">Estimated vat</p>
                                                <p class="text-white">৳{{ $tax = ($sum * $vats->vat) / 100 }}</p>
                                            </div>
                                        @endforeach

                                        <div class="col-md-12 d-flex justify-content-between" style="font-size: 14px;">
                                            <p class="text-white">Delivery Charge</p>
                                            <p class="text-white" id="delivery-charge">
                                                <select class="form-control input-focus" name="delivery_tax_id" id="location" required >
{{--                                                    <option value="" selected>Choose Location</option>--}}
                                                    @foreach($delivery_taxes as $delivery_tax)
                                                        <option value="{{ $delivery_tax->id }}" data-charge="{{ $delivery_tax->delivery_charge }}">
                                                            {{ $delivery_tax->location }} ৳ {{ $delivery_tax->delivery_charge }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </div>
                                        <x-input-error :messages="$errors->get('delivery_tax_id')" class="my-2 text-white" />
                                        <div class="col-md-12 d-flex justify-content-between">
                                            @php( $orderTotal = $sum + $tax )
                                            <p class="fw-bolder text-white">Total</p>
                                            <p class="fw-bolder text-white">
                                                <span class="text-white" style="font-size: 12px;" id="total">BDT</span>
                                                ৳<span class="text-white" type="text" id="orderTotal" readonly >
                                                {{ $orderTotal }}
                                            </span>
                                                <input type="hidden" name="order_total" value="{{ $orderTotal }}" />
                                            </p>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var locationSelect = document.getElementById('location');
                                                var orderTotalElement = document.getElementById('orderTotal');
                                                var total = {{ $orderTotal }};// Define and assign orderTotal here

                                                locationSelect.addEventListener('change', function () {
                                                    var selectedOption = locationSelect.options[locationSelect.selectedIndex];
                                                    var deliveryCharge = parseFloat(selectedOption.getAttribute('data-charge')) || 0;
                                                    var orderTotal = total + deliveryCharge;
                                                    orderTotalElement.textContent = orderTotal.toFixed(2);
                                                });
                                            });
                                        </script>

                                        <div class="row pb-2 my-0">
                                            <label for="" class="text-white" style="font-size: 14px;">Coupon :</label>
                                            <span id="couponCheck-error" class="py-2" style="display:none; color: white;"></span>
                                            <input type="text" class="form-control input-focus ms-2" name="coupon_id" id="coupon" />
                                        </div>
                                        <div class="row pb-2 my-0">
                                            <label for="" class="text-white" style="font-size: 14px;">Discount Amount :</label>
                                            <input type="text" class="form-control input-focus ms-2" name="discount_amount" id="discount_amount" readonly />
                                        </div>

                                        <div class="row pb-2 my-0">
                                            <label for="" class="text-white" style="font-size: 14px;">Estimate Total :</label>
                                            <input type="text" class="form-control input-focus ms-2" name="istimate_total" id="istimate_total" readonly />
                                        </div>

                                        <div class="row pt-2 my-0">
                                            <button type="submit" class="btn text-white ms-2 bg-primary rounded-1">
                                                Confirm Order
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        .checkout-img{
            height: 100px;
            width: 60px !important;
        }
        @media screen {
            .checkout-img{
                height: 60px;
                width: 80px;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Define a function to check if the coupon code already exists
            function couponCheck(coupon, callback) {
                $.ajax({
                    url: '/couponCheck',
                    type: 'GET',
                    data: {
                        coupon: coupon
                    },
                    success: function(data) {
                        if (data && data.code) {
                            // Log the data received from the server in the console
                            console.log(data);

                            // Clear the previous error message
                            $('#couponCheck-error').hide().text('');

                            if (new Date(data.expires_at) <= new Date()) {
                                $('#couponCheck-error').text('Coupon has expired').show();
                                clearDiscountAndTotal();
                            } else if (new Date(data.starts_at) >= new Date()) {
                                $('#couponCheck-error').text('Coupon does not start yet.').show();
                                clearDiscountAndTotal();
                            } else if (data.usage_count >= data.max_uses) {
                                $('#couponCheck-error').text('This coupon has reached its usage limit.').show();
                                clearDiscountAndTotal();
                            } else if (data.user_usage_count >= data.max_uses_user) {
                                $('#couponCheck-error').text('You have already used this coupon').show();
                                clearDiscountAndTotal();
                            } else if (parseFloat(data.min_amount) > parseFloat('{{ $orderTotal }}')) {
                                $('#couponCheck-error').text('Your order amount is below ' + data.min_amount + ' tk.').show();
                                clearDiscountAndTotal();
                            } else {
                                if (data.type === 'fixed') {
                                    // Calculate the fixed discount
                                    var discountAmount = parseFloat(data.discount_amount);
                                    $('#discount_amount').val(discountAmount);

                                    // Calculate the updated total estimate
                                    var orderTotal = parseFloat('{{ $orderTotal }}');
                                    var updatedTotal = orderTotal - discountAmount;
                                    $('#istimate_total').val(updatedTotal);
                                } else if (data.type === 'percent') {
                                    // Calculate the percent discount
                                    var percentDiscount = parseFloat(data.discount_amount);
                                    var orderTotal = parseFloat('{{ $orderTotal }}');
                                    var discountAmount = (orderTotal * percentDiscount) / 100;
                                    $('#discount_amount').val(discountAmount);

                                    // Calculate the updated total estimate
                                    var updatedTotal = orderTotal - discountAmount;
                                    $('#istimate_total').val(updatedTotal);
                                }
                                $('#couponCheck-error').text('Coupon is valid').show();
                            }
                        } else {
                            $('#couponCheck-error').text('Coupon is Invalid').show();
                            clearDiscountAndTotal();
                        }
                    },
                    error: function() {
                        callback(false);
                    }
                });
            }

            // Function to clear discount and total fields
            function clearDiscountAndTotal() {
                $('#discount_amount').val('');
                $('#istimate_total').val('');
            }

            // Attach a change event listener to the input field
            $('#coupon').on('input', function() {
                var value = $(this).val();

                if (value.length >= 2) {
                    couponCheck(value, function(exists) {});
                } else {
                    $('#couponCheck-error').text('Coupon is Invalid').show();
                    clearDiscountAndTotal();
                }
            });
        });
    </script>

@endsection
