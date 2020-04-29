<?php

namespace Tests\Feature\Sessions;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_a_user_is_logging_in_email_and_password_are_required()
    {
        $data = [
            'email' => '',
            'password' => ''
        ];

        $this->from(route('sessions.create'))
            ->post(route('sessions.store'), $data)
            ->assertRedirect(route('sessions.create'))
            ->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function a_user_cannot_login_with_invalid_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret')
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'mypassword'
        ];

        $this->from(route('sessions.create'))
            ->post(route('sessions.store'), $data)
            ->assertRedirect(route('sessions.create'))
            ->assertSessionHasErrors();
    }

    /** @test */
    public function a_user_can_login_with_valid_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret')
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'secret'
        ];

        $this->from(route('sessions.create'))
            ->post(route('sessions.store'), $data)
            ->assertRedirect(route('home'))
            ->assertSessionMissing('errors');

        $this->assertAuthenticatedAs($user);
    }
}
