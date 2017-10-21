<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\SocialAccountService;
use Socialite;

class SocialController extends Controller
{

    public function login($provider)
    {
        return Socialite::with($provider)->scopes(['groups', 'offline', 'email'])->redirect();
    }

    public function callback(SocialAccountService $service, $provider)
    {
        try {
            $driver = Socialite::driver($provider);
            $user = $service->createOrGetUser($driver, $provider);
            \Auth::login($user, true);
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect()->intended('/');
        }
    }

}