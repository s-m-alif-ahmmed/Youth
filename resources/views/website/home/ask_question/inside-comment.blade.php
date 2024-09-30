<div class="accordion-item col-12">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $comment->id }}" aria-expanded="false" aria-controls="collapse{{ $comment->id }}">
            <span class="badge badge-sm btn-info-light rounded-pill py-2 px-3"><i class="fe fe-corner-up-left me-1"></i>Reply</span>
        </button>
    </h2>
    <div id="collapse{{ $comment->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            @auth
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                    <textarea class="form-control input-focus" name="comment" rows="5" placeholder="Your Comment"></textarea>

                    <div class="py-3 text-end">
                        <button class="accordion-button collapsed btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $comment->id }}" aria-expanded="false" aria-controls="collapse{{ $comment->id }}">
                            Cancel
                        </button>
                        <button class="btn btn btn-dark text-white" type="submit"> Send </button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
</div>
