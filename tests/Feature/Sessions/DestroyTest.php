<?php

namespace Tests\Feature\Sessions;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_logout()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret')
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'secret'
        ];

        $this->post(route('sessions.store'), $credentials)
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);

        $this->delete(route('sessions.destroy'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
