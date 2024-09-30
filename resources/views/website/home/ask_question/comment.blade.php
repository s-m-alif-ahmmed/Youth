<div class="mt-4 pt-5 border-top col-12">
    <h3 class="card-title">Comments:</h3>

    @php
        $comments = App\Models\Comment::all();
    @endphp

    @foreach ($comments->where('blog_id', $blog->id)->where('parent_id', null)->take(5) as $comment)
    <div class="media mb-4 overflow-visible">
        <div class="me-3">
            <a href="profile.html">
                <img class="media-object rounded-circle thumb-sm" alt="64x64" src="{{asset( $comment->user->image )}}">
            </a>
        </div>
        <div class="media-body overflow-visible">
            <div class="border mb-5 p-4 br-5">
                <nav class="nav float-end">
                    <div class="dropdown">
                        @auth
                            @if (auth()->user()->id === $comment->user_id)
                                <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-start">
                                    <a class="dropdown-item edit-main-comment-reply" href="#"><i class="fe fe-edit me-1"></i> Edit</a>
                                    <form action="{{ route('comment.destroy', $comment->id )}}" method="post" onclick="return confirm('Are you sure to delete this comment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item border-0" type="submit"><i class="fe fe-trash-2 me-1"></i> Delete </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </nav>
                <h5 class="mt-0">
                    @if ($comment->user)
                        {{ $comment->user->name }}
                    @endif
                    <span class="text-muted fs-12 ms-1">
                        @if ($comment->created_at)
                            {{ $comment->created_at->diffForHumans() }}
                        @endif
                    </span>
                </h5>
                <span><i class="fe fe-thumb-up text-danger"></i></span>
                <p class="font-13 text-muted main-comment-text">
                    {{ $comment->comment }}
                </p>

                <span class="reply comment-reply-button">
                    <span class="reply">
                        @include('website.comment.inside-comment')
                    </span>
                </span>

                <form action="{{ route('comment.update', $comment->id) }}" method="post" class="update-main-comment-reply" style="display: none;">
                    @csrf
                    @method('patch')

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                    <textarea class="form-control" name="comment" rows="5" placeholder="Your Comment">{{ $comment->comment }}</textarea>

                    <div class="py-3 text-end">
                        <button class="edit-main-comment-close btn btn-danger" type="button">
                            Cancel
                        </button>
                        <button class="btn btn-sm btn-dark text-white" type="submit">Update</button>
                    </div>
                </form>

            @include('website.comment.replies', ['comments' => $comment->replies])

            </div>
        </div>

    </div>

    @endforeach

    @include('website.comment.index')

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Add an event listener to the Edit button
        $('.edit-main-comment-reply').click(function () {
            var commentContainer = $(this).closest('.media-body');

            // Show the edit form and hide the comment text
            commentContainer.find('.main-comment-text').hide();
            commentContainer.find('.edit-main-comment-reply').hide();
            commentContainer.find('.comment-reply-button').hide();
            commentContainer.find('.update-main-comment-reply').show();
        });

        // Add an event listener to the Edit button
        $('.edit-main-comment-close').click(function () {
            var commentContainer = $(this).closest('.media-body');

            // Show the edit form and hide the comment text
            commentContainer.find('.main-comment-text').show();
            commentContainer.find('.update-main-comment-reply').hide();
            commentContainer.find('.comment-reply-button').show();
            commentContainer.find('.edit-main-comment-reply').show();
        });
    });
</script>

