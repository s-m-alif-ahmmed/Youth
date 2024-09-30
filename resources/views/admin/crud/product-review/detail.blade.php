@extends('admin.master')

@section('title')
    Product Review Detail
@endsection

@section('content')
    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('product-review.index') }}">Product Review</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product Review Detail Page</li>
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
                        <div class="card-header fs-3 fw-bold">Product Review Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Product Review Create Time </th>
                                    <td>{{$product_review->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia')}}</td>
                                </tr>
                                <tr>
                                    <th> User Name </th>
                                    <td>{{$product_review->user->name}}</td>
                                </tr>
                                <tr>
                                    <th> User Email </th>
                                    <td>{{$product_review->user->email}}</td>
                                </tr>
                                <tr>
                                    <th> Product Name </th>
                                    <td>{{$product_review->product->name}}</td>
                                </tr>
                                <tr>
                                    <th> Review Star </th>
                                    <td>{{$product_review->star}}</td>
                                </tr>
                                <tr>
                                    <th> Product Review </th>
                                    <td>{{$product_review->product_review}}</td>
                                </tr>
                                <tr>
                                    <th> Product Review Status</th>
                                    <td>
                                        @if($product_review->status == 'active')
                                            <a href="{{ route('change.status.product.review', $product_review->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm on">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @else($product_review->status == 'inActive')
                                            <a href="{{ route('change.status.product.review', $product_review->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm off">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('product-review.destroy', $product_review->id )}}" method="post" id="deleteForm{{ $product_review->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $product_review->id }}', 'Are you sure to delete this product review?', 'btn-danger')">
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
