@extends('website.master')

@section('title')

    Dashboard | Profile

@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

<section class="py-5">

	<div class="container">

		<div class="row">
			<div class="col-md-3">
                <!--APP-SIDEBAR-->
                <div class="sticky mb-3">
                    <div class="app-sidebar card" style="background-color: #212529;">
                        <div class="main-sidemenu">
                            <ul class="side-menu ps-0">
                                <a class="nav-item text-decoration-none text-white" href="{{route('dashboard')}}">
                                    <li class="nav-link border bg-white rounded-2 m-2 p-2">
                                        <span class="side-menu__label text-black">Profile</span>
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
			</div>
			<div class="col-md-9">
				<div class="card" style="background-color: #212529;">
					<div class="card-body border-0">
						<div class="form-horizontal">
							<div class="row">
								<p class="mb-4 text-center fw-bold text-white" style="font-size: 24px;">Personal Info</p>

								<div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="name" class="form-label text-white">Full Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control input-focus" name="name" id="name"
                                                       value="{{Auth::user()->name}}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label for="email" class="form-label text-white">Email</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control input-focus" id="email" name="email"
                                                       value="{{Auth::user()->email}}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label for="email" class="form-label text-white">Phone Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control input-focus" id="number"
                                                       name="number" value="{{Auth::user()->number}}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label for="email" class="form-label text-white">Address</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea type="text" class="form-control input-focus" id="address"
                                                          name="address"
                                                          disabled>{{Auth::user()->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

@endsection
