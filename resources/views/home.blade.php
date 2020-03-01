@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('components.alerts')

            <div class="card mb-5 shadow border border-primary">
                <div class="card-header bg-primary text-white">New Post:</div>
                <div class="card-body">
                    <div class="info-form">
                        <form action="/home" method="POST" class="info-form">
                            @csrf
                            <textarea name="content" class="form-control" placeholder="What's on your mind..."></textarea>
                            <input type="submit" name="post" value="Post" class="btn btn-primary mt-1 px-5 float-right">
                        </form>
                    </div>
                </div>
            </div>

            @if($posts)
                @foreach($posts as $post)
                    <div class="card mb-4 shadow">
                        <div class="card-header">
                            <h5 class="card-title d-inline text-primary">
                                <a href="/profile/{{ $post->user->id }}"> {{ $post->user->name }}'s </a>
                                <a href="/post/{{ $post->id }}"> post </a>
                            </h5>
                            @if($id == $post->user_id)
                                <button type="button" class="close">
                                    <form action="{{ route('delete_post', ['postId' => $post->id]) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-outline-danger float-right" value="&times;">
                                    </form>
                                </button>
                            @endif
                            @if($id == $post->user_id)
                                <a class="btn btn-outline-secondary mb-1 mr-1 px-5 float-right" href={{ route('post', ['id' => $post->id]) }}>Edit</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="mb-3 ml-3">
                                <div class="d-block mb-2 text-secondary">{{ $post->content }}</div>
                                <small class="text-info">Post created {{ $post->created_at->diffForHumans() }} </small>
                            </div>

                            @if(!empty($comments))
                                @foreach($comments as $comment)
                                    @if($comment->post_id == $post->id)
                                        <div class="border border-info rounded p-3 mb-1">
                                            <form action="{{ route('delete_comment', ['id' => $comment->id]) }}" method="POST">
                                                @csrf
                                                <span class="text-primary h5">
                                                    <a href={{ route('profile', ['id' => $comment->user_id]) }}>{{ $comment->post->user->name }}</a>
                                                </span>
                                                <span class="mb-2 ml-2 text-secondary clearfix">{{ $comment->comment_content }}</span>
                                                <small class="text-info">Created {{ $comment->created_at->diffForHumans() }} </small>
                                                <input type="submit" value="Delete" class="btn btn-outline-danger border-0 float-right">
                                                <a href="post\{{ $post->id }}" class="btn btn-outline-secondary border-0 float-right mr-1">
                                                    Edit
                                                </a>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="info-form mt-4">
                                <form action="/home/{{ $post->id }}" method="POST" class="info-form">
                                    @csrf
                                    <div class="input-group">
                                        <textarea name="comment_content" class="form-control" placeholder="Add comment..." rows="1"></textarea>
                                        <input type="submit" name="comment" value="Add comment" class="btn btn-primary mt-1 ml-1 px-5 float-right">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
