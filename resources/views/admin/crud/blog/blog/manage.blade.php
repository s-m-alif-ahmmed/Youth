@extends('admin.master')

@section('title')
    Blogs
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Blogs</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-primary rounded-3" href="{{ route('blog.create') }}">Add Blog</a>
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
                            <th> Category Name  </th>
                            <th> Blog Title </th>
                            <th> Blog Features Image </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$blog->blog_category->name}}</td>
                                <td>{{$blog->title}}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset( $blog->image ) }}" alt="{{$blog->alt}}" style="height: 120px; width: 200px;" />
                                </td>
                                <td>
                                    @if($blog->status == 'Publish')
                                        <a href="{{ route('change.status.blog', $blog->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn btn-success">Publish</a>
                                    @else($blog->status == 'Draft')
                                        <a href="{{ route('change.status.blog', $blog->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('blog.show', Crypt::encryptString($blog->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('blog.edit', Crypt::encryptString($blog->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('blog.destroy', $blog->id )}}" method="post" id="deleteForm{{ $blog->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $blog->id }}', 'Are you sure to delete this blog?', 'btn-danger')">
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
