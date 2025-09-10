<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user', 'comments')->latest()->get();
    }

    public function show(Post $post)
    {
        return $post->load('user', 'comments');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $request->user()->posts()->create($data);

        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            return response()->json(
                [
                    'message' => 'Unauthorized'
                ],

                403
            );
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($data);

        return response()->json([$post , 'message' => 'Post Updated']);
    }

    public function destroy(Request $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            return response()->json(
                [
                    'message' => 'Unauthorized'
                ],
                403
            );
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
