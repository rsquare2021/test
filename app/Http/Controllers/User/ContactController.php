<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactSendmail;
use App\Mail\ContactSendmailAdmin;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $contact = $request->all();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.contact.index", [
            'category_name' => 'contact',
            'page_name' => 'contact',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'お問い合わせ',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "user" => $user,
            "point" => $point,
            "contact"=> $contact,
        ]);
    }

    public function confirm(ContactFormRequest $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        $contact = $request->all();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        return view("user.contact.confirm", [
            'category_name' => 'contact',
            'page_name' => 'contact_confirm',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'お問い合わせ内容確認',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ],compact('contact'));
    }

    public function send(ContactFormRequest $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $user_id = $user->id;
        $email = $user->email;
        $campaign = Campaign::findOrFail($campaign_id);
        $contact = $request->all();
        $date = date("YmdHis");
        $contact_id = $user_id.$date;
        \Mail::to($user->email)->send(new ContactSendmail($contact, Campaign::findOrFail($campaign_id), $contact_id));
        \Mail::to('contact-cl005101@next-cp.com')->send(new ContactSendmailAdmin($contact, Campaign::findOrFail($campaign_id), $contact_id));
        $request->session()->regenerateToken();
        return view("user.contact.thanks", [
            'category_name' => 'contact',
            'page_name' => 'contact_thanks',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'お問い合わせ完了',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
            "email" => $email,
        ]);
    }
}
