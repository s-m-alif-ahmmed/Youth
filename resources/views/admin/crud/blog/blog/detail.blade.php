@extends('admin.master')

@section('title')
    Blog Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('blog.index') }}">Blog</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('blog.create') }}">Add Blog</a>
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
                        <div class="card-header fs-3 fw-bold">Blog Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Category Name </th>
                                    <td>{{$blog->blog_category->name}}</td>
                                </tr>
                                <tr>
                                    <th> Meta Title </th>
                                    <td>{{$blog->meta_title}}</td>
                                </tr>
                                <tr>
                                    <th> Meta Description </th>
                                    <td>{{$blog->meta_description}}</td>
                                </tr>
                                <tr>
                                    <th> Blog Title </th>
                                    <td>{{$blog->title}}</td>
                                </tr>
                                <tr>
                                    <th> Blog Feature Image </th>
                                    <td>
                                        <img class="img-fluid" src="{{ asset( $blog->image ) }}" alt="{{ $blog->alt }}" style="height: 100px; width: 200px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Blog Feature Image Alt </th>
                                    <td>{{$blog->alt}}</td>
                                </tr>
                                <tr>
                                    <th> Blog Short Description </th>
                                    <td>{{$blog->short_description}}</td>
                                </tr>
                                <tr>
                                    <th> Blog Description </th>
                                    <td>
                                        {!! $blog->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th> Status</th>
                                    <td>
                                        @if($blog->status == 'Publish')
                                            <a href="{{ route('change.status.blog', $blog->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn btn-success">Publish</a>
                                        @else($blog->status == 'Draft')
                                            <a href="{{ route('change.status.blog', $blog->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('blog.edit', Crypt::encryptString($blog->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('blog.destroy', $blog->id )}}" method="post" id="deleteForm{{ $blog->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $blog->id }}', 'Are you sure to delete this blog?', 'btn-danger')">
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
