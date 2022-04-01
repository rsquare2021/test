<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\MkUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MekenUserRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        if($kengen == 1) {
            $users = MkUser::where('company_id', $company_id)->whereNotIn('kengen',[1])->get();
            return view("merchant.user.list", [
                'category_name' => 'meken',
                'page_name' => 'meken_user',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '目検スタッフ一覧',
                'users' => $users,
                "meken_id" => $meken_id,
                "kengen" => $kengen,
                "company_id" => $company_id,
            ]);
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }

    public function active(Request $request)
    {
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        if($kengen == 1) {
            $mk_user_id = $request->input('mk_user_id');
            $active = $request->input('active');
            if($active == '稼働する') {
                MkUser::where('id', $mk_user_id)->update([
                    'active' => 1,
                    'active_date' => DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                ]);
            } elseif($active == '停止する') {
                MkUser::where('id', $mk_user_id)->update([
                    'active' => 0,
                    'active_date' => DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                ]);
            }
            $users = MkUser::where('company_id', $company_id)->whereNotIn('kengen',[1])->get();
            return redirect(route("merchant.user"));
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }

    public function create(Request $request)
    {
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        if($kengen == 1) {
            return view("merchant.user.create", [
                'category_name' => 'meken',
                'page_name' => 'meken_user',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '目検スタッフ追加',
                "meken_id" => $meken_id,
                "kengen" => $kengen,
                "company_id" => $company_id,
            ]);
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }

    public function insert(MekenUserRequest $request)
    {
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        if($kengen == 1) {
            $user_request = $request->all();
            $serial_token = openssl_random_pseudo_bytes(10);
            $serial = bin2hex($serial_token);
            MkUser::insert([
                'serial' => $serial,
                'mail' => $user_request['mail'],
                'pass' => $user_request['pass'],
                'name' => $user_request['name'],
                'active' => 1,
                'company_id' => $company_id,
                'active_date' => DB::raw('CURRENT_TIMESTAMP'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
            return redirect(route("merchant.user"));
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }

    public function edit(Request $request, $mk_user_id)
    {
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        if($kengen == 1) {
            $mk_user = MkUser::where('id', $mk_user_id)->first();
            return view("merchant.user.edit", [
                'category_name' => 'meken',
                'page_name' => 'meken_user',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '目検スタッフ編集',
                'user' => $mk_user,
                "meken_id" => $meken_id,
                "kengen" => $kengen,
                "company_id" => $company_id,
                "mk_user_id" => $mk_user_id,
            ]);
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }

    public function update(MekenUserRequest $request, $mk_user_id)
    {
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        if($kengen == 1) {
            $user_request = $request->all();
            MkUser::where('id', $mk_user_id)->update([
                'mail' => $user_request['mail'],
                'pass' => $user_request['pass'],
                'name' => $user_request['name'],
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
            return redirect(route("merchant.user.edit",$mk_user_id));
        } else {
            return redirect(route("merchant.meken.login"));
        }
    }
}
