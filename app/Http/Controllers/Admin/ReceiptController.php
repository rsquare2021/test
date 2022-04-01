<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Models\Receipt;
use App\Models\ReceiptStatus;
use App\Models\MkCompany;
use App\Models\MkStatus;
use App\Models\FlatShopTreeElement;
use App\Models\UsersPrePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        // 検索用変数セット
        $order_id = '';
        $re_id = '';
        // 検索取得
        $order_id = $request->input('order_id'); //応募者ID
        $re_id = $request->input('re_id'); //応募者ID
        // レシート発行日時
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $base_start_date = $request->input('start_date');
        $base_end_date = $request->input('end_date');
        if($start_date && $end_date) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
        } elseif($start_date) {
            $start_date = $request->input('start_date');
            $end_date = '2030-10-10';
        } elseif($end_date) {
            $start_date = '2010-10-10';
            $end_date = $request->input('end_date');
        }
        // 数量
        $min_value = $request->input('min_value');
        $max_value = $request->input('max_value');
        $base_min_value = $request->input('min_value');
        $base_max_value = $request->input('max_value');
        if($min_value && $max_value) {
            $min_value = $request->input('min_value');
            $max_value = $request->input('max_value');
        } elseif($min_value) {
            $min_value = $request->input('min_value');
            $max_value = '1000000';
        } elseif($max_value) {
            $min_value = '0';
            $max_value = $request->input('max_value');
        }
        $status_duplicate = '';
        $status_ng1 = '';
        $status_ng2 = '';
        $meken_none = '';
        $meken_now = '';
        $meken_ok = '';
        $meken_ng = '';
        $meken_danger = '';
        $meken_judge = '';
        $meken_novalue = '';
        $person_none = '';
        $person_meken = '';
        $person_nt = '';
        $status_duplicate = $request->input('status_duplicate'); //重複
        $status_ng1 = $request->input('status_ng1'); //NGワード1
        $status_ng2 = $request->input('status_ng2'); //NGワード2
        $meken_none = $request->input('meken_none'); //目検なし
        $meken_now = $request->input('meken_now'); //確認中
        $meken_ok = $request->input('meken_ok'); //承認
        $meken_ng = $request->input('meken_ng'); //否認
        $meken_danger = $request->input('meken_danger'); //不正
        $meken_judge = $request->input('meken_judge'); //判断不可
        $meken_novalue = $request->input('meken_novalue'); //実在データなし
        $person_none = $request->input('person_none'); //担当なし
        $person_meken = $request->input('person_meken'); //目検
        $person_nt = $request->input('person_nt'); //NT

        // レシートテーブルベース ポイント付与待ちから検索か判断
        $re_select_btn = $request->input('re_select_btn');
        $re_select_rule = $re_select_btn;
        if($re_select_btn == 'ポイント付与待ちから検索') {
            $status_duplicate = '';
            $status_ng1 = '';
            $status_ng2 = '';
            $meken_none = '';
            $meken_now = '';
            $meken_ok = '';
            $meken_ng = '';
            $meken_danger = '';
            $meken_judge = '';
            $meken_novalue = '';
            $person_none = '';
            $person_meken = '';
            $person_nt = '';
            $receipts = Receipt::select('receipts.id as receipt_id','receipts.*','users_pre_points.*')->join('users_pre_points', 'users_pre_points.receipt_id', '=', 'receipts.id');
        } else {
            $receipts = Receipt::select('receipts.id as receipt_id','receipts.*','mk_statuses.*')->join('mk_statuses', 'mk_statuses.id', '=', 'receipts.status');
        }
        // 応募者ID AND
        if($order_id) {
            $receipts->where('user_id', $order_id);
        }
        // レシートID AND
        if($re_id) {
            $receipts->where('receipts.id', $re_id);
        }
        // レシート発行日時 AND
        if($start_date || $end_date) {
            $receipts->whereBetween('mk_date', [$start_date, $end_date]);
        }
        // 数量 AND
        if($min_value || $max_value) {
            $receipts->whereBetween('receipt_value', [$min_value, $max_value]);
        }
        // レシート一覧かポイント付与一覧か判別
        if($re_select_btn == 'ポイント未付与から検索') {
            if($status_duplicate || $status_ng1 || $status_ng2) {
                $receipts->where(function($query) use($status_duplicate, $status_ng1, $status_ng2) {
                    // 重複
                    if($status_duplicate) {
                        $query->orWhereIn('status_double', [1,2]);
                    }
                    // NGワード1
                    if($status_ng1) {
                        $query->orWhereIn('status_ngword', [1]);
                    }
                    // NGワード2
                    if($status_ng2) {
                        $query->orWhereIn('status_ngword', [2]);
                    }
                });
            }
            if($meken_none || $meken_now || $meken_ok || $meken_ng || $meken_danger || $meken_judge || $meken_novalue) {
                $receipts->where(function($query) use($meken_none, $meken_now, $meken_ok, $meken_ng, $meken_danger, $meken_judge, $meken_novalue) {
                    // 目検なし
                    if($meken_none) {
                        $query->orWhereIn('status',[0]);
                    }
                    // 確認中
                    if($meken_now) {
                        $query->orWhereIn('status',[10,11,12,13,14,15,16,17,18,19,20,21,22,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39]);
                    }
                    // 承認
                    if($meken_ok) {
                        $query->orWhereIn('status',[90,94,95]);
                    }
                    // 否認
                    if($meken_ng) {
                        $query->orWhereIn('status',[91,92,96,97,98,99]);
                    }
                    // 不正
                    if($meken_danger) {
                        $query->orWhereIn('status',[98]);
                    }
                    // 判断不可
                    if($meken_judge) {
                        $query->orWhereIn('status',[20,30]);
                    }
                    // 実在データ
                    if($meken_novalue) {
                        $query->orWhereIn('status',[99]);
                    }
                });
            }
            if($person_none || $person_meken || $person_nt) {
                $receipts->where(function($query) use($person_none, $person_meken, $person_nt) {
                    // 担当なし
                    if($person_none) {
                        $query->orWhereIn('status',[0,100]);
                    }
                    // 目検担当
                    if($person_meken) {
                        $query->orWhereIn('status',[10,11,12,13,14,15,16,17,18,19,20,21,22,24,25,26,27,28,29]);
                    }
                    // NT
                    if($person_nt) {
                        $query->orWhereIn('status',[30,31,32,33,34,99]);
                    }
                });
            }
        } elseif($re_select_btn == 'ポイント付与済みから検索') {
            $status_duplicate = '';
            $status_ng1 = '';
            $status_ng2 = '';
            $meken_none = '';
            $meken_now = '';
            $meken_ok = '';
            $meken_ng = '';
            $meken_danger = '';
            $meken_judge = '';
            $meken_novalue = '';
            $person_none = '';
            $person_meken = '';
            $person_nt = '';
            $receipts->whereIn('status', [100]);
        }
        if($re_select_rule == '') {
            $re_select_rule = 'ポイント未付与から検索';
        }
        $receipts = $receipts->orderBy('receipts.id', 'desc')->paginate(100);
        // 読み取りステータス
        $target_receipt_statuses = array('status_shop','status_double','status_ngword','status_multi','status_nodata');
        $receipt_statuses = ReceiptStatus::get();
        return view("admin.re.list", [
            'category_name' => 'receipt',
            'page_name' => 'receipt_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'レシート一覧',
            'receipts' => $receipts,
            'order_id' => $order_id,
            're_id' => $re_id,
            'start_date' => $base_start_date,
            'end_date' => $base_end_date,
            'min_value' => $base_min_value,
            'max_value' => $base_max_value,
            'status_duplicate' => $status_duplicate,
            'status_ng1' => $status_ng1,
            'status_ng2' => $status_ng2,
            'meken_none' => $meken_none,
            'meken_now' => $meken_now,
            'meken_ok' => $meken_ok,
            'meken_ng' => $meken_ng,
            'meken_danger' => $meken_danger,
            'meken_judge' => $meken_judge,
            'meken_novalue' => $meken_novalue,
            'person_none' => $person_none,
            'person_meken' => $person_meken,
            'person_nt' => $person_nt,
            're_select_rule' => $re_select_rule,
            'receipt_statuses' => $receipt_statuses,
            'target_receipt_statuses' => $target_receipt_statuses,
        ]);
    }

    public function mekenList(Request $request)
    {
        $receipts = Receipt::select('receipts.id as receipt_id','receipts.*','mk_statuses.*')->whereIn('status',[30,31,32,33,34,99])->orderBy('receipts.id', 'desc')->join('mk_statuses', 'mk_statuses.id', '=', 'receipts.status')->paginate(20);
        // 読み取りステータス
        $target_receipt_statuses = array('status_shop','status_double','status_ngword','status_multi','status_nodata');
        $receipt_statuses = ReceiptStatus::get();
        return view("admin.re.edit.list", [
            'category_name' => 'receipt',
            'page_name' => 'receipt_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検レシート一覧',
            "receipts" => $receipts,
            'receipt_statuses' => $receipt_statuses,
            'target_receipt_statuses' => $target_receipt_statuses,
        ]);
    }

    public function mekenDetail(Request $request, $re_id)
    {
        $back_data = session('re_data');
        $receipt = Receipt::where('receipts.id',$re_id)->first();
        if($back_data) {
            $multi_values = $back_data['multi_value'];
        } else {
            if($receipt->total_price) {
                $multi_values = explode(',', $receipt->total_price);
            } else {
                $multi_values = '';
            }
        }
        // 再発行数
        $ng_count = Receipt::where('receipts.id',$re_id)->where('user_id',$receipt->user_id)->where('status_ngword',2)->count();
        return view("admin.re.edit.detail", [
            'category_name' => 'receipt_detail',
            'page_name' => 'receipt_detail',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検レシート詳細',
            "receipt" => $receipt,
            "re_id" => $re_id,
            "kengen" => 9,
            "multi_values" => $multi_values,
            "ng_count" => $ng_count,
            "back_data" => $back_data,
        ]);
    }

    public function mekenEdit(Request $request, $re_id)
    {
        $re_data = $request->all();
        $user_id = $request->input('user_id'); //ユーザーID
        $value = $request->input('mk_value'); //給油量
        $date = $request->input('mk_date'); //日付
        $time1 = $request->input('mk_time1'); //時
        $time2 = $request->input('mk_time2'); //分
        $tel = $request->input('mk_tel'); //電話番号
        $memo = $request->input('mk_memo'); //メモ
        $action = $request->input('action'); //動作
        $status = $request->input('status'); //ステータス
        $time = $time1.':'.$time2; //時分
        $multi_values = $request->input('multi_value'); //複数商品
        // 複数商品成形
        if($multi_values) {
            $multi_value_total = 0;
            $multi_value_post = implode(',', $multi_values);
            foreach($multi_values as $multi_value) {
                $multi_value_total += $multi_value;
            }
            $point = floor($multi_value_total / 25);
        } else {
            $multi_value_post = null;
            if($value) {
                $point = floor($value / 25);
            } else {
                $point = floor($receipt->mk_value / 25);
            }
        }
        $receipt = Receipt::where('receipts.id',$re_id)->first();
        $campaign_id = $receipt->campaign_id;
        if(!$value) {
            $value = $receipt->mk_value;
        }
        if(!$date) {
            $date = $receipt->mk_date;
        }
        if(!$time1) {
            $time = $receipt->mk_time;
        }
        if(!$tel) {
            $tel = $receipt->mk_tel;
        }
        if($status == '30' || $status == '31' || $status == '32' || $status == '33' || $status == '34' || $status == '35' || $status == '36' || $status == '37' || $status == '38' || $status == '39') {
            // 承認
            if($action == 'accept') {
                $duplicate = Receipt::where('id','!=',$re_id)->where('campaign_id', $campaign_id)->where('mk_date', $date)->where('mk_time', $time)->where('mk_value', $value)->where('tel',$tel)->first();
                if($duplicate) {
                    if($duplicate->user_id == $user_id) {
                        return redirect( route('admin.meken.detail',$re_id) )->with('flash_message', "自分のレシートと重複しています。「承認」以外を選択してください。")->with(compact('re_data'));
                    } else {
                        Receipt::where('receipts.id', $re_id)->update([
                            'status_double' => 1,
                        ]);
                        return redirect( route('admin.meken.detail',$re_id) )->with('flash_message', "他者のレシートと重複しています。「承認」以外を選択してください。")->with(compact('re_data'));
                    }
                } else{
                    Receipt::where('receipts.id', $re_id)->update([
                        'total_price' => $multi_value_post,
                        'point' => $point,
                        'mk_value' => $value,
                        'mk_date' => $date,
                        'mk_time' => $time,
                        'mk_tel' => $tel,
                        'receipt_memo' => $memo,
                        'status' => '95',
                    ]);
                }
                $success = UsersPrePoint::where('receipt_id',$re_id)->get()->isEmpty();
                if($success) {
                    UsersPrePoint::insert([
                        'receipt_id' => $re_id,
                        'point' => $point,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            // 否認
            if($action == 'reject') {
                Receipt::where('receipts.id', $re_id)->update([
                    'total_price' => $multi_value_post,
                    'point' => $point,
                    'mk_value' => $value,
                    'mk_date' => $date,
                    'mk_time' => $time,
                    'mk_tel' => $tel,
                    'receipt_memo' => $memo,
                    'status' => '96',
                ]);
            }
            // 不正
            if($action == 'illegal') {
                Receipt::where('receipts.id', $re_id)->update([
                    'total_price' => $multi_value_post,
                    'point' => $point,
                    'mk_value' => $value,
                    'mk_date' => $date,
                    'mk_time' => $time,
                    'mk_tel' => $tel,
                    'receipt_memo' => $memo,
                    'status' => '98',
                ]);
            }
            // 判断不可
            if($action == 'nojudge') {
            }
        }
        return redirect(route("admin.meken.list"));
    }

    public function mekenWorks(Request $request)
    {
        // 目検業者検索
        $companies = MkCompany::get();
        // 検索条件
        $mk_company = '';
        $start_date = '';
        $end_date = '';
        $to_accept = '';
        $to_reject = '';
        $to_nojudge = '';
        $to_illegal = '';
        // 目検日セット
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $base_end_date = $end_date;
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
        // レシートテーブルベース
        $meken_select_btn = $request->input('meken_select_btn');
        $receipts = Receipt::select('receipts.id as receipt_id','receipts.*','mk_users.*','mk_statuses.*')->join('mk_users', 'receipts.mk_user_id', '=', 'mk_users.serial')->join('mk_companies', 'mk_users.company_id', '=', 'mk_companies.id')->join('mk_statuses', 'mk_statuses.id', '=', 'receipts.meken_after_value');
        if($meken_select_btn == '検索') {
            $mk_company = $request->input('mk_company');
            $to_accept = $request->input('to_accept');
            $to_reject = $request->input('to_reject');
            $to_nojudge = $request->input('to_nojudge');
            $to_illegal = $request->input('to_illegal');
            // 目検日
            if($start_date || $end_date) {
                $receipts->whereBetween('meken_at', [$start_date, $end_date]);
            }
            // 会社名
            if($mk_company !== '') {
                $receipts->where('mk_companies.id', $mk_company);
            }
            // ステータス
            if($to_accept || $to_reject || $to_nojudge || $to_illegal) {
                $receipts->where(function($query) use($to_accept, $to_reject, $to_nojudge, $to_illegal) {
                    // 仮承認
                    if($to_accept) {
                        $query->orWhereIn('meken_value', [21]);
                    }
                    // 仮否認
                    if($to_reject) {
                        $query->orWhereIn('meken_value', [22]);
                    }
                    // 判断不可
                    if($to_nojudge) {
                        $query->orWhereIn('meken_value', [20]);
                    }
                    // 不正疑い
                    if($to_illegal) {
                        $query->orWhereIn('meken_value', [24]);
                    }
                });
            }
        }
        // レシート取得
        $receipt_count = $receipts->whereBetween('meken_after_value',[20,100])->orderBy('meken_at')->count();
        $receipts = $receipts->whereBetween('meken_after_value',[20,100])->orderBy('meken_at')->paginate(20);
        if($start_date == '2010-10-10') {
            $start_date = '';
        }
        if($end_date == '2030-10-10') {
            $end_date = '';
        }
        // 読み取りステータス
        $target_receipt_statuses = array('status_shop','status_double','status_ngword','status_multi','status_nodata');
        $receipt_statuses = ReceiptStatus::get();
        return view("admin.re.work", [
            'category_name' => 'receipt',
            'page_name' => 'receipt_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検業者管理',
            "receipts" => $receipts,
            "start_date" => $start_date,
            "end_date" => $base_end_date,
            "receipt_count" => $receipt_count,
            "mk_company" => $mk_company,
            "to_accept" => $to_accept,
            "to_reject" => $to_reject,
            "to_nojudge" => $to_nojudge,
            "to_illegal" => $to_illegal,
            "companies" => $companies,
            'receipt_statuses' => $receipt_statuses,
            'target_receipt_statuses' => $target_receipt_statuses,
        ]);
    }

    public function imgGet(Request $request)
    {
        return 'https://re-nt-upload.s3.ap-northeast-1.amazonaws.com/'.$request->input('receipt_path');
    }
}
