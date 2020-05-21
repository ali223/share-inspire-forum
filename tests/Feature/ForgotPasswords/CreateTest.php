<?php

namespace Tests\Feature\ForgotPasswords;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_the_forgot_password_form()
    {
        $this->get(route('forgot-passwords.create'))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function logged_in_users_cannot_view_the_forgot_password_form()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('forgot-passwords.create'))
            ->assertRedirect(route('home'));
    }
}
