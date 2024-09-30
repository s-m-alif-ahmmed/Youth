<div class="accordion-item col-12">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed btn-sm btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $comment->id }}" aria-expanded="false" aria-controls="collapse{{ $comment->id }}">
            <span class="badge badge-sm btn btn-primary text-white rounded-pill py-2 my-2 px-3"><i class="fe fe-corner-up-left text-black me-1"></i>Reply</span>
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
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <button class="accordion-button collapsed btn bg-danger text-white text-center ps-3 py-2 rounded-2" style="width: 100px !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $comment->id }}" aria-expanded="false" aria-controls="collapse{{ $comment->id }}">
                                    Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn bg-dark btn-sm text-white" type="submit"> Send </button>
                            </div>
                        </div>

                    </div>
                </form>
            @endauth
        </div>
    </div>
</div>
