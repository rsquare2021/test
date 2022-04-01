<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\MkUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->session()->get('id');
        $kengen = $request->session()->get('kengen');
        $mail = $request->input('mail');
        $password = $request->input('password');
        return view("merchant.login", [
            'category_name' => 'meken',
            'page_name' => 'meken_login',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検ログイン',
        ]);
    }

    public function login(Request $request)
    {
        $mail = $request->input('mail');
        $password = $request->input('password');
        $user_count = MkUser::where('mail',$mail)->where('pass',$password)->where('active',1)->count();
        if($user_count > 0) {
            $user = MkUser::where('mail',$mail)->where('pass',$password)->where('active',1)->first();
            $id = $user->serial;
            $kengen = $user->kengen;
            $company_id = $user->company_id;
            session(['meken_id' => $id, 'kengen' => $kengen, 'company_id' => $company_id]);
            $meken_id = session('meken_id');
            return redirect(route("merchant.meken.list"));
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }
}
