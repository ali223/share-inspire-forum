<?php

namespace Tests\Feature;

use App\Category;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTopicsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_all_approved_topics_within_a_category()
    {
        $category = factory(Category::class)->create();
        $topics = factory(Topic::class, 2)->create([
            'approved' => 1,
            'category_id' => $category->id
        ]);

        $this->get("/categories/{$category->id}/topics")
            ->assertSee($topics[0]->title)
            ->assertSee($topics[1]->title);
    }

    /** @test */
    public function guests_cannot_view_unapproved_topics_within_a_category()
    {
        $category = factory(Category::class)->create();

        $unapprovedTopics = factory(Topic::class, 2)->create([
            'approved' => 0,
            'category_id' => $category->id
        ]);

        $this->get("/categories/{$category->id}/topics")
            ->assertDontSee($unapprovedTopics[0]->title)
            ->assertDontSee($unapprovedTopics[1]->title);
    }


    /** @test */
    public function authenticated_users_can_also_view_their_unapproved_topics_within_a_category()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $category = factory(Category::class)->create();

        $approvedTopic = factory(Topic::class)->create([
            'approved' => 1,
            'category_id' => $category->id
        ]);

        $unapprovedTopic = factory(Topic::class)->create([
            'approved' => 0,
            'category_id' => $category->id,
            'user_id' => auth()->id()
        ]);

        $this->get("/categories/{$category->id}/topics")
            ->assertSee($approvedTopic->title)
            ->assertSee($unapprovedTopic->title);
    }
}
