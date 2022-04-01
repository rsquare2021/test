<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

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
        $this->middleware("guest:user");
    }

    public function showLinkRequestForm($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.password.reset", [
            'category_name' => 'account',
            'page_name' => 'password_reset',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'パスワード再発行',
            "campaign" => $campaign,
        ]);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        $campaign = Campaign::findFromRoute();
        return view("user.password.send", [
            'category_name' => 'account',
            'page_name' => 'password_send',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'パスワード再発行URL送信画面',
            "campaign" => $campaign,
        ]);
    }

    protected function broker()
    {
        return Password::broker("users");
    }
}
