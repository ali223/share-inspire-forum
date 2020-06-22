<?php

namespace Tests\Feature\LikedPosts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Post;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_admin_users_can_view_a_list_of_posts_liked_by_them()
    {
        $user = factory(User::class)->create();

        $notLikedPosts = factory(Post::class, 2)->create();
        $likedPosts = factory(Post::class, 2)->create();

        $likedPosts[0]->markAsLikedBy($user->id);
        $likedPosts[1]->markAsLikedBy($user->id);

        $this->actingAs($user)
            ->get(route('liked-posts.index'))
            ->assertSee($likedPosts[0]->content)
            ->assertSee($likedPosts[1]->content);
    }
}
