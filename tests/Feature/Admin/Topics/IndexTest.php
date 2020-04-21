<?php

namespace Tests\Feature\Admin\Topics;

use App\Admin;
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
    public function guests_cannot_view_admin_topics()
    {
        $this->get(route('admin.topics.index'))
            ->assertRedirect(route('admin.sessions.create'));
    }

    /** @test */
    public function non_admin_users_cannot_view_admin_topics()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.topics.index'))
            ->assertRedirect(route('admin.sessions.create'));
    }

    /** @test */
    public function admin_users_can_view_admin_topics()
    {
        $admin = factory(Admin::class)->create();
        $topics = factory(Topic::class, 2)->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.topics.index'))
            ->assertStatus(Response::HTTP_OK)

            ->assertSee(e($topics[0]->title))
            ->assertSee(e($topics[0]->user->name))
            ->assertSee(e($topics[0]->category->name))
            ->assertSee($topics[0]->created_at->toDayDateTimeString())
            ->assertSee($topics[0]->isApproved() ? 'Approved' : 'Not Approved')

            ->assertSee(e($topics[1]->title))
            ->assertSee(e($topics[1]->user->name))
            ->assertSee(e($topics[1]->category->name))
            ->assertSee($topics[1]->created_at->toDayDateTimeString())
            ->assertSee($topics[1]->isApproved() ? 'Approved' : 'Not Approved');
    }
}
