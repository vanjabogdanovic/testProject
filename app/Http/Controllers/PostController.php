<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    public function index(Request $request) {
        if($request->selectCategories) {
            $posts = Post::select('posts.id', 'posts.content', 'posts.created_at', 'posts.user_id')
                ->join('category_post', 'posts.id', '=', 'category_post.post_id')
                ->join('categories', 'category_post.category_id', '=', 'categories.id')
                ->whereIn('categories.id', $request->selectCategories)
                ->orderBy('posts.created_at', 'desc')
                ->get();
        } else {
            $posts = Post::orderBy('created_at', 'desc')->get();
        }
        $categoriesAll = Category::orderBy('name')->get();

        return view('home', [
            'posts' => $posts,
            'categoriesAll' => $categoriesAll,
        ]);
    }

    public function createPost(CreatePostRequest $request) {
        $id = Auth::user()->id;
        $post = new Post();
        $post->user_id = $id;
        $post->content = $request->post_content;
        $post->save();

        $categories = $request->categories;
        foreach($categories as $category) {
            $post->categories()->attach($category, ['post_id' => $post->id, 'category_id' => $category]);
        }

        return back()->with('success', 'Post successfully published!');
    }

    public function showPost($postId) {
        $post = Post::findOrFail($postId);
        $categoriesAll = Category::orderBy('name')->get();

        return view('post', [
            'post' => $post,
            'categoriesAll' => $categoriesAll,
        ]);
    }

    public function editPost(EditPostRequest $request, $id) {
        $post = Post::findOrFail($id);
        $post->content = $request->post_content;
        $post->save();

        $post->categories()->sync($request->categories);

        return back()->with('success', 'Post successfully edited!');
    }

    public function deletePost($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('home')->with('success', 'Post successfully deleted!');
    }
}
