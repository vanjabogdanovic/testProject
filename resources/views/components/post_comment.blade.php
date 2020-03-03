@if(!empty($post->comments))
    @foreach($post->comments as $comment)
        <div class="border bg-light rounded p-3 mb-1">
            <form action="{{ route('delete_comment', ['id' => $comment->id]) }}" method="POST">
                @csrf

                {{--Show user's image in comment--}}
                <span class="text-primary h5">
                    @include('components.user_img', ['postUser' => $comment->user])
                    <a href={{ route('profile', ['id' => $comment->user_id]) }}>{{ $comment->user->name }}</a>
                </span>

                {{--Show comment content and date--}}
                <span class="mb-2 ml-2 text-secondary clearfix">{{ $comment->comment_content }}</span>
                <small style="padding-left: 9%" class="text-info">Created {{ $comment->created_at->diffForHumans() }} </small>

                {{--Delete comment--}}
                @if($comment->user_id == Auth::user()->id)
                    <input type="submit" value="Delete" class="btn btn-outline-danger border-0 float-right">

                    {{--Edit comment--}}
                    <a href="{{ route('post', ['id' => $post->id]) }}" class="btn btn-outline-secondary border-0 float-right mr-1">
                        Edit
                    </a>
                @endif
            </form>
        </div>
    @endforeach
@endif

{{--Add comment--}}
@include('components.add_comment')