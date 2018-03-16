<?php

namespace Tests\Unit;

use App\Topic;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TopicTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function it_belongs_to_a_user()
	{
		$topic = factory('App\Topic')->create();

		$this->assertInstanceOf('App\User', $topic->user);
	}

	/** @test */
	public function it_belongs_to_a_category()
	{
		$topic = factory('App\Topic')->create();

		$this->assertInstanceOf('App\Category', $topic->category);
	}

	/** @test */
	public function it_has_posts()
	{
		$topic = factory('App\Topic')->create();
		$posts = factory('App\Post', 3)->create(['topic_id' => $topic->id]);

		$this->assertInstanceOf('Illuminate\Support\Collection', $topic->posts);
		$this->assertContainsOnlyInstancesOf('App\Post', $topic->posts);
	}

	/** @test */
	public function it_returns_the_count_of_unapproved_topics()
	{
		$unapprovedTopics = factory('App\Topic', 3)->create(['approved' => 0]);
		$approvedTopics = factory('App\Topic', 3)->create(['approved' => 1]);

		$this->assertEquals($unapprovedTopics->count(), Topic::unapprovedCount());
	}

	/** @test */
	public function it_returns_latest_five_topics()
	{
		$newTopics = factory('App\Topic', 5)->create([
			'created_at' => Carbon::now()
		])->load('user');

		$oldTopics = factory('App\Topic', 5)->create([
			'created_at' => Carbon::now()->subDays(5)
		])->load('user');

		$latestTopics = Topic::getLatestTopics();

		$this->assertEquals($newTopics->toArray(), $latestTopics->toArray());
		$this->assertNotEquals($oldTopics->toArray(), $latestTopics->toArray());
	}

	/** @test */
	public function it_can_add_a_new_post()
	{
		Notification::fake();

		$topic = factory('App\Topic')->create();

		$postContent = "Test post content";
		$userId = 1;

		$post = $topic->addPost($postContent, $userId);

		$this->assertCount(1, $topic->posts);
	}

}
