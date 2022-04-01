<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifiedUserEmail;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function editEmail($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.mail.change", [
            'category_name' => 'account',
            'page_name' => 'mail_change',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'メールアドレス設定 & 変更',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }

    public function updateEmail(Request $request, $campaign_id){
        $data = $request->validate([
            "email" => ["required", "email", "confirmed"],
        ]);

        $user = $request->user();

        if($user->email != $data["email"]) {
            $request->validate([
                "email" => ["unique:users"],
            ]);

            $user->email = $data["email"];
            $user->email_verified_at = null;
            $user->save();
        }

        $user->sendEmailVerificationNotification();

        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.mail.send", [
            'category_name' => 'account',
            'page_name' => 'mail_send',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'メールアドレス確認URL送信画面',
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }

    public function complete(Request $request, $campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);

        Mail::send(new VerifiedUserEmail($request->user()));

        return view("user.signup.mail_complete", [
            'category_name' => 'account',
            'page_name' => 'signup_mail_complete',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'アカウント登録完了',
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }

    public function resendVerificationEmail($campaign_id)
    {
        return view('user.signup.mail_velify', [
            'category_name' => 'account',
            'page_name' => 'campaign_mail_velify',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return view("user.mail.send", [
            'category_name' => 'account',
            'page_name' => 'mail_send',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'メールアドレス確認URL送信画面',
        ]);
    }

    protected function redirectTo()
    {
        return route("campaign.verification.complete", [request()->route("campaign_id"), request()->route("method")]);
    }
}
