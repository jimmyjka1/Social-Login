<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class FacebookController extends Controller
{
    
    public function loginUsingFacebook()
    {
        return Socialite::driver('Facebook') -> redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook') -> user();
            $saveUser = User::updateOrCreate([
                'facebook_id' => $user -> getName(),
                'email' => $user -> getEmail(),
                'password' => Hash::make($user -> getName() . '@' . $user -> getId())
            ]);

            Auth::loginUsingId($saveUser -> id);


            return redirect() -> home('home');
        } catch (Throwable $th){
            throw $th;
        }
    }
}
