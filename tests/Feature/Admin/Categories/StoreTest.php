<?php

namespace Tests\Feature\Admin\Categories;

use App\Admin;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, 
        WithFaker;

    /** @test */
    public function guests_cannot_add_a_new_category()
    {
        $adminId  = factory(Admin::class)->create()->id;

        $categoryData = [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph
        ];

        $this->postJson(route('admin.categories.store'), $categoryData)
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('categories', $categoryData);
    }

    /** @test */
    public function non_admin_users_cannot_add_a_new_category()
    {
        $user = factory(User::class)->create();

        $categoryData = [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph
        ];

        $this->actingAs($user)
            ->postJson(route('admin.categories.store'), $categoryData)
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('categories', $categoryData);
    }

    /** @test */
    public function admin_users_can_add_a_new_category()
    {
        $admin = factory(Admin::class)->create();

        $categoryData = [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph
        ];

        $this->actingAs($admin, 'admin')
            ->postJson(route('admin.categories.store'), $categoryData)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('categories', $categoryData);
    }
}
