@extends('website.master')

@section('title')

    Dashboard | Settings

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
                                    <li class="nav-link border rounded-2 m-2 p-2">
                                        <span class="side-menu__label text-white">Profile</span>
                                    </li>
                                </a>
                                <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('profile.edit') }}">
                                    <li class="nav-link border bg-white rounded-2 m-2 p-2">
                                        <span class="side-menu__label text-black">Settings</span>
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
			<div class="col-lg-9">
                    <div class="tab-content">

                        <div class="card" style="background-color: #212529;">
                            <div class="card-body border-0">
                                <div class="form-horizontal">
                                    <div class="row mb-4">
                                        <p class="mb-4 text-center fw-bold text-white" style="font-size: 24px;">Personal Info</p>

                                        @if(session('message'))
                                        <p class="text-center text-muted my-2">{{session('message')}}</p>
                                        @endif
                                        <form class="" action="{{route('profile.update')}}" method="post">
                                            @csrf
                                            @method('patch')

                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <div class="row row-sm">
                                                        <div class="col-md-3">
                                                            <label for="name" class="form-label text-white">Full Name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control input-focus" name="name" id="name" placeholder="Enter name" value="{{Auth::user()->name}}" required />
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
                                                            <input type="email" class="form-control input-focus" id="email" name="email" placeholder="Enter email" value="{{Auth::user()->email}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mb-3">
                                                <button class="btn bg-primary text-white btn-sm" type="submit">save changes</button>
                                            </div>
                                        </form>
                                    </div>

{{--                                    Others Info--}}

                                    <div class="row mb-4">
                                        <p class="mb-4 text-17 text-white">Profile Info</p>
                                        <form class="" action="{{route('photo.update', Auth::user()->id)}}" method="post">
                                            @csrf
                                            @method('patch')

                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <div class="row row-sm">
                                                        <div class="col-md-3">
                                                            <label for="photo" class="form-label text-white">Phone Number</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control input-focus" id="number" name="number" placeholder="Enter your phone number" value="{{Auth::user()->number}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <div class="row row-sm">
                                                        <div class="col-md-3">
                                                            <label for="photo" class="form-label text-white">Address</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <textarea type="text" class="form-control input-focus" id="address" name="address" placeholder="Enter your address" >{{ Auth::user()->address }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center mb-3">
                                                <button class="btn bg-primary text-white btn-sm" type="submit">save changes</button>
                                            </div>
                                        </form>
                                    </div>

                                    {{--                                            Password Changes--}}

                                    <div class="mb-4">
                                        <p class="mb-4 text-17 text-white">Password Info</p>
                                        <form class="" action="{{route('password.update')}}" method="post">
                                            @csrf
                                            @method('put')

                                            @if(session('status') === 'password-updated')
                                                <p
                                                    x-data="{ show: true}"
                                                    x-show ="show"
                                                    x-transition
                                                    x-init="setTimeout(() => show = false, 2000)"
                                                    class="text-sm text-gray-600"
                                                >
                                                    {{__('Password Update Successfully')}}
                                                </p>
                                            @endif

                                            <div class="form-group mb-3">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="current_password" class="form-label text-white">Current Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" name="current_password" class="form-control input-focus" id="current_password" placeholder="current password" value="">
                                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="password" class="form-label text-white">New Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" name="password" class="form-control input-focus" id="password" placeholder="new password" value="">
                                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="password_confirmation" class="form-label text-white">Confirm Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control input-focus" id="password_confirmation" name="password_confirmation" placeholder="confirm password" value="">
                                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center mb-3">
                                                <button class="btn bg-primary text-white btn-sm" type="submit">save changes</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mb-4">
                                        <p class="mb-4 text-17 text-white">Delete Account</p>
                                        <form method="post" action="{{route('profile.destroy')}}" class="p-6" id="deleteProfile">
                                            @csrf
                                            @method('delete')
                                            <div class="form-group mb-3">
                                                <div class="row row-sm">
                                                    <p class="fs-6 text-white">If you want to delete this account , enter your current password.</p>
                                                </div>
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="password" class="form-label text-white">Current Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control input-focus" id="password" name="password" placeholder="current password" value="">
                                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <a href="" onclick="event.preventDefault(); document.getElementById('deleteProfile').submit(); ">
                                            <div class="text-center">
                                                <button class="btn bg-primary text-white btn-sm" type="submit" id="deleteProfile">Delete Account</button>
                                            </div>
                                        </a>

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
