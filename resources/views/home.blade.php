@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('components.alerts')

            <div class="card mb-3 shadow">
                <div class="card-header bg-primary text-white">New Post:</div>
                <div class="card-body">
                    <div class="info-form">

                        {{--Create new post--}}
                        <form action="{{ route('create_post') }}" method="POST" class="info-form">
                            @csrf
                            <div class="input-group mb-3">
                                <textarea type="text" name="post_content" class="form-control" aria-describedby="basic-addon2" placeholder="What's on your mind...">
                                </textarea>
                                <div class="input-group-append">
                                    <button name="post" class="btn btn-primary" type="submit">Post</button>
                                </div>
                            </div>

                            {{--Select category--}}
                            <p class="text-info">Select categories:</p>
                            @foreach($categoriesAll as $category)
                                <button type="button" class="btn btn-sm btn-labeled btn-info ml-1">
                                    <span class="btn-label text-white pl-2 pt-2">
                                        <input class="form-check-inline" type="checkbox" name="categories[]" value="{{ $category->id }}">
                                    </span>
                                    <span class="text-white">{{ $category->name }}</span>
                                </button>
                            @endforeach
                        </form>

                    </div>
                </div>
            </div>

            <!-- Select category dropdown menu -->
            <div class="card mb-3 shadow">
            <div class="form-group d-block">
                <form action="{{ route('home') }}" method="GET">
                    @csrf
                    <input type="submit" value="Search" class="btn btn-outline-primary float-right mt-2 mr-2">
                    <div class="button-group d-inline float-right">

                        <button type="button" class="btn btn-default btn-outline-secondary dropdown-toggle mt-2 mr-2" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-cog">Select category</span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($categoriesAll as $category)
                                <li class="form-check">
                                    <label class="form-check-label" data-value="{{ $category->id }}">
                                        <input type="checkbox" name="selectCategories[]" value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </form>
            </div>
            </div>

            {{--Show posts--}}
            @if($posts)
                @foreach($posts as $post)
                    <div class="card mb-4 shadow">
                        <div class="card-header">

                            {{--Show post header--}}
                            @include('components.post_header', ['postUser' => $post->user])

                            {{--Delete post--}}
                            @if(Auth::user()->id == $post->user_id)
                                @include('components.delete_post_btn')
                            @endif

                            {{--Edit post--}}
                            @if(Auth::user()->id == $post->user_id)
                                <a class="btn btn-outline-secondary edit-btn float-right"
                                   href="{{ route('post', ['id' => $post->id]) }}"
                                   data-toggle="tooltip" data-placement="top" title="Edit post">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif

                        </div>

                        <div class="card-body">

                            {{--Show post content--}}
                            @include('components.post_content')

                            {{--Show post comments--}}
                            @include('components.post_comment')

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
