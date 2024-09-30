<!--APP-SIDEBAR-->
<div class="sticky mb-3">
    <div class="app-sidebar card" style="background-color: #212529;">
        <div class="main-sidemenu">
            <ul class="side-menu ps-0">
                <a class="nav-item text-decoration-none text-white" href="{{route('dashboard')}}">
                    <li class="nav-link border rounded-2 m-2 p-2">
                        <span class="side-menu__label text-white">Profile</span>
                    </li>
                </a>
                <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('profile.edit') }}">
                    <li class="nav-link border rounded-2 m-2 p-2">
                        <span class="side-menu__label text-white">Settings</span>
                    </li>
                </a>
                <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('home.product.cart') }}" target="_blank">
                    <li class="nav-link border rounded-2 m-2 p-2">
                        <span class="side-menu__label text-white">My Cart</span>
                    </li>
                </a>
                <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('order.detail') }}">
                    <li class="nav-link border rounded-2 m-2 p-2">
                        <span class="side-menu__label text-white">My Orders</span>
                    </li>
                </a>
                <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('user.wishlist') }}">
                    <li class="nav-link border rounded-2 m-2 p-2">
                        <span class="side-menu__label text-white">My wishlist</span>
                    </li>
                </a>
            </ul>
            <div class="slide-right" id="slide-right">
            </div>
        </div>
    </div>
</div>
<!--/APP-SIDEBAR-->
