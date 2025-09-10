<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([

            'content' => 'required|string'
        ]);

        $comment = $post->comments()->create([
            'content' => $data['content'],
            'user_id' => $request->user()->id
        ]);

        return response()->json($comment, 201);
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ($comment->user_id !== $request->user()->id) {
            return response()->json(
                [
                    'message' => 'Unauthorized'
                ],
                403
            );
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
