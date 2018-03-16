<?php

namespace Feature;

use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserWelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_a_new_user_registers_they_receive_a_welcome_email()
    {
        Mail::fake();

        $newUser = factory(User::class)->make();

        $this->post('/registrations', [
            'name' => $newUser->name,
            'email' => $newUser->email,
            'password' => $newUser->password,
            'password_confirmation' => $newUser->password,
            'about' => $newUser->about
        ])->assertRedirect('/')
          ->assertSessionHas('message', 'User signed up successfully');

        Mail::assertQueued(WelcomeMail::class, function ($mail) use ($newUser) {
            return $mail->hasTo($newUser->email);
        });
    }
}
