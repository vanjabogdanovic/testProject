<div class="info-form mt-4">
    <form action="{{ route('create_comment', ['id' => $post->id]) }}" method="POST" class="info-form">
        @csrf
        <div class="input-group mb-3">
            <textarea type="text" name="comment_content" class="form-control" aria-describedby="basic-addon2" rows="1"></textarea>
            <div class="input-group-append">
                <button name="comment" class="btn btn-primary" type="submit">Add comment</button>
            </div>
        </div>
    </form>
</div>