<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $user = Auth::user()->name;
        $id = Auth::user()->id;
        $comments = Comment::orderBy('created_at')->get();

        return view('home', ['posts' => $posts, 'user' => $user, 'id' => $id, 'comments' => $comments]);
    }

    public function createPost(CreatePostRequest $request) {
        $id = Auth::user()->id;
        $post = new Post();
        $post->user_id = $id;
        $post->content = $request->content;
        $post->save();

        return back()->with('success', 'Post published!');
    }

    public function showPost($postId) {
        $post = Post::findOrFail($postId);
        $userId = $post->user_id;
        $postCreator = User::findOrFail($userId);
        $comments = $post->comments;

        return view('post', ['post' => $post, 'postCreator' => $postCreator, 'comments' => $comments]);
    }

    public function editPost(EditPostRequest $request, $postId) {
        $post = Post::findOrFail($postId);
        $post->content = $request->content;
        $post->save();

        return back()->with('success', 'Post edited!');
    }

    public function deletePost($postId) {
        $post = Post::findOrFail($postId);
        $post->delete();

        return redirect()->route('home')->with('alert', 'Post deleted!');
    }
}
