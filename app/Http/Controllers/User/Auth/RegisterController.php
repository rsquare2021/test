<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except("precomplete");
        $this->middleware("auth:user")->only("precomplete");
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('user');
    }

    // 新規登録画面
    public function showRegistrationForm($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        return view('user.signup.mail', [
            'category_name' => 'account',
            'page_name' => 'signup_mail',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'アカウント作成（メール：入力）',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
        ]);
    }

    public function selectRegistrationMethod($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.signup.top", [
            'category_name' => 'account',
            'page_name' => 'signup_top',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'アカウント作成（選択画面）',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
        ]);
    }

    public function precomplete($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        return view("user.signup.mail_pre_complete", [
            'category_name' => 'account',
            'page_name' => 'signup_mail_pre_complete',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'アカウント登録完了',
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }

    // バリデーション
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // 登録処理
    protected function create(array $data)
    {
        $user = null;
        DB::transaction(function() use($data, &$user) {
            $user = User::create([
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $point = new UserCampaignPoint();
            $point->campaign_id = request()->route()->parameter("campaign_id");
            $point->user()->associate($user);
            $point->save();
        });
        return $user;
    }

    protected function redirectTo()
    {
        return route("campaign.register.precomplete", request()->route()->parameter("campaign_id"));
    }
}