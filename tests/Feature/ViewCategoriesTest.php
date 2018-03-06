<?php

namespace Tests\Feature;

use App\Category;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_all_categories_on_the_home_page()
    {
        $categories = factory(Category::class, 2)->create();

        $this->get('/')
            ->assertSee($categories[0]->name)
            ->assertSee($categories[0]->description)
            ->assertSee($categories[1]->name)            
            ->assertSee($categories[1]->description);
    }
}
