@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('components.alerts')

                <div class="card mb-5 shadow">
                    <div class="card-header">

                        {{--Show post header--}}
                        @include('components.post_header', ['postUser' => $post->user])

                        {{--Delete post--}}
                        @if(Auth::user()->id == $post->user->id)
                            @include('components.delete_post_btn')
                        @endif

                    </div>

                    {{--Edit post content--}}
                    <div class="card-body">
                        <div class="info-form mb-5">

                            @if($post->user->id == Auth::user()->id)
                            <form action="{{ route('edit_post', ['id' => $post->id]) }}" method="POST" class="info-form">
                                @csrf
                                <div class="input-group mb-3">
                                    <textarea type="text" name="post_content" class="form-control" aria-describedby="basic-addon2">{{ $post->content }}</textarea>
                                    <div class="input-group-append">
                                        <button name="edit" class="btn btn-secondary" type="submit">Edit post</button>
                                    </div>
                                </div>

                                {{--Edit categories--}}
                                @foreach($categoriesAll as $category)
                                    <button type="button" class="btn btn-sm btn-labeled btn-info ml-1">
                                    <span class="btn-label text-white pl-2 pt-2">
                                        <input class="form-check-inline" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        @foreach($post->categories as $categoryPost)
                                            @if($categoryPost->id == $category->id)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                    </span>
                                        <span class="text-white">{{ $category->name }}</span>
                                    </button>
                                @endforeach
                            </form>
                            @else
                                <div class="d-block mb-2 text-secondary">{{ $post->content }}</div>
                                <small class="text-info">Post created {{ $post->created_at->diffForHumans() }} </small>
                            @endif

                        </div>

                        {{--Show post's comments--}}
                        @if(!empty($post->comments))
                            @foreach($post->comments as $comment)
                                <div class="border bg-light rounded p-3 mb-1">

                                    {{--Show user's image in comment--}}
                                    <span class="text-primary h5 d-inline">
                                        @include('components.user_img', ['postUser' => $comment->user])
                                        <a href={{ route('profile', ['id' => $comment->user_id]) }}>{{ $comment->user->name }}</a>
                                    </span>

                                    {{--Delete comment--}}
                                    @if($comment->user_id == Auth::user()->id)
                                        <button type="button" class="close">
                                            <form action="{{ route('delete_comment', ['id' => $comment->id]) }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn btn-outline-danger btn-round" value="&times;">
                                            </form>
                                        </button>
                                    @endif

                                    {{--Edit comment content--}}
                                    @if($comment->user_id == Auth::user()->id)
                                        <form action="{{ route('edit_comment', ['id' => $comment->id]) }}" method="POST" class="mt-2">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <textarea type="text" class="form-control" aria-describedby="basic-addon2" name="comment_content">{{ $comment->comment_content }}</textarea>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="submit">Edit</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <span class="mb-2 ml-2 text-secondary clearfix">{{ $comment->comment_content }}</span>
                                    @endif
                                    <small class="text-info"> Created {{ $comment->created_at->diffForHumans() }} </small>

                                </div>
                            @endforeach
                        @endif

                        {{--Add comment--}}
                        @include('components.add_comment')

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
