@include('components.user_img', ['postUser' => $postUser])
<h5 class="card-title d-inline text-primary">
    <a href="{{ route('profile', ['id' => $postUser->id]) }}"> {{ $postUser->name }}'s </a>
    <a href="{{ route('post', ['id' => $post->id]) }}"> post </a>
</h5>