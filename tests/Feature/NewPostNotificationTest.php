<?php

namespace Tests\Feature;

use App\Events\NewPostCreated;
use App\Notifications\NewPostInYourTopic;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NewPostNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        Event::fake();
        Notification::fake();
    }

    /** @test */
    public function the_topic_creator_gets_notified_when_a_new_post_is_added_by_another_user()
    {
        $topicCreator = factory(User::class)->create();
        $topic = factory(Topic::class)->create(['user_id' => $topicCreator->id]);

        $anotherUser = factory(User::class)->create();
        $this->actingAs($anotherUser);

        $post = factory(Post::class)->make(['topic_id' => $topic->id]);

        $response = $this->postJson("topics/{$topic->id}/posts", $post->toArray());
        $response->assertStatus(200);

        Notification::assertSentTo($topicCreator, NewPostInYourTopic::class);
    }

    /** @test */
    public function the_topic_creator_does_not_get_notified_when_he_adds_a_new_post_himself()
    {
        $topicCreator = factory(User::class)->create();
        $this->actingAs($topicCreator);

        $topic = factory(Topic::class)->create(['user_id' => auth()->id()]);

        $post = factory(Post::class)->make(['topic_id' => $topic->id]);

        $response = $this->postJson("topics/{$topic->id}/posts", $post->toArray());
        $response->assertStatus(200);

        Notification::assertNotSentTo($topicCreator, NewPostInYourTopic::class);

    }
}
