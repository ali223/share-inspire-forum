<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
	use RefreshDatabase;

	protected $post;

	public function setUp()
	{
		parent::setUp();

		$this->post = factory('App\Post')->create();
	}

	/** @test */
	public function it_belongs_to_a_user()
	{
		$this->assertInstanceOf('App\User', $this->post->user);
	}

	/** @test */
	public function it_belongs_to_a_topic()
	{
		$this->assertInstanceOf('App\Topic', $this->post->topic);
	}

	/** @test */
	public function it_can_return_all_posts_which_belong_to_an_approved_topic()
	{
		$unapprovedTopic = factory('App\Topic')->create(['approved' => 0]);
		$postsInUnapprovedTopic = factory('App\Post', 3)->create([
			'topic_id' => $unapprovedTopic->id
		]);

		$approvedTopic = factory('App\Topic')->create(['approved' => 1]);
		$postsInApprovedTopic = factory('App\Post', 3)->create([
			'topic_id' => $approvedTopic->id
		]);

		$retrievedPosts = Post::belongingToApprovedTopic()->get();

		$this->assertEquals(
			$postsInApprovedTopic->toArray(),
			$retrievedPosts->toArray()
		);

		$this->assertNotEquals(
			$postsInUnapprovedTopic->toArray(),
			$retrievedPosts->toArray()
		);
	}
}
