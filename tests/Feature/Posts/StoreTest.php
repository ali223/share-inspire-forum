<?php

namespace Tests\Feature\Posts;

use App\Events\NewPostCreated;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;

    /** @test */
    public function guests_cannot_add_new_posts()
    {
        $topic = factory(Topic::class)->create();

        $postData = [
            'content' => $this->faker->paragraph,
            'topic_id' => $topic->id
        ];

        $this->postJson(route('posts.store', $topic), $postData)
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('posts', $postData);
    }

    /** @test */
    public function non_admin_users_can_add_new_posts()
    {
        Event::fake();

        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();

        $postData = [
            'content' => $this->faker->paragraph,
            'topic_id' => $topic->id
        ];

        $this->actingAs($user)
            ->postJson(route('posts.store', $topic), $postData)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('posts', [
            'content' => $postData['content'],
            'topic_id' => $postData['topic_id'],
            'user_id' => $user->id
        ]);

        Event::assertDispatched(NewPostCreated::class);
    }
}
