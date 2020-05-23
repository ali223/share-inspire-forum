<?php

namespace Tests\Feature\Posts;

use App\Events\NewPostCreated;
use App\Notifications\NewPostInYourTopic;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;

    protected function setUp()
    {
        parent::setUp();

        Event::fake();
        Notification::fake();
    }

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
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();

        $postData = [
            'content' => $this->faker->paragraph,
            'topic_id' => $topic->id
        ];

        $this->actingAs($user)
            ->postJson(route('posts.store', $topic), $postData)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('posts', [
            'content' => $postData['content'],
            'topic_id' => $postData['topic_id'],
            'user_id' => $user->id
        ]);

        Event::assertDispatched(NewPostCreated::class);
    }

    /** @test */
    public function the_topic_creator_gets_notified_when_a_new_post_is_added_by_another_user()
    {
        $topicCreator = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $topic = factory(Topic::class)->create([
            'user_id' => $topicCreator->id
        ]);

        $postData = [
            'content' => $this->faker->paragraph,
            'topic_id' => $topic->id
        ];

        $this->actingAs($anotherUser)
            ->postJson(route('posts.store', $topic), $postData)
            ->assertStatus(Response::HTTP_CREATED);

        Notification::assertSentTo($topicCreator, NewPostInYourTopic::class);
    }

    /** @test */
    public function the_topic_creator_does_not_get_notified_when_they_add_a_new_post_themselves()
    {
        $topicCreator = factory(User::class)->create();

        $topic = factory(Topic::class)->create([
            'user_id' => $topicCreator->id
        ]);

        $postData = [
            'content' => $this->faker->paragraph,
            'topic_id' => $topic->id
        ];

        $this->actingAs($topicCreator)
            ->postJson(route('posts.store', $topic), $postData)
            ->assertStatus(Response::HTTP_CREATED);

        Notification::assertNotSentTo($topicCreator, NewPostInYourTopic::class);
    }
}
