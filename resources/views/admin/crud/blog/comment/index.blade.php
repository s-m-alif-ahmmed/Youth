@extends('admin.master')

@section('title')
    Comments
@endsection

@section('content')

    <section class="py-5">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{route('dashboard')}}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Comment</li>
                    </ol>
                </nav>
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
                            <th> Comment Created </th>
                            <th> User Name </th>
                            <th> Main Comment </th>
                            <th> Comment </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $comment->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                <td>{{$comment->user->name}}</td>
                                <td>{{ optional($comment->parent)->comment ?? 'No Parent' }}</td>
                                <td>{{$comment->comment}}</td>
                                <td>
                                    @if($comment->status == 'active')
                                        <a href="{{ route('change.status.blog.comment', $comment->id) }}" class="btn btn-success">Show</a>
                                    @else($comment->status == 'inActive')
                                        <a href="{{ route('change.status.blog.comment', $comment->id) }}" class="btn btn-danger">Hide</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="{{route('admin.blog.comment.view', Crypt::encryptString($comment->id))}}" class="text-primary mx-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="fa fa-eye"></i></a>
                                        {{--                                        <a href="{{route('comment.edit', Crypt::encryptString($comment->id))}}" class="text-warning mx-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>--}}
                                        <form action="{{ route('comment.destroy', $comment->id )}}" method="post" onclick="return confirm('Are you sure to delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger border-0" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
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
