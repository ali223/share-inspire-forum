<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\SocialIdentity;
use App\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Socialite;

class SocialLoginsController extends Controller
{
    const VALID_OAUTH_PROVIDERS = [
        'github'
    ];

    public function redirectToProvider($provider)
    {
        if ($this->isInvalidProvider($provider)) {
            return redirect()
                ->route('sessions.create')
                ->withErrors('Invalid social provider');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()
                ->route('sessions.create');
        }

        $user = $this->findOrCreateUser($providerUser, $provider);

        auth()->login($user, true);

        $this->sendWelcomeEmailIfNewUser($user);

        return redirect()
            ->route('home');
    }

    protected function findOrCreateUser($providerUser, $provider)
    {
        $socialIdentity = SocialIdentity::findByProviderNameAndProviderUserId($provider, $providerUser->getId());

        if ($socialIdentity) {
            return $socialIdentity->user;
        }

        return $this->createUser($providerUser, $provider);
    }

    protected function createUser($providerUser, $provider)
    {
        $user = User::findByEmail($providerUser->getEmail());

        if (is_null($user)) {
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name'  => $providerUser->getName(),
                'password' => bcrypt(Str::random(24)),
                'photourl' => $providerUser->getAvatar()
            ]);
        }

        $user->socialIdentities()->create([
            'provider_user_id'   => $providerUser->getId(),
            'provider_name' => $provider,
        ]);

        return $user;
    }

    protected function sendWelcomeEmailIfNewUser(User $user)
    {
        if (! $user->wasRecentlyCreated) {
            return;
        }

        Mail::to($user)
            ->send(new WelcomeMail($user));
    }

    protected function isInvalidProvider($provider)
    {
        return ! in_array($provider, self::VALID_OAUTH_PROVIDERS);
    }
}
