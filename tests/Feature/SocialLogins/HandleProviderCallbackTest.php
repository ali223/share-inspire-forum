<?php

namespace Tests\Feature\SocialLogins;

use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery as m;
use Tests\TestCase;

class HandleProviderCallbackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function provider_callback_creates_new_user_for_new_email_and_signs_in()
    {
        Mail::fake();

        $socialiteUserData = [
            'id' => '123',
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];

        Socialite::shouldReceive('driver')
                ->with('github')
                ->andReturn(m::self())
                ->shouldReceive('user')
                ->andReturn(
                    (new SocialiteUser)
                    ->setRaw($socialiteUserData)
                    ->map($socialiteUserData)
                );

        $this->get(route('social-logins.handle-provider-callback', 'github'))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);

        $user = User::findByEmail('test@example.com');

        $this->assertDatabaseHas('social_identities', [
            'user_id' => $user->id,
            'provider_name' => 'github',
            'provider_user_id' => '123'
        ]);

        $this->assertAuthenticatedAs($user);

        Mail::assertQueued(WelcomeMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    /** @test */
    public function provider_callback_adds_new_social_identity_for_existing_user_email_and_signs_in()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $socialiteUserData = [
            'id' => '123',
            'name' => 'Test User',
            'email' => $user->email
        ];

        Socialite::shouldReceive('driver')
                ->with('github')
                ->andReturn(m::self())
                ->shouldReceive('user')
                ->andReturn(
                    (new SocialiteUser)
                    ->setRaw($socialiteUserData)
                    ->map($socialiteUserData)
                );

        $this->get(route('social-logins.handle-provider-callback', 'github'))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('social_identities', [
            'user_id' => $user->id,
            'provider_name' => 'github',
            'provider_user_id' => '123'
        ]);

        $this->assertAuthenticatedAs($user);

        Mail::assertNotQueued(WelcomeMail::class);
    }
}
