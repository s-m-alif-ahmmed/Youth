@extends('admin.master')

@section('title')
    Orders Manage
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
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Orders</li>
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
                            <th> Order Time </th>
                            <th> User Name </th>
                            <th> Order Tracking Id </th>
                            <th> Delivery Address </th>
                            <th> Number </th>
                            <th> Total Price </th>
                            <th> Order Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders->sortByDesc('created_at') as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Asia/Dhaka')->format('M d, Y, h:i:s') }}
                                </td>
                                <td>{{$order->user->name}}</td>
                                <td>#{{$order->tracking_id}}</td>
                                <td>
                                    <address>
                                        {{$order->address}},<br>
                                        {{$order->city}},<br>
                                        {{$order->postal_code}}
                                    </address>
                                </td>
                                <td>
                                    {{$order->number}}
                                </td>
                                <td>{{ $order->istimate_total ?? $order->order_total }} Tk</td>
                                <td>
                                    <form action="{{ route('change.status.order', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="form-control">
                                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Complete" {{ $order->status == 'Complete' ? 'selected' : '' }}>Complete</option>
                                            <option value="Return" {{ $order->status == 'Return' ? 'selected' : '' }}>Return</option>
                                            <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('admin.order.detail',$order->tracking_id )}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
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

