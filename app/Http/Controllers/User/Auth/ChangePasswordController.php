<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\User;
use App\Models\UserCampaignPoint;
use App\Mail\ChangePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ChangePasswordController extends Controller
{
    public function index($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.password.change.reset", [
            'category_name' => 'password',
            'page_name' => 'password_change',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'パスワード変更',
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }
    public function update(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $id = $user->id;
        $campaign = Campaign::findOrFail($campaign_id);
        $userdata = User::whereId($id)->first();
        $new_pass = Hash::make($request->password);
        $userdata->password = $new_pass;
        $userdata->save();
        Mail::send(new ChangePassword($request->user(), $campaign));
 
        return view("user.password.change.send", [
            'category_name' => 'password',
            'page_name' => 'password_change_send',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'パスワード変更完了',
            "campaign" => $campaign,
            "campaign_id" => $campaign_id,
            "point" => $point,
            "user" => $user,
        ]);
    }
}
