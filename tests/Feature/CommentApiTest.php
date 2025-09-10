<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentApiTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_add_comment_to_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson("/v1/api/posts/{$post->id}/comments", [
                'content' => 'This is a test comment',
            ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['content' => 'This is a test comment']);
    }

    public function user_can_delete_their_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->for($user)->create();

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/v1/api/comments/{$comment->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
