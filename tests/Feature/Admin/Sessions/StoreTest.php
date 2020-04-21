<?php

namespace Tests\Feature\Admin\Sessions;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_logging_in_email_and_password_are_required()
    {
        $data = [
            'email' => '',
            'password' => ''
        ];

        $this->from(route('admin.sessions.create'))
            ->post(route('admin.sessions.store'), $data)
            ->assertRedirect(route('admin.sessions.create'))
            ->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function admin_cannot_login_with_invalid_password()
    {
        $admin = factory(Admin::class)->create([
            'password' => bcrypt('secret')
        ]);

        $data = [
            'email' => $admin->email,
            'password' => 'mypassword'
        ];

        $this->from(route('admin.sessions.create'))
            ->post(route('admin.sessions.store'), $data)
            ->assertRedirect(route('admin.sessions.create'))
            ->assertSessionHasErrors();
    }

    /** @test */
    public function admin_can_login_with_valid_password()
    {
        $admin = factory(Admin::class)->create([
            'password' => bcrypt('secret')
        ]);

        $data = [
            'email' => $admin->email,
            'password' => 'secret'
        ];

        $this->from(route('admin.sessions.create'))
            ->post(route('admin.sessions.store'), $data)
            ->assertRedirect(route('admin.dashboard.index'))
            ->assertSessionMissing('errors');

        $this->assertAuthenticatedAs($admin, 'admin');
    }
}
