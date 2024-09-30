@extends('admin.master')

@section('title')
    Product Review Manage
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Product Reviews</li>
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
                            <th> User Name </th>
                            <th> Product Name </th>
                            <th> Review Star </th>
                            <th> Review </th>
                            <th> Product Review Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product_reviews as $review)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$review->user->name}}</td>
                                <td>{{$review->product->name}}</td>
                                <td>{{$review->star}}</td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="width: 150px;">
                                        {{$review->product_review}}
                                    </span>
                                </td>
                                <td>
                                    @if($review->status == 'active')
                                        <a href="{{ route('change.status.product.review', $review->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm on">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @else($product->status == 'inActive')
                                        <a href="{{ route('change.status.product.review', $review->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm off">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('product-review.show', Crypt::encryptString($review->id) )}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('product-review.destroy', $review->id )}}" method="POST" id="deleteForm{{ $review->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $review->id }}', 'Are you sure to delete this product review?', 'btn-danger')">
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
