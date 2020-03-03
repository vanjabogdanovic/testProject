@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('components.alerts')

                <div class="card mb-5 shadow">
                    <div class="card-header">

                        {{--Profile header--}}
                        <div class="position-relative">
                            @if($user->profile->img_url != null && Auth::user()->id == $user->id)
                                <button type="button" class="close position-absolute ml-2"
                                        data-toggle="tooltip" data-placement="top" title="Delete image">
                                    <form action="{{ route('delete_img', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger btn-round mt-2" value="&times;">
                                    </form>
                                </button>
                            @endif
                            <img style="width:150px; height: 150px; border-radius: 20%;" class="" src="{{url('uploads/'.$user->profile->img_url)}}"
                                 onerror="this.onerror=null;this.src='../img/default.png';">
                            <p class="text-primary h3 d-inline ml-3"> {{ $user->name  }}'s Profile Information </p>
                        </div>

                    </div>
                    <div class="card-body">

                        {{--Profile information--}}
                        @if($user->id != Auth::user()->id)
                            @include('components.profile_info')

                        {{--Edit profile information--}}
                        @else
                            @include('components.edit_info')
                        @endif

                    </div>
                </div>

                @if($user->posts)
                    @foreach($user->posts as $post)
                        <div class="card mb-4 shadow">
                            <div class="card-header text-primary">

                                {{--Show post header--}}
                                @include('components.post_header', ['postUser' => $user])

                                {{--Delete post--}}
                                @if(Auth::user()->id == $post->user_id)
                                    @include('components.delete_post_btn')
                                @endif

                                {{--Edit post--}}
                                @if(Auth::user()->id == $post->user_id)
                                    <a class="btn btn-outline-secondary mr-1 px-5 float-right" href={{ route('post', ['id' => $post->id]) }}>Edit</a>
                                @endif

                            </div>

                            {{--Show post content--}}
                            <div class="card-body">

                                @include('components.post_content')

                                {{--Show post's comments--}}
                                @include('components.post_comment')

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
