<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MyTestMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Google redirect 
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    // Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }


    // Facebook redirect 
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }



    // Github redirect 
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }


    // Github callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            // dd($data);
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();

            // $detail = [
            //     'title' => 'Welcome ' . $user -> name,
            //     'body' => 'Thank you for using our service. Hope you will enjoy using it.'
            // ];

            // $mail_object = new MyTestMail($detail);

            // Mail::to($data -> email) -> send($mail_object);
            $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautymail->send('mail.welcome2', [], function ($message) use ($data) {
                $email = $data->email;
                $message
                    ->from('experiment1jimmy@mm.com')
                    ->to($email, 'Howdy buddy!')
                    ->subject('Test Mail!');
            });
        }




        Auth::login($user);
    }
}
