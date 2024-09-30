@extends('admin.master')

@section('title')
    General Settings Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('logo-address.index') }}">General Settings</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">General Settings Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>

        <hr/>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header fs-3 fw-bold">General Settings Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Favicon </th>
                                    <td>
                                        <img src="{{ asset($logo_address->favicon) }}" alt="{{ $logo_address->fav_alt }}" class="img-fluid" style="height: 50px; width: 50px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Favicon Alt Text </th>
                                    <td>{{$logo_address->fav_alt}}</td>
                                </tr>
                                <tr>
                                    <th> Logo </th>
                                    <td>
                                        <img src="{{ asset($logo_address->logo) }}" alt="{{ $logo_address->alt }}" class="img-fluid" style="height: 50px; width: auto;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Footer Logo </th>
                                    <td>
                                        <img src="{{ asset($logo_address->footer_image) }}" alt="{{ $logo_address->footer_alt }}" class="img-fluid" style="height: 50px; width: auto;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Logo Alt Text </th>
                                    <td>{{$logo_address->alt}}</td>
                                </tr>
                                <tr>
                                    <th> Footer Logo Alt Text </th>
                                    <td>{{$logo_address->footer_alt}}</td>
                                </tr>
                                <tr>
                                    <th> Contact Mail </th>
                                    <td>{{$logo_address->gmail}}</td>
                                </tr>
                                <tr>
                                    <th> Contact Number </th>
                                    <td>{{$logo_address->number}}</td>
                                </tr>
                                <tr>
                                    <th> Slogan </th>
                                    <td>{!! $logo_address->slogan !!}</td>
                                </tr>
                                <tr>
                                    <th> Address </th>
                                    <td>{!! $logo_address->address !!}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('logo-address.edit', Crypt::encryptString($logo_address->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
