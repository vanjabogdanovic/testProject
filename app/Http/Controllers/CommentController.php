<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\EditCommentRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    public function createComment(CreateCommentRequest $request, $id) {
        if(Post::findOrFail($id)) {
            $userId = Auth::user()->id;
            $comment = new Comment();
            $comment->comment_content = $request->comment_content;
            $comment->user_id = $userId;
            $comment->post_id = $id;
            $comment->save();
        }

        return back()->with('success', 'Comment successfully published!');
    }

    public function editComment(EditCommentRequest $request, $id) {
        $comment = Comment::findOrFail($id);
        $comment->comment_content = $request->comment_content;
        $comment->save();

        return back()->with('success', 'Comment successfully edited!');
    }

    public function deleteComment($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment successfully deleted!');
    }
}
