<div class="row row-xs form-group-wrapper">

    <form action="{{ route('comment.store') }}" method="post" class="col-12" >
        @csrf
        @method('POST')

        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
        <input type="hidden" name="blog_id" value="{{ $blog->id }}">

        <div class="col-md-12">
            <div class="main-form-group my-1">
                <label for="name" class="form-label mb-1">Name</label>
                <input class="form-control border-0 input-focus" id="name" name="name" placeholder="Name" type="text">
            </div>
        </div>
        <div class="col-md-12">
            <div class="main-form-group my-1">
                <label for="mail" class="form-label mb-1">Mail</label>
                <input class="form-control border-0 input-focus" id="email" name="email" placeholder="Mail" type="email">
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="main-form-group">
                <label for="message" class="form-label mb-1">Message</label>
                <textarea name="comment" id="comment" class="form-control text-area border-0 input-focus" placeholder="Message" rows="3" required></textarea>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <button class="btn btn-dark text-white float-end" type="submit">Submit</button>
        </div>

    </form>

</div>
