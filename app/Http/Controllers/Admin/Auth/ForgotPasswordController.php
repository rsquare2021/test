<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
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
        $this->middleware("guest:admin");
    }

    public function showLinkRequestForm()
    {
        return view("admin.passwords.email", [
            'category_name' => 'auth',
            'page_name' => 'auth_boxed',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'パスワードリセット',
        ]);
    }

    public function broker()
    {
        return Password::broker("admins");
    }

    protected function guard()
    {
        return Auth::guard("admin");
    }
}
