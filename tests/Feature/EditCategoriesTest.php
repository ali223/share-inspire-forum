<?php

namespace Tests\Feature;

use App\Admin;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_edit_a_category()
    {
        $category = factory(Category::class)->create();

        $updatedData = [
            'name' => 'updated name',
            'description' => 'updated description'              
        ];

        $this->patchJson("/admin/categories/{$category->id}", $updatedData)
            ->assertStatus(401);

        $this->assertDatabaseMissing('categories', $updatedData);

    }

    /** @test */
    public function authenticated_non_admin_users_cannot_edit_a_category()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $this->actingAs($user);

        $updatedData = [
            'name' => 'updated name',
            'description' => 'updated description'              
        ];

        $this->patchJson("/admin/categories/{$category->id}", $updatedData)
            ->assertStatus(401);

        $this->assertDatabaseMissing('categories', $updatedData);
    }

    /** @test */
    public function authenticated_admin_users_can_edit_a_category()
    {        
        $category = factory(Category::class)->create();
        $admin = factory(Admin::class)->create();

        $this->actingAs($admin, 'admin');
        
        $updatedData = [
            'name' => 'updated name',
            'description' => 'updated description'              
        ];

        $this->patchJson("/admin/categories/{$category->id}", $updatedData)
            ->assertStatus(200);

        $this->assertDatabaseHas('categories', $updatedData);
    }

}
