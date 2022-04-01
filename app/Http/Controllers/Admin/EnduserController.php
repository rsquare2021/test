<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Models\Receipt;
use App\Models\FlatShopTreeElement;
use App\Models\User;
use App\Models\UsersPrePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EnduserController extends Controller
{
    public function index(Request $request)
    {
        // 検索条件
        $user_id = '';
        $mail = '';
        $start_date = '';
        $end_date = '';
        $select_user_option = '';
        $start_value = '';
        $end_value = '';
        // レシートテーブルベース
        $users = User::query();
        // 他情報のサブクエリ
        $columns = [
            'users.*',
            'send_count' => function ($query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('receipts')
                    ->whereRaw('users.id = receipts.user_id');
            },
            'accept_count' => function ($query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('receipts')
                    ->whereRaw('users.id = receipts.user_id AND status = 100');
            },
            'total_point' => function ($query) {
                $query
                    ->selectRaw('total_point')
                    ->from('user_campaign_points')
                    ->whereRaw('users.id = user_campaign_points.user_id');
            },
            'illegal_count' => function ($query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('receipts')
                    ->whereRaw('users.id = receipts.user_id AND status = 98');
            },
            'ava' => function ($query) {
                $query
                    ->selectRaw('total_point / accept_count');
            },
            'select_total_apply' => function ($query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('applies')
                    ->whereRaw('users.id = applies.user_id');
            },
        ];
        $users = $users->select($columns);
        // 応募者ID
        $user_id = $request->input('user_id');
        if($user_id) {
            $users = $users->where('id', $user_id);
        }
        // メールアドレス
        $mail = $request->input('mail');
        if($mail) {
            $users = $users->where('email', 'like', "%$mail%");
        }
        // 作成日時
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if($start_date && $end_date) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $date = new Carbon($end_date);
            $end_date = $date->addDay();
        } elseif($start_date) {
            $start_date = $request->input('start_date');
            $end_date = '2030-10-10';
        } elseif($end_date) {
            $start_date = '2010-10-10';
            $end_date = $request->input('end_date');
            $date = new Carbon($end_date);
            $end_date = $date->addDay();
        }
        if($start_date || $end_date) {
            $users->whereBetween('created_at', [$start_date, $end_date]);
        }
        // オプション
        $select_user_option = $request->input('select_user_option');
        $start_value = $request->input('start_value');
        $end_value = $request->input('end_value');
        if($start_value && $end_value) {
            $start_value = $request->input('start_value');
            $end_value = $request->input('end_value');
        } elseif($start_value) {
            $start_value = $request->input('start_value');
            $end_value = '100000000000';
        } elseif($end_value) {
            $start_value = '0';
            $end_value = $request->input('end_value');
        }
        $send_count_query = "(select count(*) from receipts where users.id = receipts.user_id)";
        $ava_count_query = "";
        $total_count_query = "(select total_point from user_campaign_points where users.id = user_campaign_points.user_id)";
        $select_total_apply_query = "(select count(*) from applies where users.id = applies.user_id)";
        $illegal_count_query = "(select count(*) from receipts where users.id = receipts.user_id AND status = 98)";
        if($select_user_option == 'select_send_count') { //レシート送信枚数
            $users->whereBetween(DB::raw($send_count_query),[$start_value, $end_value]);
        } elseif($select_user_option == 'select_total_point_ava') { //平均獲得ポイント数
            $users->whereBetween(DB::raw($ava_count_query),[$start_value, $end_value]);
        }elseif($select_user_option == 'select_total_point') { //累計ポイント数
            if($start_value == 0) {
                $users->whereBetween(DB::raw($total_count_query),[$start_value, $end_value])->orWhereNull(DB::raw($total_count_query));
            } else {
                $users->whereBetween(DB::raw($total_count_query),[$start_value, $end_value]);
            }
        } elseif($select_user_option == 'select_total_apply') { //累計交換回数
            $users->whereBetween(DB::raw($select_total_apply_query),[$start_value, $end_value]);
        }elseif($select_user_option == 'select_illegal_count') { //不正回数
            $users->whereBetween(DB::raw($illegal_count_query),[$start_value, $end_value]);
        }
        $users = $users->paginate(20);
        if($start_date == '2010-10-10') {
            $start_date = '';
        }
        if($end_date == '2030-10-10') {
            $end_date = '';
        }
        if($start_value == '0') {
            $start_value = '';
        }
        if($end_value == '100000000000') {
            $end_value = '';
        }
        return view("admin.enduser.list", [
            'category_name' => 'enduser',
            'page_name' => 'enduser',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'エンドユーザー一覧',
            'users' => $users,
            'user_id' => $user_id,
            'mail' => $mail,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'select_user_option' => $select_user_option,
            'start_value' => $start_value,
            'end_value' => $end_value,
        ]);
    }
}
