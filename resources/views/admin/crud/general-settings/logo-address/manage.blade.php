@extends('admin.master')

@section('title')
    General Settings
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage General Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>

        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr>
                            <th> SL </th>
                            <th> Favicon </th>
                            <th> Logo </th>
                            <th> Footer Logo </th>
                            <th> Address </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logo_addresses as $logo_address)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{ asset($logo_address->favicon) }}" alt="{{ $logo_address->fav_alt }}" class="img-fluid" style="height: 50px; width: 50px;" />
                                </td>
                                <td>
                                    <img src="{{ asset($logo_address->logo) }}" alt="{{ $logo_address->alt }}" class="img-fluid" style="height: 50px; width: auto;" />
                                </td>
                                <td>
                                    <img src="{{ asset($logo_address->footer_image) }}" alt="{{ $logo_address->footer_alt }}" class="img-fluid" style="height: 50px; width: auto;" />
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                        {!! $logo_address->address !!}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('logo-address.show', Crypt::encryptString($logo_address->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('logo-address.edit', Crypt::encryptString($logo_address->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
