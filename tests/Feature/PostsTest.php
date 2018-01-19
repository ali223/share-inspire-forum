<?php

namespace Tests\Feature;

use App\Events\NewPostCreated;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    
    public function guests_cannot_create_new_posts()
    {    
        $topic = factory(Topic::class)->create();
        $post = factory(Post::class)->make(['topic_id' => $topic->id]);

        $response = $this->postJson("topics/{$topic->id}/posts", $post->toArray());
        $response->assertStatus(401);

        $this->assertDatabaseMissing('posts', ['topic_id' => $topic->id]);
    }

    /** @test */

    public function an_authenticated_user_can_create_new_posts()
    {
        Event::fake();
        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $topic = factory(Topic::class)->create();
        $post = factory(Post::class)->make(['topic_id' => $topic->id]);

        $response = $this->postJson("topics/{$topic->id}/posts", $post->toArray());
        $response->assertStatus(200);

        $this->assertDatabaseHas('posts', [
            'content' => $post->content,
            'topic_id' => $topic->id,
            'user_id' => 1
        ]);

        Event::assertDispatched(NewPostCreated::class);
    }
}
