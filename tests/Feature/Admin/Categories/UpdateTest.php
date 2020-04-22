<?php

namespace Tests\Feature\Admin\Categories;

use App\Admin;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_update_a_category()
    {
        $category = factory(Category::class)->create();

        $updatedCategoryData = [
            'name' => 'updated name',
            'description' => 'updated description'              
        ];

        $this->patchJson(
            route('admin.categories.update', $category), 
            $updatedCategoryData
        )->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('categories', $updatedCategoryData);
    }

    /** @test */
    public function non_admin_users_cannot_update_a_category()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $updatedCategoryData = [
            'name' => 'updated name',
            'description' => 'updated description'              
        ];

        $this->actingAs($user)
            ->patchJson(
                route('admin.categories.update', $category), 
                $updatedCategoryData
            )->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('categories', $updatedCategoryData);
    }

    /** @test */
    public function admin_users_can_update_a_category()
    {        
        $admin = factory(Admin::class)->create();
        $category = factory(Category::class)->create();
        
        $updatedCategoryData = [
            'name' => 'updated name',
            'description' => 'updated description'
        ];

        $this->actingAs($admin, 'admin')
            ->patchJson(
                route('admin.categories.update', $category), 
                $updatedCategoryData
            )->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('categories', $updatedCategoryData);
    }
}
