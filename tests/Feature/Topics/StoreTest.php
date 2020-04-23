<?php

namespace Tests\Feature\Topics;

use App\Category;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;

    /** @test */
    public function guests_cannot_add_new_topics()
    {
        $category = factory(Category::class)->create();

        $topicData = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'category_id' => $category->id,
        ];

        $this->post(route('topics.store', $category), $topicData)
            ->assertRedirect(route('sessions.create'));

        $this->assertDatabaseMissing('topics', [
            'title' => $topicData['title'],
            'category_id' => $topicData['category_id']
        ]);
    }

    /** @test */
    public function non_admin_users_can_add_new_topics()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $topicData = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'category_id' => $category->id,
        ];

        $this->actingAs($user)
            ->post(route('topics.store', $category), $topicData)
            ->assertRedirect(route('topics.index', $category))
            ->assertSessionMissing('errors');

        $this->assertDatabaseHas('topics', [
            'title' => $topicData['title'],
            'category_id' => $topicData['category_id'],
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => $topicData['content']
        ]);
    }
}
