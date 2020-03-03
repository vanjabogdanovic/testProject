<button type="button" class="close"
        data-toggle="tooltip" data-placement="top" title="Delete post">
    <form action="{{ route('delete_post', ['id' => $post->id]) }}" method="POST">
        @csrf
        <input type="submit" class="btn btn-outline-danger btn-round mt-2 float-right" value="&times;">
    </form>
</button>