@extends('website.master')

@section('title')
    Youth | Order Confirmation
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card py-5 my-5 shadow-lg border-0 text-center">
                        <div class="py-3">
                            <i class="fa-solid fa-circle-check text-dark" style="transform: scale(4);"></i>
                        </div>
                        <div class="py-3">
                            <h1>Your Order Place Successfully.</h1>
                        </div>
                        <div class="py-3">
                            <a class="btn btn-dark" href="{{ route('home') }}">Return Back Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection



