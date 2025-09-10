<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/v1/api/posts', [
                'title'   => 'My Test Post',
                'content' => 'This is a test post content',
            ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'My Test Post']);
    }

    public function user_can_view_posts()
    {
        Post::factory()->count(3)->create();

        $response = $this->getJson('/v1/api/posts');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function user_can_update_their_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/v1/api/posts/{$post->id}", [
                'title'   => 'Updated Title',
                'content' => 'Updated Content',
            ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Title']);
    }

    public function user_can_delete_their_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/v1/api/posts/{$post->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
