@extends('website.master')

@section('title')
    Contact Us
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section>
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Contact</h1>
                    <div class="mx-auto" style="border: 1px solid black; width: 10%;"></div>
                </div>
            </div>
            <div class="row py-5">
                @foreach($logo_addresses->take(1) as $address)
                    <div class="col-md-6 px-5">
                        <h3>Location:</h3>
                        <p>{!! $address->address !!}</p>
                        <h3>Contact Number:</h3>
                        <p>{{ $address->number }}</p>
                        <h3>Email:</h3>
                        <p>{{ $address->gmail }}</p>
                    </div>
                @endforeach
                <div class="col-md-6">
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.4426310928714!2d90.50914679864047!3d23.637230751678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b1d674ddedbf%3A0x457c0070b44eaac4!2sYOUTH!5e0!3m2!1sen!2sbd!4v1717356742176!5m2!1sen!2sbd" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

@endsection
