<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => Hash::make('password' . '@' . $googleUser->id),
            ]
        );

        Auth::login($user);

        return redirect()->route('home');
    }
}
