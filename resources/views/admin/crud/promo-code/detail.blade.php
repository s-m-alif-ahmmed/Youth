@extends('admin.master')

@section('title')
    Coupon Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('coupon.index') }}">Coupon</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Coupon Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('coupon.create') }}">Add Coupon</a>
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
                        <div class="card-header fs-3 fw-bold">Coupon Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Coupon Code </th>
                                    <td>{{$coupon->code}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Name </th>
                                    <td>{{$coupon->name}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Discount Amount </th>
                                    <td>{{$coupon->discount_amount}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Discount Type </th>
                                    <td>{{$coupon->type}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Max Use </th>
                                    <td>{{$coupon->max_uses}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Max User Use </th>
                                    <td>{{$coupon->max_uses_user}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Min Amount </th>
                                    <td>{{$coupon->min_amount}}</td>
                                </tr>
                                <tr>
                                    <th> Coupon Start Date </th>
                                    <td>
                                        {{ \Carbon\Carbon::parse($coupon->starts_at)->setTimezone('Asia/Dhaka')->format('M d, Y, h:i:s') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th> Coupon Expires Date </th>
                                    <td>
                                        {{ \Carbon\Carbon::parse($coupon->expires_at)->setTimezone('Asia/Dhaka')->format('M d, Y, h:i:s') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th> Coupon Status</th>
                                    <td>
                                        @if($coupon->status == 'active')
                                            <a href="{{ route('change.status.coupon.code', $coupon->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn btn-success">Active</a>
                                        @else($coupon->status == 'inActive')
                                            <a href="{{ route('change.status.coupon.code', $coupon->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">InActive</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('coupon.edit', Crypt::encryptString($coupon->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('coupon.destroy', $coupon->id )}}" method="post" id="deleteForm{{ $coupon->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $coupon->id }}', 'Are you sure to delete this coupon?', 'btn-danger')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
