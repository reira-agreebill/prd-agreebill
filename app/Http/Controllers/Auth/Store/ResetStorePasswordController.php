<?php

namespace App\Http\Controllers\Auth\Store;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetStorePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    public function __construct()
    {
        $this->middleware('guest:store');
    }
    protected function broker()
    {
        return Password::broker('stores');
    }
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        event(new PasswordReset($user));
        Auth::guard('store')->login($user);
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    public function showResetForm(Request $request, $token)
    {
        return view('restaurants.auth.passwords.reset',['token'=> $token, 'email'=> $request->email]);
    }
    protected $redirectTo = RouteServiceProvider::STORE;
}
