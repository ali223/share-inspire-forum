<?php

namespace Tests\Feature\ResetPasswords;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_the_reset_password_form()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this->get(
            route('reset-passwords.create', [
                'token' => $token,
                'email' => $user->email
            ])
        )->assertStatus(Response::HTTP_OK)
        ->assertSee($user->email)
        ->assertSee($token);
    }
}
