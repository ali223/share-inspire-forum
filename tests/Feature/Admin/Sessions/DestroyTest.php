<?php

namespace Tests\Feature\Admin\Sessions;

use App\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_logout()
    {
        $admin = factory(Admin::class)->create([
            'password' => bcrypt('secret')
        ]);

        $credentials = [
            'email' => $admin->email,
            'password' => 'secret'
        ];

        $this->post(route('admin.sessions.store'), $credentials)
            ->assertRedirect(route('admin.dashboard.index'));

        $this->assertAuthenticatedAs($admin, 'admin');

        $this->delete(route('admin.sessions.destroy'))
            ->assertRedirect(route('admin.sessions.create'));

        $this->assertGuest('admin');
    }
}
