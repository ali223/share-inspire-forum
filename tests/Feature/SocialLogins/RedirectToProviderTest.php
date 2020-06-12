<?php

namespace Tests\Feature\SocialLogins;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Socialite\Facades\Socialite;
use Mockery as m;
use Tests\TestCase;

class RedirectToProviderTest extends TestCase
{
    /** @test */
    public function redirect_to_provider()
    {
        Socialite::shouldReceive('driver')
                ->with('github')
                ->andReturn(m::self())
                ->shouldReceive('redirect')
                ->andReturn(redirect('https://url-to-provider'));

        $this->get(route('social-logins.redirect-to-provider', 'github'))
            ->assertRedirect('https://url-to-provider');
    }
}
