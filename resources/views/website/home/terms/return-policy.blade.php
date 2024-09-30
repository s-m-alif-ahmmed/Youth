@extends('website.master')

@section('title')
    Return Policy
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mx-auto">
                    <h1 class="text-center">Return Policy</h1>
                    @foreach($return_policies->take(1) as $return)
                        <p>
                            {!! $return->return_policy !!}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
