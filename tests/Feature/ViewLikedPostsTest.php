<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Post;

class ViewLikedPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_a_list_of_posts_liked_by_them()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $notLikedPosts = factory(Post::class, 2)->create();
        $likedPosts = factory(Post::class, 2)->create();

        $likedPosts[0]->markAsLikedBy(auth()->id());
        $likedPosts[1]->markAsLikedBy(auth()->id());

        $this->get('/likedposts')
            ->assertSee($likedPosts[0]->content)
            ->assertSee($likedPosts[1]->content);
    }
}
