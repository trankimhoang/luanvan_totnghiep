<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAuthController extends Controller
{

    public function redirect($social)
    {
        return \Laravel\Socialite\Facades\Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = $this->createOrGetUser(Socialite::driver($social)->stateless()->user(), $social);
        Auth::guard('web')->login($user, true);

        return redirect('/');
    }

    private function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $email = $providerUser->getEmail();
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            $user = User::whereEmail($email)->first();

            if (!$user) {

                $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName() ?? $email,
                    'password' => '',
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
