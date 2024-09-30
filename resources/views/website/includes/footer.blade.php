<section class="bg-dark p-0 m-0">
    <div class="container-fluid">
        <div class="accordion" id="footerAccordion">
            <div class="row pt-lg-5 pt-md-5 pt-sm-4 pb-3">
                <!-- First Column -->
                <div class="col-md-3 px-5 text-center text-md-start text-lg-start">
                    @foreach($logo_addresses->take(1) as $address)
                        <img class="img-fluid p-0 m-0" src="{{ asset($address->footer_image) }}" alt="{{ $address->footer_alt }}" style="height: 80px; width: auto;">
                        <p class="d-flex text-white" style="color: white !important;">
                            {!! $address->slogan !!}
                        </p>
                    @endforeach
                </div>
                <!-- Second Column -->
                <div class="col-md-3 px-5">
                    <!-- Accordion for Mobile -->
                    <div class="accordion d-md-none border-0 bg-transparent" id="accordionExample1">
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header border-0 bg-transparent" id="headingOne1">
                                <button class="accordion-button collapsed text-white border-0 bg-transparent justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                    INFORMATION <i class="fa-solid fa-plus" id="plus"></i><i class="fa-solid fa-minus" id="minus"></i>
                                </button>
                            </h2>
                            <div id="collapseOne1" class="accordion-collapse collapse" aria-labelledby="headingOne1" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <ul class="navbar-nav">
                                        <li class="mb-1">
                                            <a href="{{ route('home.about') }}" class="text-decoration-none text-white">
                                                About Us
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="{{ route('home.contact') }}" class="text-decoration-none text-white">
                                                Contact Us
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="{{ route('policy.terms') }}" class="text-decoration-none text-white">
                                                Terms & Conditions
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="{{ route('policy.privacy') }}" class="text-decoration-none text-white">
                                                Privacy Policy
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="{{ route('policy.return') }}" class="text-decoration-none text-white">
                                                Return Policy
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Normal View for Desktop -->
                    <div class="d-none d-md-block">
                        <ul class="navbar-nav">
                            <li>
                                <p class="text-white">INFORMATION</p>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('home.about') }}" class="text-decoration-none text-white">
                                    About Us
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('home.contact') }}" class="text-decoration-none text-white">
                                    Contact Us
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('policy.terms') }}" class="text-decoration-none text-white">
                                    Terms & Conditions
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('policy.privacy') }}" class="text-decoration-none text-white">
                                    Privacy Policy
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('policy.return') }}" class="text-decoration-none text-white">
                                    Return Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Third Column -->
                <div class="col-md-3 px-5">

                    <style>
                        .accordion-header .accordion-button:focus {
                            outline: none !important;
                            box-shadow: none !important;
                            border: none !important;
                        }
                        .accordion-button {
                            border: none !important;
                        }

                        .accordion-button:not(.collapsed) {
                            color: #ffffff;
                            background-color: transparent;
                            box-shadow: none;
                            #plus{
                                display: none;
                            }
                            #minus{
                                display: block;
                            }
                        }

                        .accordion-button.collapsed {
                            border: none !important;
                            #plus{
                                display: block;
                            }
                            #minus{
                                display: none;
                            }
                        }

                        .accordion-item {
                            border: none !important;
                        }

                        .accordion-button::after {
                            display: none;
                        }
                    </style>

                    <!-- Accordion for Mobile -->
                    <div class="accordion d-md-none border-0 bg-transparent" id="accordionExample2">
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header border-0 bg-transparent" id="headingOne2">
                                <button class="accordion-button collapsed text-white border-0 bg-transparent justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2">
                                    MY ACCOUNT <i class="fa-solid fa-plus" id="plus"></i><i class="fa-solid fa-minus" id="minus"></i>
                                </button>
                            </h2>
                            <div id="collapseOne2" class="accordion-collapse collapse" aria-labelledby="headingOne2" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <ul class="navbar-nav">
                                        @if(Auth::check())
                                            <li class="mb-1">
                                                <a href="{{ route('dashboard') }}" class="text-decoration-none text-white">
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li class="mb-1">
                                                <a href="" class="text-decoration-none text-white" onclick="event.preventDefault(); document.getElementById('logoutForm').submit(); ">
                                                    Logout
                                                </a>
                                                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                                    @csrf
                                                </form>
                                            </li>
                                        @else
                                            <li class="mb-1">
                                                <a href="{{ route('login') }}" class="text-decoration-none text-white">
                                                    Login
                                                </a>
                                            </li>
                                            <li class="mb-1">
                                                <a href="{{ route('register') }}" class="text-decoration-none text-white">
                                                    Signup
                                                </a>
                                            </li>
                                        @endif
                                        <li class="mb-1">
                                            <a href="{{ route('home.product.cart') }}" target="_blank" class="text-decoration-none text-white">
                                                My Cart
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="{{ route('user.wishlist') }}" class="text-decoration-none text-white">
                                                My Wishlist
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="{{ route('order.detail') }}" class="text-decoration-none text-white">
                                                Tracking Order
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Normal View for Desktop -->
                    <div class="d-none d-md-block">
                        <ul class="navbar-nav">
                            <li>
                                <p class="text-white">MY ACCOUNT</p>
                            </li>
                            @if(Auth::check())
                                <li class="mb-1">
                                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-white">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="" class="text-decoration-none text-white" onclick="event.preventDefault(); document.getElementById('logoutForm').submit(); ">
                                        Logout
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li class="mb-1">
                                    <a href="{{ route('login') }}" class="text-decoration-none text-white">
                                        Login
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="{{ route('register') }}" class="text-decoration-none text-white">
                                        Signup
                                    </a>
                                </li>
                            @endif
                            <li class="mb-1">
                                <a href="{{ route('home.product.cart') }}" target="_blank" class="text-decoration-none text-white">
                                    My Cart
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('user.wishlist') }}" class="text-decoration-none text-white">
                                    My Wishlist
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('order.detail') }}" class="text-decoration-none text-white">
                                    Tracking Order
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Forth Column -->
                <div class="col-md-3 px-5">
                    <!-- Accordion for Mobile -->
                    <div class="accordion d-md-none border-0 bg-transparent" id="accordionExample3">
                        <div class="accordion-item border-0 bg-transparent">
                            <h2 class="accordion-header border-0 bg-transparent" id="headingOne3">
                                <button class="accordion-button collapsed text-white border-0 bg-transparent justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne3" aria-expanded="false" aria-controls="collapseOne3">
                                    NEWSLETTER <i class="fa-solid fa-plus" id="plus"></i><i class="fa-solid fa-minus" id="minus"></i>
                                </button>
                            </h2>

                            <div id="collapseOne3" class="accordion-collapse collapse" aria-labelledby="headingOne3" data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
                                    <p class="text-white">
                                        Subscribe to our mailing list to get the new updates!
                                    </p>

                                    <div class="row py-2">
                                        <div class="col-12">
                                            <form action="{{ route('subscription.email.store') }}" method="POST">
                                                @csrf
                                                @method('post')
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control input-focus" name="subscribe" id="subscribe" placeholder="Enter subscription email" aria-label="Enter subscription email" aria-describedby="button-addon2" required>
                                                    <button class="btn bg-black text-white px-3 py-0" type="submit" id="button-addon2">
                                                        <i class="fa-regular fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                                <x-input-error :messages="$errors->get('subscribe')" class="my-2 text-white" />
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <ul class="nav d-flex justify-content-start">
                                                @php
                                                    $social_media = \App\Models\Admin\SocialMedia::all();
                                                @endphp
                                                @foreach($social_media->take(6) as $social)
                                                    <li class="">
                                                        <a href="{{ $social->link }}" class="mx-1 text-primary" style="font-size: 24px; background-color: {{ $social->back_color }} !important; color: {{ $social->color }} !important; padding: 5px 10px;">
                                                            {!! $social->icon !!}
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Normal View for Desktop -->
                    <div class="d-none d-md-block">
                        <div class="">
                            <p class="text-white">NEWSLETTER</p>
                            <p class="text-white">
                                Subscribe to our mailing list to get the new updates!
                            </p>

                            <div class="row py-2">
                                <div class="col-10">
                                    <form action="{{ route('subscription.email.store') }}" method="POST">
                                        @csrf
                                        @method('post')
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control input-focus" name="subscribe" id="subscribe" placeholder="Enter subscription email" aria-label="Enter subscription email" aria-describedby="button-addon2" required>
                                            <button class="btn bg-black text-white px-3 py-0" type="submit" id="button-addon2">
                                                <i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        </div>
                                        <x-input-error :messages="$errors->get('subscribe')" class="my-2 text-white" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row py-2">
                                <div class="col-md-12">
                                    <ul class="nav d-flex justify-content-start">
                                        @php
                                            $social_media = \App\Models\Admin\SocialMedia::all();
                                        @endphp
                                        @foreach($social_media->take(6) as $social)
                                            <li class="social-foot">
                                                <a href="{{ $social->link }}" class="mx-1" style="font-size: 24px; background-color: {{ $social->back_color }} !important; color: {{ $social->color }} !important; padding: 5px 10px;">
                                                    {!! $social->icon !!}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <p class="my-auto py-2" style="font-size: 14px;">
                    Copyright © <span id="currentYear"></span> <a class="text-decoration-none text-black" href="https://www.youthoutfits.com">Youth</a> All Rights Reserved. Design & Developed By
                    <a class="text-black text-decoration-none" href="https://www.softartech.com" target="_blank">Soft AR Technology</a>
                    <a href="https://www.softartech.com" target="_blank">
                        <img class="img-fluid" src="{{ asset('/website/img/brand/Soft_AR_Technology.png') }}" alt="Soft AR Technology" style="height: 20px; width: auto;" />
                    </a>
                </p>

                <script>
                    document.getElementById('currentYear').textContent = new Date().getFullYear();
                </script>

            </div>
        </div>
    </div>
</section>
