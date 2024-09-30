{{--Favicon--}}
@foreach($logo_addresses->take(1) as $logo)
<link rel="icon" type="image/x-icon" href="{{asset($logo->favicon)}}">
@endforeach

<link rel="stylesheet" href="{{asset('/')}}website/css/all.css">
<link rel="stylesheet" href="{{asset('/')}}website/css/style.css">
<link rel="stylesheet" href="{{asset('/')}}website/css/my_style.css">

{{--Bootstrap--}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

{{--Poppins google Font--}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!--- Slider Jquery -->
<link href="{{asset('/')}}website/assets/product-carousel/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

<!--- Slick Carousel -->
<link href="{{asset('/')}}website/jquery/carousel_slick/slick/slick.css" rel="stylesheet" />
<link href="{{asset('/')}}website/jquery/carousel_slick/slick/slick-theme.css" rel="stylesheet" />

{{--product image slider--}}
<link href="{{asset('/')}}website/jquery/product-img-slider/jquery.gScrollingCarousel.css" rel="stylesheet" />
