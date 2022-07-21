<?php

namespace App\Http\Controllers\Auth\Store;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotStorePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:store');
    }
    protected function broker()
    {
        return Password::broker('stores');
    }


    public function showLinkRequestForm()
    {
        return view('restaurants.auth.passwords.email');
    }


}
