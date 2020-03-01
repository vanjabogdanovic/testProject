@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('components.alerts')

                <div class="card mb-5 shadow">
                    <div class="card-header">
                        <h5 class="card-title d-inline text-primary">
                            <a href="/profile/{{ $postCreator->id }}"> {{ $postCreator->name }}'s</a> post
                        </h5>
                        @if(Auth::user()->id == $postCreator->id)
                            <button type="button" class="close">
                                <form action="{{ route('delete_post', ['postId' => $post->id]) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-outline-danger float-right" value="&times;">
                                </form>
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="info-form mb-5">
                            @if($postCreator->id == \Illuminate\Support\Facades\Auth::user()->id)
                            <form action="" method="POST" class="info-form">
                                @csrf
                                <textarea name="content" class="form-control">{{ $post->content }}</textarea>
                                <input type="submit" name="edit" value="Edit post" class="btn btn-primary mt-1 mb-5 px-5 float-right">
                            </form>
                            @else
                                <div class="d-block mb-2 text-secondary">{{ $post->content }}</div>
                                <small class="text-info">Post created {{ $post->created_at->diffForHumans() }} </small>
                            @endif
                        </div>
                        @if(!empty($comments))
                            @foreach($comments as $comment)
                                @if($comment->post_id == $post->id)
                                    <div class="border border-info rounded p-3 mb-1">
                                        <span class="text-primary h5">
                                            <a href={{ route('profile', ['id' => $comment->user_id]) }}>{{ $comment->post->user->name }}</a>
                                        </span>
                                        <form action="{{ route('edit_comment', ['id' => $comment->id]) }}" method="POST">
                                            @csrf
                                            <textarea name="comment_content" class="mb-2 ml-2 text-secondary clearfix form-control">{{ $comment->comment_content }}</textarea>
                                            <input type="submit" value="Edit" class="btn btn-outline-secondary border-0 float-right mr-1">
                                        </form>
                                        <small class="text-info">Created {{ $comment->created_at->diffForHumans() }} </small>
                                        <form action="{{ route('delete_comment', ['id' => $comment->id]) }}" method="POST">
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-outline-danger border-0 float-right">
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
                                    <input type="submit" name="comment" value="Post" class="btn btn-primary mt-1 ml-1 px-5 float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
