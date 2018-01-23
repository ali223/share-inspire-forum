<?php

namespace Tests\Feature;

use App\Admin;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_a_new_category()
    {
        $category = factory(Category::class)->make();

        $this->postJson('/admin/categories', $category->toArray())
            ->assertStatus(401);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }

    /** @test */
    public function authenticated_non_admin_users_cannot_add_a_new_category()
    {        
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $category = factory(Category::class)->make(['admin_id' => auth()->id()]);

        $this->postJson('/admin/categories', $category->toArray())
            ->assertStatus(401);

        $this->assertDatabaseMissing('categories', $category->toArray());        
    }

    /** @test */
    public function authenticated_admin_users_can_add_a_new_category()
    {
        $admin = factory(Admin::class)->create();
        $this->actingAs($admin, 'admin');

        $category = factory(Category::class)->make(['admin_id' => auth()->id()]);

        $this->postJson('/admin/categories', $category->toArray())
            ->assertStatus(200);

        $this->assertDatabaseHas('categories', $category->toArray());
    }

}
