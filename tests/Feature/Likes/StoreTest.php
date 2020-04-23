<?php

namespace Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_like_any_post()
    {
        $post = factory(Post::class)->create();

        $this->postJson(route('likes.store', $post))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function non_admin_users_can_like_posts_by_other_users()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();

        $postByOtherUser = factory(Post::class)->create([
            'user_id' => $otherUser->id
        ]);

        $this->actingAs($user)
            ->postJson(route('likes.store', $postByOtherUser))
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $postByOtherUser->id,
            'likeable_type' => $postByOtherUser->getMorphClass()
        ]);
    }

    /** @test */
    public function non_admin_users_cannot_like_their_own_posts()
    {
        $user = factory(User::class)->create();

        $postByUser = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->postJson(route('likes.store', $postByUser))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'likeable_id' => $postByUser->id,
            'likeable_type' => $postByUser->getMorphClass()
        ]);
    }
}
