<?php

namespace Tests\Feature\ForgotPasswords;

use App\Mail\PasswordResetMail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function logged_in_users_cannot_request_the_password_reset_link()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('forgot-passwords.store'), [
                'email' => $user->email
            ])->assertRedirect(route('home'));

        Mail::assertNotQueued(PasswordResetMail::class);
    }

    /** @test */
    public function guests_cannot_request_the_password_reset_link_using_non_existing_email()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $nonExistingEmail = 'abc@example.com';

        $this->from(route('forgot-passwords.create'))
            ->post(route('forgot-passwords.store'), [
                'email' => $nonExistingEmail
            ])
            ->assertRedirect(route('forgot-passwords.create'))
            ->assertSessionHasErrors('email');

        Mail::assertNotQueued(PasswordResetMail::class);
    }

    /** @test */
    public function guests_can_request_the_password_reset_link_using_a_valid_email()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $this->from(route('forgot-passwords.create'))
            ->post(route('forgot-passwords.store'), [
                'email' => $user->email
            ])
            ->assertRedirect(route('forgot-passwords.create'))
            ->assertSessionMissing('errors');

        Mail::assertQueued(PasswordResetMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
