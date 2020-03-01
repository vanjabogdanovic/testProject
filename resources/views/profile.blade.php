@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('components.alerts')

                <div class="card mb-5 shadow">
                    <div class="card-header">
                        <p class="text-primary h3"> {{ $user->name  }}'s Profile Information </p>
                    </div>
                    <div class="card-body">
                        @if($user->id != Auth::user()->id)
                            <div>
                                @if(!empty($profile->first_name))
                                    <p class="text-info">First name:</p>
                                    <p> {{ $profile->first_name }} </p>
                                    <hr>
                                @endif
                                @if(!empty($profile->last_name))
                                        <p class="text-info">Last name:</p>
                                        <p> {{ $profile->last_name }} </p>
                                        <hr>
                                    @endif

                                @if(!empty($profile->dob))
                                        <p class="text-info">Date of birth:</p>
                                        <p> {{ $profile->dob }} </p>
                                        <hr>
                                    @endif

                                @if(!empty($profile->gender))
                                        <p class="text-info">Gender:</p>
                                        <p> {{ $profile->gender }} </p>
                                        <hr>
                                    @endif

                                @if(!empty($profile->bio))
                                        <p class="text-info">Biography:</p>
                                        <p> {{ $profile->bio }} </p>
                                        <hr>
                                    @endif

                                @if(empty($profile))
                                    <p>Nothing to show!</p>
                                @endif
                            </div>
                        @else
                            <div class="info-form">
                                <form action="" method="post">
                                    @csrf
                                    <label for="first_name" class="text-info label">First Name:</label>
                                    <input type="text" name="first_name" class="form-control mb-2"
                                           value="{{ $user->profile ? $user->profile->first_name : "" }}">

                                    <label for="last_name" class="text-info label">Last Name:</label>
                                    <input type="text" name="last_name" class="form-control mb-2"
                                           value="{{ $user->profile ? $user->profile->last_name : "" }}">

                                    <label for="dob" class="text-info label">Date of brith:</label>
                                    <input type="date" name="dob" class="form-control mb-2"
                                           value="{{ $user->profile ? $user->profile->dob : "" }}">

                                    <label for="gender" class="text-info label d-block">Gender:</label>
                                    <input type="radio" name="gender" value="female" class="form-check-inline ml-3"
                                           @if(!empty($info->gender) && $info->gender == 'female') checked @endif >
                                    <span class="text-secondary">Female</span>
                                    <input type="radio" name="gender" value="male" class="form-check-inline ml-3"
                                           @if(!empty($info->gender) && $info->gender == 'male') checked @endif >
                                    <span class="text-secondary">Male</span>
                                    <input type="radio" name="gender" value="other" class="form-check-inline ml-3"
                                           @if(!empty($info->gender) && $info->gender == 'other') checked @endif >
                                    <span class="text-secondary">Other</span>
                                    <input type="radio" name="gender" value="none" class="form-check-inline ml-3"
                                           @if(empty($info->gender)) checked @endif >
                                    <span class="text-secondary">None</span>

                                    <label for="bio" class="text-info label d-block mt-1">Biography:</label>
                                    <textarea name="bio" class="form-control mb-2">{{ $user->profile ? $user->profile->bio : "" }}</textarea>

                                    <label for="img" class="text-info label d-block mt-1">Upload image:</label>
                                    <input type="file" name="img" class="form-control-file">

                                    <input type="submit" value="Update" class="btn btn-outline-secondary float-right">
                                </form>
                            </div>
                         @endif
                    </div>
                </div>

                @if($posts)
                    @foreach($posts as $post)
                        <div class="card mb-4 shadow">
                            <div class="card-header text-primary">
                                <h5 class="card-title d-inline text-primary">
                                    <a href="/profile/{{ $post->user->id }}"> {{ $post->user->name }}'s </a>
                                    <a href="/post/{{ $post->id }}"> post </a>
                                </h5>
                                @if(Auth::user()->id == $post->user_id)
                                    <button type="button" class="close">
                                        <form action="{{ route('delete_post', ['postId' => $post->id]) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-outline-danger float-right" value="&times;">
                                        </form>
                                    </button>
                                @endif
                            </div>
                            <div class="card-body text-secondary">
                                <div class="mb-5">
                                    <p class="text-secondary">{{ $post->content }}</p>
                                    <small class="text-info">Post created {{ $post->created_at->diffForHumans() }} </small>
                                    @if(Auth::user()->id == $post->user_id)
                                        <a class="btn btn-outline-secondary mt-1 mb-1 px-5 float-right" href={{ route('post', ['id' => $post->id]) }}>Edit</a>
                                    @endif
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
                                                    <a href="" class="btn btn-outline-secondary border-0 float-right mr-1">Edit</a>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="info-form mt-3">
                                    <form action="/home/{{ $post->id }}" method="POST" class="info-form">
                                        @csrf
                                        <div class="input-group">
                                            <textarea name="comment_content" class="form-control" placeholder="Add comment..." rows="1"></textarea>
                                            <input type="submit" name="comment" value="Post" class="btn btn-outline-primary mt-1 ml-1 px-5 float-right">
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
