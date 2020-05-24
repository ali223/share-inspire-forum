<?php

namespace Tests\Feature\Registrations;

use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;

    /** @test */
    public function when_a_new_non_admin_user_registers_they_receive_a_welcome_email()
    {
        Mail::fake();

        $userRegistrationData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'about' => $this->faker->paragraph
        ];

        $this->post(route('registrations.store'), $userRegistrationData)
            ->assertRedirect(route('home'))
            ->assertSessionHas('message', 'User signed up successfully');

        Mail::assertQueued(WelcomeMail::class, function ($mail) use ($userRegistrationData) {
            return $mail->hasTo($userRegistrationData['email']);
        });
    }
}
