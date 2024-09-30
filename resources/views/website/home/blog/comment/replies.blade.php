<div class="col-12">
    @foreach ($comments->where('parent_id') as $comment)
        @if($comment->status == 'active')
            <div class="media mb-4 pt-3 overflow-visible" data-comment-id="{{ $comment->id }}">

                <div class="media-body border p-4 overflow-visible br-5">
                    <nav class="nav float-end">
                        <div class="dropdown">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                            @auth
                                @if (auth()->user()->id === $comment->user_id)
                                    <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-start">
                                        <a class="dropdown-item edit-comment-reply" href="#"><i class="fe fe-edit me-1"></i> Edit</a>
                                        <form action="{{ route('comment.destroy', $comment->id )}}" method="post" onclick="return confirm('Are you sure to delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item border-0 text-white" type="submit"><i class="fa-regular fe-trash-2 me-1"></i> Delete </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                        </div>
                    </nav>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="margin-top: -8px;">
                            @if ($comment->user->photo)
                                <img class="media-object rounded-circle thumb-sm" alt="user_photo" src="{{asset( $comment->user->photo )}}" style="height: 40px; width: 40px;">
                            @else
                                <img class="media-object rounded-circle thumb-sm" alt="user_photo" src="{{asset('/')}}website/img/blank-profile.jpg" style="height: 40px; width: 40px;">
                            @endif
                        </div>
                        <h5 class="mt-0">
                            @if ($comment->user)
                                {{ $comment->user->name }}
                            @endif
                            <span class="text-muted fs-12 mx-1 bg-normal-light" style="font-size: 14px;">
                        @php
                            $parentComment = App\Models\Admin\Comment::find($comment->parent_id);
                        @endphp

                                @if($parentComment && $parentComment->user)
                                    Reply to {{ $parentComment->user->name }}
                                @endif
                        </span>

                        </h5>
                    </div>
                    <span class="text-muted fs-12 ms-1" style="font-size: 14px;">
                        @if ($comment->created_at)
                            {{ $comment->created_at->diffForHumans() }}
                        @endif
                </span>
                    <span><i class="fe fe-thumb-up text-danger"></i></span>
                    <p class="font-13 text-muted comment-text mt-2">
                        {{ $comment->comment }}
                    </p>

                    <form action="{{ route('comment.update', $comment->id) }}" method="post" class="update-comment-reply" style="display: none;">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                        <textarea class="form-control input-focus" name="comment" rows="5" placeholder="Your Comment">{{ $comment->comment }}</textarea>

                        <div class="py-3 text-end">
                            <button class="edit-comment-close btn btn-danger" type="button">
                                Cancel
                            </button>
                            <button class="btn btn-dark" type="submit">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        @endif
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Add an event listener to the Edit button
        $('.edit-comment-reply').click(function () {
            var commentContainer = $(this).closest('.media-body');

            // Show the edit form and hide the comment text
            commentContainer.find('.comment-text').hide();
            commentContainer.find('.edit-comment-reply').hide();
            commentContainer.find('.update-comment-reply').show();
        });

        // Add an event listener to the Edit button
        $('.edit-comment-close').click(function () {
            var commentContainer = $(this).closest('.media-body');

            // Show the edit form and hide the comment text
            commentContainer.find('.comment-text').show();
            commentContainer.find('.update-comment-reply').hide();
            commentContainer.find('.edit-comment-reply').show();
        });
    });
</script>

