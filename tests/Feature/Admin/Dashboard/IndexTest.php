<?php

namespace Tests\Feature\Admin\Dashboard;

use App\Admin;
use App\Category;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_admin_dashboard()
    {
        $this->get(route('admin.dashboard.index'))
            ->assertRedirect(route('admin.sessions.create'));
    }

    /** @test */
    public function non_admin_users_cannot_view_admin_dashboard()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard.index'))
            ->assertRedirect(route('admin.sessions.create'));
    }

    /** @test */
    public function admin_users_can_view_admin_dashboard()
    {
        $admin = factory(Admin::class)->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard.index'))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function admin_users_can_view_number_of_categories_on_admin_dashboard()
    {
        $admin = factory(Admin::class)->create();
        $categories = factory(Category::class, 6)->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard.index'))
            ->assertSee($categories->count() . ' Categories');
    }

    /** @test */
    public function admin_users_can_view_number_of_topics_on_admin_dashboard()
    {
        $admin = factory(Admin::class)->create();
        $topics = factory(Topic::class, 8)->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard.index'))
            ->assertSee($topics->count() . ' Topics');
    }

    /** @test */
    public function admin_users_can_view_number_of_posts_on_admin_dashboard()
    {
        $admin = factory(Admin::class)->create();
        $posts = factory(Post::class, 10)->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard.index'))
            ->assertSee($posts->count() . ' Posts');
    }

    /** @test */
    public function admin_users_can_view_number_of_users_on_admin_dashboard()
    {
        $admin = factory(Admin::class)->create();
        $users = factory(User::class, 12)->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.dashboard.index'))
            ->assertSee($users->count() . ' Users');
    }
}
