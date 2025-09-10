<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Mail\CommentAddedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $request->validate(['content' => 'required|string']);

        $comment = Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        Mail::to($post->user->email)
            ->send(new CommentAddedMail($comment));

        Mail::to(env('ADMIN_EMAIL', 'mohamedfathymo66@gmail.com'))
            ->send(new CommentAddedMail($comment));

        return redirect()->back()->with('success', 'Comment added and emails sent');
    }

    public function destroy(Comment $comment)
    {
        // $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted!');
    }
}
