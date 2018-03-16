<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Post;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_like_any_post()
    {
        $this->postJson('posts/1/like')
            ->assertStatus(401);
    }    

    /** @test */
    public function an_authenticated_user_can_like_posts_by_other_users()
    {        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $otherUser = factory(User::class)->create();

        $postByOtherUser = factory(Post::class)->create([
            'user_id' => $otherUser->id
        ]);

        $this->postJson("posts/{$postByOtherUser->id}/like")
            ->assertStatus(200);

        $this->assertCount(1, $postByOtherUser->likes);
    }

    /** @test */
    public function an_authenticated_user_cannot_like_their_own_posts()
    {        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $postByUser = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        $this->postJson("posts/{$postByUser->id}/like")
            ->assertStatus(403);

        $this->assertCount(0, $postByUser->likes);
    }

    /** @test */
    public function an_authenticated_user_can_unlike_their_liked_post()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post = factory(Post::class)->create();

        $this->postJson("posts/{$post->id}/like")
            ->assertStatus(200);

        $this->assertCount(1, $post->likes);

        $this->deleteJson("posts/{$post->id}/like")
            ->assertStatus(200);

        $this->assertCount(0, $post->fresh()->likes);

    }
}
