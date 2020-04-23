<?php

namespace Tests\Feature\Likes;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_admin_users_can_unlike_their_liked_post()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post = factory(Post::class)->create();

        $this->postJson(route('likes.store', $post))
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => $post->getMorphClass()
        ]);

        $this->deleteJson(route('likes.destroy', $post))
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => $post->getMorphClass()
        ]);
    }
}
