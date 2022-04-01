<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserCampaignPoint;
use App\Models\Campaign;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
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
        $this->middleware("guest:user");
    }

    public function showResetForm(Request $request, $campaign_id, $token = null)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.password.input", [
            'category_name' => 'account',
            'page_name' => 'password_input',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '新パスワード入力',
            "token" => $token,
            "email" => $request->email,
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
        ]);
    }

    protected function redirectTo()
    {
        return route('campaign.dashboard', request()->route("campaign_id"));
    }

    protected function guard()
    {
        return Auth::guard("user");
    }

    protected function broker()
    {
        return Password::broker("users");
    }
}
