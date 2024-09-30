<section class="border-bottom" style="background-color: #212529; height: 40px; padding-top: 5px;">
    <div class="container-fluid">
        <div class="row p-0">
            <div class="col-12 d-md-flex d-lg-flex justify-content-md-between justify-content-lg-between">
                <div class="p-0 m-0 top-social-half-one">
                    <div class="d-md-flex d-lg-flex d-flex email-number">
                        @foreach($logo_addresses->take(1) as $address)
                            <p class="mx-md-1 mx-lg-1 float-sm-start">
                                <a class="text-decoration-none text-white px-1" style="font-size: 12px;" href="tel:{{$address->number}}">
                                    <i class="fa-solid fa-phone"></i>
                                    {{ $address->number }}
                                </a>
                            </p>
                            <p class="mx-md-1 mx-lg-1 float-sm-end">
                                <a class="text-decoration-none text-white px-1" style="font-size: 12px;" href="mailto:{{$address->gmail}}">
                                    <i class="fa-regular fa-envelope"></i>
                                    {{ $address->gmail }}
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>
                <div class="p-0 m-0 top-social-half-two">
                    <ul class="nav d-flex justify-content-md-end justify-content-sm-center justify-content-center">

                        @if(Auth::check())
                            <li class="px-1 nav-item" style="margin-top: -3px;">
                                <a href="{{ route('dashboard') }}" class="nav-link text-decoration-none" style="color: white !important; font-size: 12px;">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="text-decoration-none" style="color: white !important; font-size: 12px;" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit(); ">Logout</a>
                                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="px-1 nav-item" style="margin-top: -5px;">
                                <a href="{{ route('login') }}" class="nav-link text-decoration-none" style="color: white !important; font-size: 12px;">
                                    Login
                                </a>
                            </li>
                            <li class="px-1 nav-item" style="margin-top: -5px;">
                                <a href="{{ route('register') }}" class="nav-link text-decoration-none" style="color: white !important; font-size: 12px;">
                                    Singup
                                </a>
                            </li>
                        @endif
                        <li class="px-1 nav-item">
                            <a href="{{ route('home.product.cart') }}" target="_blank" class="nav-link text-decoration-none" style="margin-top: -5px; color: white !important; font-size: 14px;">
                                <i class="fa-solid fa-cart-shopping"></i>({{$productCount}})
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @media screen and (max-width: 992px){
        .top-social-half-one .email-number{
            justify-content: space-between;
        }
        .top-social-half-two{
        display: none;
        }
    }
</style>

<section class="pt-0 px-3 sticky-top bg-white">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-white">

                <button class="navbar-toggler nav-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="col-md-3 justify-content-start">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        @foreach($logo_addresses->take(1) as $logo)
                            <img class="img-fluid my-2 main-logo" name="logo" srcset="{{ asset($logo->logo) }}" src="{{ asset($logo->logo) }}" alt="{{ $logo->alt }}" />
                        @endforeach
                    </a>
                </div>

                <style>
                    .navbar-toggler {
                        border: none !important;
                        background: none !important;
                        outline: none !important;
                        box-shadow: none !important;
                    }

                    .main-logo{
                        height: 50px;
                    }
                    @media screen and (max-width: 992px){
                        .main-logo{
                            height: 30px;
                        }
                        .nav-btn{
                            border: white !important;
                        }
                        .nav-btn span{
                            font-size: 16px;
                        }
                    }
                </style>

                <button class="search-icon" id="search-icon">
                    <i class="fa-solid fa-magnifying-glass text-black" style="font-size: 16px;"></i>
                </button>
                <button class="search-close-icon border-0" id="search-close-icon" style="display: none;">
                    <i class="fa-solid fa-xmark text-black" style="font-size: 16px;"></i>
                </button>

                <div class="col-md-6 collapse tabs navbar-collapse justify-content-center">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item active">
                            <a href="{{ route('home') }}" class="text-decoration-none text-black fs-500 px-3">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home.all.product') }}" class="text-decoration-none text-black fs-500 px-3">Shop</a>
                        </li>
                        @foreach($menus->take(3) as $menu)
                            @if($menu->status == 'active')
                                <li class="nav-item">
                                    <a href="{{ route('home.menu', $menu->menu_slug) }}" class="text-decoration-none text-black fs-500 px-3">{{ $menu->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li class="nav-item">
                            <a href="{{ route('home.blog') }}" class="text-decoration-none text-black fs-500 px-3">Blogs</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav d-flex flex-row justify-content-center mt-3">
                        <li>
                            <form action="{{ route('search.result') }}" method="get">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control rounded-0 input-focus input-search p-1" name="search" placeholder="Search... " aria-label="search" value="{{ Request::get('search') }}" aria-describedby="search" style="font-size: 14px;">
                                    <button class="input-group-text back-color rounded-0 border p-2" type="submit" id="search" style="border: 2px solid #212529 !important;">
                                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('search')" class="my-2 text-black" />
                            </form>
                        </li>
                    </ul>
                </div>

{{--                Mobile--}}
                <div class="search-container" id="search-container">
                    <form action="{{ route('search.result') }}" method="get">
                        @csrf
                        <div class="input-group mt-2">
                            <input type="text" class="form-control search-input input-focus input-search rounded-0 p-1" name="search" placeholder="Search... " aria-label="search" value="{{ Request::get('search') }}" aria-describedby="search" style="font-size: 14px;">
                            <button class="input-group-text back-color border-0 p-2 rounded-0" type="submit" id="search" style="margin-right: 5px; margin-top: 8px; height: 31px;">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('search')" class="my-2 text-black" />
                    </form>
                </div>

            </nav>
        </div>
    </div>
</section>

<style>

    .back-color{
        background-color: #212529 !important;
    }

    .search-icon {
        background: none;
        border: none;
        color: white;
        font-size: 1.3rem;
        cursor: pointer;
    }

    .search-close-icon {
        background: none;
        border: none;
        color: white;
        font-size: 1.3rem;
        cursor: pointer;
    }

    .search-container {
        width: 100%;
        display: none;
        justify-content: center;
        transition: all 0.5s ease-in-out;
    }

    .search-input {
        width: 80%;
        padding: 0.5rem;
        border-radius: 4px;
        margin: 0.5rem 0;
    }

    @media screen and (min-width: 992px) {
        #search-icon {
            display: none !important;
        }
    }

</style>

<script>

    document.getElementById('search-icon').addEventListener('click', function() {
        var searchContainer = document.getElementById('search-container');
        var searchIcon = document.getElementById('search-icon');
        var searchCloseIcon = document.getElementById('search-close-icon');

        searchContainer.style.display = 'flex';
        searchIcon.style.display = 'none';
        searchCloseIcon.style.display = 'block';
    });

    document.getElementById('search-close-icon').addEventListener('click', function() {
        var searchContainer = document.getElementById('search-container');
        var searchIcon = document.getElementById('search-icon');
        var searchCloseIcon = document.getElementById('search-close-icon');

        searchContainer.style.display = 'none';
        searchIcon.style.display = 'block';
        searchCloseIcon.style.display = 'none';
    });

</script>



<!-- Modal -->
<div class="modal left fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center pb-3">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        @foreach($logo_addresses->take(1) as $logo)
                            <img class="img-fluid my-2" name="logo" srcset="{{ asset($logo->logo) }}" src="{{ asset($logo->logo) }}" alt="{{ $logo->alt }}" style="height: 50px;" />
                        @endforeach
                    </a>
                </div>
                <ul class="navbar-nav text-start w-100">
                    <li class="nav-item mb-2 active">
                        <a href="{{ route('home') }}" class="text-decoration-none text-black fs-500 px-3">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('home.all.product') }}" class="text-decoration-none text-black fs-500 px-3">Shop</a>
                    </li>
                    @foreach($menus->take(3) as $menu)
                        @if($menu->status == 'active')
                            <li class="nav-item mb-2">
                                <a href="{{ route('home.menu', $menu->menu_slug) }}" class="text-decoration-none text-black fs-500 px-3">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @endforeach
                    <li class="nav-item mb-2">
                        <a href="{{ route('home.blog') }}" class="text-decoration-none text-black fs-500 px-3">Blogs</a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item mb-2">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-black fs-500 px-3">Dashboard</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="text-decoration-none text-black fs-500 px-3" onclick="event.preventDefault(); document.getElementById('logoutForm').submit(); ">Logout</a>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item mb-2">
                            <a href="{{ route('login') }}" class="text-decoration-none text-black fs-500 px-3">Login/Signup</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .modal.left .modal-dialog {
        position: fixed;
        margin: auto;
        width: 270px;
        height: 100%;
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content {
        height: 100%;
        overflow-y: auto;
        border-radius: 0;
    }

    .modal.left .modal-body {
        padding: 15px 15px 80px;
    }

    .modal.left.fade .modal-dialog {
        left: -320px;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.show .modal-dialog {
        left: 0;
    }
</style>
