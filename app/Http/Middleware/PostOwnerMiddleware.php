<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;
use Illuminate\Support\Facades\Auth;

class PostOwnerMiddleware {

    public function handle($request, Closure $next) {

        $id = $request->id;
        $userId = Auth::user()->id;
        $post = Post::find($id);
        if($post) {
            if($post->user_id == $userId) {
                return $next($request);
            }
        }
        return back()->with('alert', 'Unauthorized');
    }
}
