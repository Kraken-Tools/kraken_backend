<?php

namespace App\Services;

use App\Models\User;
use App\Models\SocialLogin;
use Laravel\Socialite\Two\User as ProviderUser;

class SocialAccountsService
{

    public function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $socialLogin = SocialLogin::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($socialLogin) {
            return $socialLogin->user;
        } else {
            $user = null;

            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = User::create([
                    'name' => $providerUser->getName() ?? $providerUser->getNickname(),
                    'email' => $providerUser->getEmail()
                ]);
            }

            $user->socialLogin()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);
            return $user;
        }
    }
}
