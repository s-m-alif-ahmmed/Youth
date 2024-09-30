@extends('admin.master')

@section('title')
    Orders Invoice
@endsection

@section('content')

    <section>
        <div class="main-content mt-0">
            <div class="">

                <!-- CONTAINER -->
                <div class="">

                    <!-- PAGE-HEADER -->
                    <div class="page-header" id="pageHeader">
                        <div>
                            <h1 class="page-title">Invoice-Details</h1>
                        </div>
                        <div class="ms-auto pageheader-btn">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.orders.pending') }}">Invoices</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Invoice Details</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" id="invoiceCard">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-start">
                                            <h3 class="card-title mb-0">#INV-00{{ $order->id }}</h3>
                                        </div>
                                        @php
                                            use Carbon\Carbon;
                                            $currentDateTime = Carbon::now('Asia/Dhaka')->format('d M, Y, h:ia');
                                        @endphp
                                        <div class="float-end">
                                            <h3 class="card-title">Date: {{ $currentDateTime }}</h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 ">
                                            <p class="h3">Invoice Form:</p>
                                            @foreach($logo_address as $address)
                                                <img class="img-fluid py-1" src="{{ asset($address->logo) }}" alt="{{ $address->logo_alt}}" style="height: 50px; width: auto;">
                                                <address>
                                                    <span class="p-0">
                                                        {!! $address->address !!}
                                                    </span>
                                                    {{ $address->gmail }}<br>
                                                    {{ $address->number }}
                                                </address>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-6 text-end">
                                            <p class="h3">Invoice To:</p>
                                            <address>
                                                {{ $order->name }}<br>
                                                {{ $order->address }}<br>
                                                {{ $order->city }}-{{ $order->postal_code }}<br>
                                                {{ $order->number }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="table-responsive push">
                                        <table class="table table-bordered table-hover mb-0 text-nowrap border-bottom w-100">
                                            <tbody><tr class=" ">
                                                <th class="text-center"></th>
                                                <th>Product</th>
                                                <th class="text-center">Size</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-end">Unit Price</th>
                                                <th class="text-end">Sub Total</th>
                                            </tr>
                                            @php
                                                $totalSum = 0;
                                            @endphp

                                            @foreach($order_details as $orders)
                                                @php
                                                    $subTotal = $orders->quantity * $orders->product->selling_price;
                                                    $totalSum += $subTotal;
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <nav aria-label="breadcrumb mx-0 px-0">
                                                            <ol class="breadcrumb mx-0 px-0">
                                                                <li class="breadcrumb-item mx-0 px-0">{{ $orders->product->menu->name }}</li>
                                                                <li class="breadcrumb-item active" aria-current="page">{{ $orders->product->productCategory->name }}</li>
                                                            </ol>
                                                        </nav>
                                                        <div class="text-muted"><div class="text-muted">{{ $orders->product->name }} </div></div>
                                                    </td>

                                                    <td class="text-center">
                                                        @if($orders->product_size_id)
                                                            {{ $orders->productSize->name }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $orders->quantity }} pcs</td>
                                                    <td class="text-end">
                                                        {{ $orders->product->selling_price }} tk
                                                        @if($orders->product->regular_price)
                                                            <del>
                                                                ({{ $orders->product->regular_price }}) tk
                                                            </del>
                                                        @endif
                                                        <br>
                                                        @if($orders->product->offer_id)
                                                            {{ $orders->product->offer->name }}
                                                        @endif
                                                        @if($orders->product->event_id)
                                                            {{ $orders->product->event->name }}
                                                        @endif
                                                    </td>
                                                    <td class="text-end">{{ $quantity_sum = $orders->product->selling_price * $orders->quantity }} tk</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6" class="text-uppercase text-end"> Sub Total</td>
                                                <td class="text-end h5">{{ $totalSum }} Tk</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-uppercase text-end">Delivery Charge</td>
                                                <td class="text-end h5">{{ $order->deliveryTax->delivery_charge }} Tk</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-uppercase text-end">VAT</td>
                                                <td class="text-end h5">{{ $tax = ($totalSum /100) * $order->deliveryTax->vat }} Tk</td>
                                            </tr>
                                            @php
                                                $delivery_charger =  $order->deliveryTax->delivery_charge ;
                                                $sum = $totalSum + $delivery_charger + $tax;
                                            @endphp
                                            <tr>
                                                <td colspan="6" class="text-uppercase text-end"> Total</td>
                                                <td class="text-end h5">{{ $sum }} Tk</td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>
                                <div class="card-footer text-end" id="invoiceFooter">
                                    <button type="button" class="btn btn-info mb-1" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                                </div>
                            </div>
                        </div><!-- COL-END -->
                    </div>
                    <!-- ROW-1 CLOSED -->

                </div>
            </div>
        </div>
    </section>

    <style>
        @media print {
            #pageHeader{
                visibility: hidden;
            }
            #invoiceFooter {
                visibility: hidden;
            }
            #back-to-top {
                visibility: hidden;
            }
        }
    </style>

    <script>
        function printInvoice() {
            window.print();
        }
    </script>

@endsection
