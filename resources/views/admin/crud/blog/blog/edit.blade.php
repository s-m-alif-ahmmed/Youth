@extends('admin.master')

@section('title')
    Edit Blog
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('blog.index') }}">Blog</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-primary">{{session('message')}}</p>

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit Blog</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('blog.update', Crypt::encryptString($blog->id) )}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="col-12 form-group">
                                    <label for="name" class="form-label"> Category Name</label>
                                    <select class="form-control select2 form-select" name="category_id" id="category_id">
                                        <option value="" >Select Category</option>
                                        @foreach($blog_categories as $category)
                                            <option value="{{ $category->id }}" {{$category->id == $blog->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="meta_title" class="form-label"> Meta Title</label>
                                    <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Enter meta title" value="{{ $blog->meta_title }}" required />
                                </div>

                                <div class="col-12">
                                    <label for="meta_description" class="form-label"> Meta Description</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="3" placeholder="Enter meta description" required>{{ $blog->meta_description }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label for="title" class="form-label"> Blog Title </label>
                                    <input class="form-control" type="text" name="title" id="title" placeholder="Enter blog name" value="{{ $blog->title }}" required />
                                </div>

                                <div class="col-12">
                                    <label for="image" class="form-label"> Blog Feature Image </label>
                                    <input class="form-control" type="file" name="image" id="image" placeholder="Enter blog feature image" value="{{ $blog->image }}" />
                                    <img class="img-fluid" src="{{ asset( $blog->image ) }}" alt="{{ $blog->alt }}" style="height: 100px; width: 200px;" />
                                </div>

                                <div class="col-12">
                                    <label for="alt" class="form-label"> Blog Feature Image Alt</label>
                                    <input class="form-control" type="text" name="alt" id="alt" placeholder="Enter blog feature image alt" value="{{ $blog->alt }}" required />
                                </div>

                                <div class="col-12">
                                    <label for="short_description" class="form-label"> Short Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description" cols="30" rows="3" required>{{ $blog->short_description }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label"> Description</label>
                                    <textarea class="form-control" name="description" id="editor" cols="30" rows="5">{{ $blog->description }}</textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
