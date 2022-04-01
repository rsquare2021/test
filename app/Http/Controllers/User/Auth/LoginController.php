<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\User;
use App\Models\UserCampaignPoint;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:user')
            ->except([
                "showLoginForm",
                'logout',
                "confirmToJoinCampaign",
                "joinCampaign"
            ]);
    }

    // ログイン画面
    public function showLoginForm(Request $request, $campaign_id)
    {
        $remembered_email = $request->session()->get(self::REMEMBER_EMAIL_SESSION_KEY, null);
        if($remembered_email and Carbon::now()->diffInDays($remembered_email["created_at"]) <= 30) {
            $email = $remembered_email["email"];
        }
        else {
            $request->session()->forget(self::REMEMBER_EMAIL_SESSION_KEY);
            $email = "";
        }

        $campaign = Campaign::findOrFail($campaign_id);

        return view('user.top', [
            'category_name' => 'campaign',
            'page_name' => 'top',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ログイン & キャンペーン概要 & 不参加のリダイレクト先',
            "campaign" => $campaign,
            "email" => $email,
        ]);
    }

    public function redirectToProvider(Request $request, $campaign_id, $provider)
    {
        $request->session()->put("socialite_login", [
            "provider" => $provider,
            "campaign_id" => $campaign_id,
        ]);

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $campaign_id = $request->session()->pull("socialite_login")["campaign_id"];
            $provider_user = Socialite::driver($provider)->stateless()->user();
        }
        catch (Exception $e) {
            return redirect()->route("campaign.login", ["campaign_id" => $campaign_id]);
        }

        $user = User::where("provider", $provider)
            ->where("provider_user_id", $provider_user->id)
            ->first();

        if($user === null) {
            DB::transaction(function() use($provider, $provider_user, $campaign_id, &$user) {
                $user = User::create([
                    "name" => $provider_user->name,
                    "provider" => $provider,
                    "provider_user_id" => $provider_user->id,
                ]);
                $point = new UserCampaignPoint();
                $point->campaign_id = $campaign_id;
                $point->user()->associate($user);
                $point->save();
            });
        }

        Auth::guard("user")->login($user);

        // キャンペーンとの紐づけがない場合、参加確認ページにリダイレクト。
        // ある場合はダッシュボードにリダイレクト。
        if(UserCampaignPoint::loggedInCampaign($campaign_id)->first()) {
            return redirect(route('campaign.dashboard', $campaign_id));
        }
        else {
            return redirect(route('campaign.entry', $campaign_id));
        }
    }

    public function confirmToJoinCampaign($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.confirm", [
            'category_name' => 'account',
            'page_name' => 'campaign_confirm',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン参加',
            "campaign" => $campaign,
        ]);
    }

    public function joinCampaign(Request $request, $campaign_id)
    {
        if(!$request->user()->isJoinedCampaign($campaign_id)) {
            $request->user()->joinCampaign($campaign_id);
        }

        return redirect(route("campaign.dashboard", $campaign_id));
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('user');
    }

    protected function redirectTo()
    {
        return route("campaign.dashboard", request()->route()->parameter("campaign_id"));
    }

    // ログアウト処理
    public function logout(Request $request, $campaign_id)
    {
        Auth::guard('user')->logout();

        return $this->loggedOut($request,$campaign_id);
    }

    // ログアウトした時のリダイレクト先
    public function loggedOut(Request $request, $campaign_id)
    {
        return redirect(route("campaign.login", $campaign_id));
    }

    protected function authenticated(Request $request, $user)
    {
        // メルアドを記憶する
        if($request->has("remember") and $request->remember) {
            $remembered_email = [
                "email" => $request->email,
                "created_at" => Carbon::now()->format("Y-m-d H:i:s"),
            ];
            $request->session()->put(self::REMEMBER_EMAIL_SESSION_KEY, $remembered_email);
        }
        else {
            $request->session()->forget(self::REMEMBER_EMAIL_SESSION_KEY);
        }

        // ログイン後リダイレクト先をエンドユーザーページに限定する。
        $intended_url = $request->session()->get("url.intended");
        $is_user_route = collect(Route::getRoutes())->filter(function($route) use($intended_url) {
            return $route->named("campaign.*") and $route->matches(request()->create($intended_url));
        })->isNotEmpty();
        if(!$is_user_route) {
            $request->session()->forget("url.intended");
        }
    }

    protected const REMEMBER_EMAIL_SESSION_KEY = "remembered_email";
}