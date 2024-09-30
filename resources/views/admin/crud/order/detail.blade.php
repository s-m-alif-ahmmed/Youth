@extends('admin.master')

@section('title')
    Order Detail
@endsection

@section('content')
    <section class="my-5">
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
                            <li class="breadcrumb-item active" aria-current="page">Order Detail Page</li>
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
                            <th> Product Image </th>
                            <th> Product Name </th>
                            <th> Product Price </th>
                            <th> Product Quantity </th>
                            <th> Product Size </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_details as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{ asset($order->product->image) }}" alt="{{$order->product->alt}}" class="img-fluid" style="height: 60px; width: auto;">
                                </td>
                                <td>{{$order->product->name}}</td>
                                <td>{{$order->product->selling_price}} Tk</td>
                                <td>{{ $order->quantity }} Pcs</td>
                                <td>
                                    @if($order->product_size_id)
                                        {{ $order->productSize->name }}
                                    @else
                                        N/a
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('product.show', $order->product->product_slug )}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
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
