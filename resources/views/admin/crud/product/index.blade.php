@extends('admin.master')

@section('title')
    Product Manage
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('product.create') }}">Add Product</a>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif

        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr>
                            <th> SL </th>
                            <th> Menu Name </th>
                            <th> Category Name </th>
                            <th> Offer </th>
                            <th> Event </th>
                            <th> Product Name </th>
                            <th> Product Image </th>
                            <th> Product Status </th>
                            <th> Most Selling Product Status </th>
{{--                            <th> Related Product Status </th>--}}
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products->sortByDesc('created_at') as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($product->menu_id)
                                        {{$product->menu->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->product_category_id)
                                        {{$product->productCategory->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->offer_id)
                                        {{$product->offer->name}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($product->event_id)
                                        {{$product->event->name}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{$product->name}}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->alt }}" style="height: 75px; width: auto;" />
                                </td>
                                <td>
                                    @if($product->status == 'active')
                                        <a href="{{ route('change.product.status', $product->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm on">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @else($product->status == 'inActive')
                                        <a href="{{ route('change.product.status', $product->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm off">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($product->popular_status == 'active')
                                        <a href="{{ route('change.popular.product.status', $product->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm on">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @else($product->popular_status == 'inActive')
                                        <a href="{{ route('change.popular.product.status', $product->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm off">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </td>
{{--                                <td>--}}
{{--                                    @if($product->related_status == 'active')--}}
{{--                                        <a href="{{ route('change.related.product.status', $product->id) }}">--}}
{{--                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">--}}
{{--                                                <div class="toggle toggle-warning toggle-sm on">--}}
{{--                                                    <span></span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    @else($product->related_status == 'inActive')--}}
{{--                                        <a href="{{ route('change.related.product.status', $product->id) }}">--}}
{{--                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">--}}
{{--                                                <div class="toggle toggle-warning toggle-sm off">--}}
{{--                                                    <span></span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('product.show', $product->product_slug)}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('product.edit', Crypt::encryptString($product->id) )}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('product.destroy', $product->id )}}" method="POST" id="deleteForm{{ $product->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $product->id }}', 'Are you sure to delete this product?', 'btn-danger')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
