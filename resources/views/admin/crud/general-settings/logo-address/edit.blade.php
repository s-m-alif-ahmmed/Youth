@extends('admin.master')

@section('title')
    Edit General Settings
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('logo-address.index') }}">General Settings</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit General Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-primary">{{session('message')}}</p>

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit General Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('logo-address.update', Crypt::encryptString($logo_address->id) )}}" enctype="multipart/form-data" >
                                @csrf
                                @method('patch')

                                <div class="col-12">
                                    <label for="favicon" class="form-label"> Favicon (512*512px) </label>
                                    <input class="form-control" type="file" name="favicon" id="favicon" value="{{ $logo_address->favicon }}" placeholder="Enter favicon" />
                                    <img class="img-fluid m-2" src="{{ asset($logo_address->favicon) }}" alt="{{ $logo_address->fav_alt }}" style="height: 75px; width: 120px;" />
                                </div>

                                <div class="col-12">
                                    <label for="fav_alt" class="form-label"> Favicon Alt Text </label>
                                    <input class="form-control" type="text" name="fav_alt" id="fav_alt" value="{{ $logo_address->fav_alt }}" placeholder="Enter favicon alt text" required />
                                </div>

                                <div class="col-12">
                                    <label for="logo" class="form-label"> Header Logo (1080*500px) </label>
                                    <input class="form-control" type="file" name="logo" id="logo" value="{{ $logo_address->logo }}" placeholder="Enter logo" />
                                    <img class="img-fluid m-2" src="{{ asset($logo_address->logo) }}" alt="{{ $logo_address->alt }}" style="height: 75px; width: 120px;" />
                                </div>

                                <div class="col-12">
                                    <label for="footer_image" class="form-label"> Footer Logo (1080*500px) </label>
                                    <input class="form-control" type="file" name="footer_image" id="footer_image" value="{{ $logo_address->footer_image }}" placeholder="Enter footer logo" />
                                    <img class="img-fluid m-2" src="{{ asset($logo_address->footer_image) }}" alt="{{ $logo_address->footer_alt }}" style="height: 75px; width: 120px;" />
                                </div>

                                <div class="col-12">
                                    <label for="alt" class="form-label"> Logo Alt Text </label>
                                    <input class="form-control" type="text" name="alt" id="alt" value="{{ $logo_address->alt }}" placeholder="Enter logo alt text" required />
                                </div>

                                <div class="col-12">
                                    <label for="footer_alt" class="form-label"> Footer Logo Alt Text </label>
                                    <input class="form-control" type="text" name="footer_alt" id="footer_alt" value="{{ $logo_address->footer_alt }}" placeholder="Enter footer logo alt text" required />
                                </div>

                                <div class="col-12">
                                    <label for="gmail" class="form-label"> Mail </label>
                                    <input class="form-control" type="email" name="gmail" id="gmail" value="{{ $logo_address->gmail }}" placeholder="Enter contact mail" required />
                                </div>

                                <div class="col-12">
                                    <label for="number" class="form-label"> Number </label>
                                    <input class="form-control" type="number" name="number" id="number" value="{{ $logo_address->number }}" placeholder="Enter contact number" required />
                                </div>

                                <div class="col-12">
                                    <label for="slogan" class="form-label"> Slogan </label>
                                    <textarea name="slogan" id="editor" cols="30" rows="10" required>{{ $logo_address->slogan }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label"> Address </label>
                                    <textarea name="address" id="editor1" cols="30" rows="10" required>{{ $logo_address->address }}</textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
