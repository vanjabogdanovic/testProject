<?php

namespace App\Http\Middleware;

use App\Comment;
use Closure;
use Illuminate\Support\Facades\Auth;

class CommentOwnerMiddleware {

    public function handle($request, Closure $next) {

        $id = $request->id;
        $comment = Comment::find($id);
        $userId = Auth::user()->id;
        if($comment) {
            if ($comment->user_id == $userId) {
                return $next($request);
            }
        }
        return back()->with('alert', 'Unauthorized');
    }
}
