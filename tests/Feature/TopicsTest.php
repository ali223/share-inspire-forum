<?php

namespace Tests\Feature;

use App\Category;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TopicsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    
    public function guests_cannot_create_new_topics()
    {
        $category = factory(Category::class)->create();

        $response = $this->get("/categories/{$category->id}/topics/create");
        $response->assertRedirect('/login');

        $response = $this->post("/categories/{$category->id}/topics");
        $response->assertRedirect('/login');
    }

    /** @test */

    public function an_authenticated_user_can_create_new_topics()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $category = factory(Category::class)->create();

        $topic = factory(Topic::class)->make(
            ['category_id' => $category->id]
        );

        $topic['content'] = 'test content';

        $response = $this->get("/categories/{$category->id}/topics/create");
        $response->assertSuccessful();


        $response = $this->post("/categories/{$category->id}/topics", $topic->toArray());

        $this->assertDatabaseHas('topics', [
                'title' => $topic->title,
                'category_id' => $category->id,
                'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
                'content' => 'test content'
        ]);

    }


}
