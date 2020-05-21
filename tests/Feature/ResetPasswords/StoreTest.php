<?php

namespace Tests\Feature\ResetPasswords;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_reset_their_password()
    {
        $user = factory(User::class)->create();

        $token = Password::createToken($user);
        $newPassword = 'secret123';

        $this->post(route('reset-passwords.store'), [
            'token' => $token,
            'email' => $user->email,
            'password' => $newPassword,
            'password_confirmation' => $newPassword
        ])->assertRedirect(route('sessions.create'))
        ->assertSessionMissing('errors');

        $this->assertTrue(
            Hash::check($newPassword, $user->fresh()->password)
        );
    }
}
