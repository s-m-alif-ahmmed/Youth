@extends('admin.master')

@section('title')
    Comment Details
@endsection

@section('content')

    <section class="py-5">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{route('admin.blog.comment.manage')}}">
                                Comment
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Comment</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header fs-3 fw-bold">Comment Details Page</div>
                        <p class="text-success text-center">{{session('message')}}</p>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Comment Created </th>
                                    <td>{{ $comment->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                </tr>
                                <tr>
                                    <th> User Name </th>
                                    <td>{{$comment->user->name}}</td>
                                </tr>
                                <tr>
                                    <th> Blog Title </th>
                                    <td>{{$comment->blog->title}}</td>
                                </tr>
                                <tr>
                                    <th> Main Comment </th>
                                    <td>
                                        <textarea class="form-control" readonly>{{ optional($comment->parent)->comment ?? 'No Main Comment Found' }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Comment </th>
                                    <td>
                                        <textarea class="form-control" readonly>{{$comment->comment}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Comment Create Date </th>
                                    <td>
                                        {{ $comment->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th> Status</th>
                                    <td>
                                        @if($comment->status == 'active')
                                            <a href="{{ route('change.status.blog.comment', $comment->id) }}" class="btn btn-success">Show</a>
                                        @else($comment->comment_status == 'inActive')
                                            <a href="{{ route('change.status.blog.comment', $comment->id) }}" class="btn btn-danger">Hide</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            {{--                                            <a href="{{route('comment.edit', Crypt::encryptString($comment->id) )}}" class="text-warning mx-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>--}}
                                            <form action="{{ route('comment.destroy', $comment->id )}}" method="post" onclick="return confirm('Are you sure to delete this comment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0 mx-2" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
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
