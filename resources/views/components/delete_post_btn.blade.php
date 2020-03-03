<button type="button" class="close">
    <form action="{{ route('delete_post', ['postId' => $post->id]) }}" method="POST">
        @csrf
        <input type="submit" class="btn btn-outline-danger btn-round mt-2 float-right" value="&times;">
    </form>
</button>