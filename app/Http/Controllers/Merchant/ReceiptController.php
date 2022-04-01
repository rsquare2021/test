<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\ReceiptStatus;
use App\Models\UsersPrePoint;
use App\Models\MkUser;
use App\Http\Requests\MekenRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{

    public function mekenList(Request $request)
    {
        // セッション
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        // 検索条件
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
        // 担当者セット
        $mk_users = $request->input('mk_user');
        if(!$mk_users) {
            $mk_users = [];
        }
        if($kengen == 1) {
            $tantous = MkUser::where('company_id', $company_id)->where('kengen', 0)->get();
        } elseif($kengen == 0) {
            $tantous = '';
        }
        if(!$meken_id) {
            return redirect(route("merchant.meken.login"));
        }
        // スタッフ
        if($kengen == 0) {
            // 1ページで割り振る数
            $maxCount = 10;
            // やり残しチェック
            $count = Receipt::where('mk_user_id',$meken_id)->whereBetween('status',[10,19])->limit($maxCount)->count();
            //常に割り振った数は、やり残し含め$maxCountになるように
            $set_count = $maxCount - $count;
            if($count != $maxCount){
                // まずは割り振り
                Receipt::whereNull('mk_user_id')->whereBetween('status',[10,19])->limit($set_count)->update([
                    'mk_user_id' => $meken_id,
                ]);
            }
            // レシート情報取得
            $receipts = Receipt::select('receipts.id as receipt_id', 'receipts.*')->where('mk_user_id',$meken_id)->whereBetween('status',[10,19])->limit($maxCount)->get();
        // 上司
        } elseif($kengen == 1) {
            // レシートテーブルベース
            $meken_select_btn = $request->input('meken_select_btn');
            $receipts = Receipt::select('receipts.id as receipt_id', 'receipts.*', 'mk_users.*','mk_statuses.*')->join('mk_users', 'receipts.mk_user_id', '=', 'mk_users.serial')->join('mk_statuses', 'mk_statuses.id', '=', 'receipts.meken_value')->where('mk_users.company_id',$company_id)->whereBetween('receipts.status',[20,29]);
            // 検索ボタン
            if($meken_select_btn == '検索') {
                // 目検日
                if($start_date || $end_date) {
                    $receipts->whereBetween('meken_at', [$start_date, $end_date]);
                }
                if($mk_users) {
                    $receipts->whereIn('mk_user_id', $mk_users);
                }
                $to_accept = $request->input('to_accept');
                $to_reject = $request->input('to_reject');
                $to_nojudge = $request->input('to_nojudge');
                $to_illegal = $request->input('to_illegal');
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
            if($kengen == 0) {
                $receipt_count = $receipts->where('mk_user_id',$meken_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->count();
                $receipts = $receipts->where('mk_user_id',$meken_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->paginate(20);
            } elseif($kengen == 1) {
                $receipt_count = $receipts->where('company_id', $company_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->count();
                $receipts = $receipts->where('company_id', $company_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->paginate(20);
            }
            // 日付セット
            if($start_date == '2010-10-10') {
                $start_date = '';
            }
            if($end_date == '2030-10-10') {
                $end_date = '';
            }
        }
        // URLを記録
        if($kengen == 1) {
            $now = url()->full();
            session(['redirect_url' => $now]);
            $redirect_url = session('redirect_url');
        }
        // 読み取りステータス
        $target_receipt_statuses = array('status_shop','status_double','status_multi','status_nodata');
        $receipt_statuses = ReceiptStatus::get();
        // view
        return view("merchant.list", [
            'category_name' => 'receipt',
            'page_name' => 'receipt_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検レシート一覧',
            "meken_id" => $meken_id,
            "kengen" => $kengen,
            "company_id" => $company_id,
            "receipts" => $receipts,
            "start_date" => $start_date,
            "end_date" => $base_end_date,
            "to_accept" => $to_accept,
            "to_reject" => $to_reject,
            "to_nojudge" => $to_nojudge,
            "to_illegal" => $to_illegal,
            "tantous" => $tantous,
            "mk_users" => $mk_users,
            'receipt_statuses' => $receipt_statuses,
            'target_receipt_statuses' => $target_receipt_statuses,
        ]);
    }

    public function mekenDetail(Request $request, $re_id)
    {
        // セッション
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        $back_data = session('re_data');
        // レシート取得
        $receipt = Receipt::where('id',$re_id)->first();

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
        // 目検業者
        if($kengen == 0 || $kengen == 1) {
            return view("merchant.detail", [
                'category_name' => 'receipt_detail',
                'page_name' => 'receipt_detail',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '目検レシート詳細',
                "meken_id" => $meken_id,
                "kengen" => $kengen,
                "company_id" => $company_id,
                "receipt" => $receipt,
                "re_id" => $re_id,
                "multi_values" => $multi_values,
                "ng_count" => $ng_count,
                "back_data" => $back_data,
            ]);
        // NT
        } else {
            return view("admin.re.edit.detail", [
                'category_name' => 'receipt_detail',
                'page_name' => 'receipt_detail',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '目検レシート詳細',
                "receipt" => $receipt,
                "re_id" => $re_id,
            ]);
        }
    }

    public function mekenEdit(Request $request, $re_id)
    {
        // セッション
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        $redirect_url = session('redirect_url');
        // リクエスト
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
        $multi_values = $request->input('multi_value'); //複数商品
        // 複数商品成形
        if($multi_values) {
            $multi_value_total = 0;
            $multi_value_post = implode(',', $multi_values);
            foreach($multi_values as $multi_value) {
                (float) $multi_value_total += (float) $multi_value;
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
        // データセット
        $time = $time1.':'.$time2; //時分
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
        // スタッフ
        if($kengen == 0) {
            // 承認
            if($action == 'accept') {
                $change = 21;
            // 否認
            } elseif($action == 'reject') {
                $change = 22;
            // 不正
            } elseif($action == 'illegal') {
                $change = 24;
            // 判断不可
            } elseif($action == 'nojudge') {
                $change = 20;
            }
             // アップデート
            if($change) {
                // ユーザーがアクティブか確認
                $user_count = MkUser::where('serial',$meken_id)->where('active',1)->count();
                // アクティブだったら
                if($user_count > 0) {
                    // 承認の場合
                    if($change == 21) {
                        // まずは重複確認
                        $duplicate = Receipt::where('id','!=',$re_id)->where('campaign_id', $campaign_id)->where('mk_date', $date)->where('mk_time', $time)->where('mk_value', $multi_value)->where('tel',$tel)->where('id','>',1999)->first();
                        // 重複していたら重複ステータスを付けた上でリダイレクト
                        if($duplicate) {
                            if($duplicate->user_id == $user_id) {
                                return redirect( route('merchant.meken.detail',$re_id) )->with('flash_message', "自分のレシートと重複しています。「承認」以外を選択してください。")->with(compact('re_data'));
                            } else {
                                Receipt::where('receipts.id', $re_id)->update([
                                    'status_double' => 1,
                                ]);
                                return redirect( route('merchant.meken.detail',$re_id) )->with('flash_message', "他者のレシートと重複しています。「承認」以外を選択してください。")->with(compact('re_data'));
                            }
                        }
                    }
                    // レコードアップデート
                    Receipt::where('id', $re_id)->update([
                        'total_price' => $multi_value_post,
                        'point' => $point,
                        'mk_value' => $multi_value,
                        'mk_date' => $date,
                        'mk_time' => $time,
                        'mk_tel' => $tel,
                        'receipt_memo' => $memo,
                        'meken_value' => $change,
                        'meken_after_value' => $change,
                        'status' => $change,
                        'meken_at' => DB::raw('CURRENT_TIMESTAMP'),
                    ]);
                }
            }
        // 上司
        } elseif($kengen == 1) {
            // 承認
            if($action == 'accept') {
                $change = 90;
            // 否認
            } elseif($action == 'reject') {
                $change = 91;
            // 不正
            } elseif($action == 'illegal') {
                $change = 33;
            // 判断不可
            } elseif($action == 'nojudge') {
                $change = 30;
            }
             // アップデート
            if($change) {
                if($change == 90) {
                    $duplicate = Receipt::where('id','!=',$re_id)->where('campaign_id', $campaign_id)->where('mk_date', $date)->where('mk_time', $time)->where('mk_value', $multi_value)->where('tel',$tel)->where('id','>',1999)->first();
                    if($duplicate) {
                        if($duplicate->user_id == $user_id) {
                            return redirect( route('merchant.meken.detail',$re_id) )->with('flash_message', "自分のレシートと重複しています。「承認」以外を選択してください。");
                        } else {
                            Receipt::where('receipts.id', $re_id)->update([
                                'status_double' => 1,
                            ]);
                            return redirect( route('merchant.meken.detail',$re_id) )->with('flash_message', "他者のレシートと重複しています。「承認」以外を選択してください。");
                        }
                    } else{
                        Receipt::where('id', $re_id)->update([
                            'total_price' => $multi_value_post,
                            'point' => $point,
                            'mk_value' => $multi_value,
                            'mk_date' => $date,
                            'mk_time' => $time,
                            'mk_tel' => $tel,
                            'receipt_memo' => $memo,
                            'meken_after_value' => $change,
                            'status' => $change,
                            'meken_at' => DB::raw('CURRENT_TIMESTAMP'),
                        ]);
                    }
                } else {
                    Receipt::where('id', $re_id)->update([
                        'total_price' => $multi_value_post,
                        'point' => $point,
                        'mk_value' => $multi_value,
                        'mk_date' => $date,
                        'mk_time' => $time,
                        'mk_tel' => $tel,
                        'receipt_memo' => $memo,
                        'meken_after_value' => $change,
                        'status' => $change,
                        'meken_at' => DB::raw('CURRENT_TIMESTAMP'),
                    ]);
                }
                if($action == 'accept') {
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
            }
        }
        if($kengen == 1) {
            return redirect($redirect_url);
        } else {
            return redirect(route("merchant.meken.list"));
        }
    }

    public function mekenWorks(Request $request)
    {
        // セッション
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        // 検索条件
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
        // 担当者セット
        $mk_users = $request->input('mk_user');
        if(!$mk_users) {
            $mk_users = [];
        }
        if($kengen == 1) {
            $tantous = MkUser::where('company_id', $company_id)->where('kengen', 0)->get();
        } elseif($kengen == 0) {
            $tantous = '';
        }
        // レシートテーブルベース
        $meken_select_btn = $request->input('meken_select_btn');
        $receipts = Receipt::select('receipts.id as receipt_id','receipts.*','mk_users.*','mk_statuses.*')->join('mk_users', 'receipts.mk_user_id', '=', 'mk_users.serial')->join('mk_statuses', 'mk_statuses.id', '=', 'receipts.meken_after_value');
        if($meken_select_btn == '検索') {
            // 目検日
            if($start_date || $end_date) {
                $receipts->whereBetween('meken_at', [$start_date, $end_date]);
            }
            if($mk_users) {
                $receipts->whereIn('mk_user_id', $mk_users);
            }
            $to_accept = $request->input('to_accept');
            $to_reject = $request->input('to_reject');
            $to_nojudge = $request->input('to_nojudge');
            $to_illegal = $request->input('to_illegal');
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
        if($kengen == 0) {
            $receipt_count = $receipts->where('mk_user_id',$meken_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->count();
            $receipts = $receipts->where('mk_user_id',$meken_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->paginate(20);
        } elseif($kengen == 1) {
            $receipt_count = $receipts->where('company_id', $company_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->count();
            $receipts = $receipts->where('company_id', $company_id)->whereBetween('meken_value',[20,100])->orderBy('meken_at')->paginate(20);
        }
        // 権限共通
        if($start_date == '2010-10-10') {
            $start_date = '';
        }
        if($end_date == '2030-10-10') {
            $end_date = '';
        }
        // 読み取りステータス
        $target_receipt_statuses = array('status_shop','status_double','status_multi','status_nodata');
        $receipt_statuses = ReceiptStatus::get();
        return view("merchant.work", [
            'category_name' => 'receipt',
            'page_name' => 'receipt_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '目検作業履歴',
            "meken_id" => $meken_id,
            "kengen" => $kengen,
            "company_id" => $company_id,
            "receipts" => $receipts,
            "start_date" => $start_date,
            "end_date" => $base_end_date,
            "receipt_count" => $receipt_count,
            "to_accept" => $to_accept,
            "to_reject" => $to_reject,
            "to_nojudge" => $to_nojudge,
            "to_illegal" => $to_illegal,
            "tantous" => $tantous,
            "mk_users" => $mk_users,
            'receipt_statuses' => $receipt_statuses,
            'target_receipt_statuses' => $target_receipt_statuses,
        ]);
    }

    public function logout(Request $request)
    {
        // セッション
        $meken_id = session('meken_id');
        $kengen = session('kengen');
        $company_id = session('company_id');
        Receipt::where('mk_user_id',$meken_id)->whereBetween('status',[10,19])->whereNull('meken_value')->update([
            'mk_user_id' => NULL,
        ]);
        $request->session()->flush();
        return redirect(route("merchant.meken.login"));
    }
    public function imgGet(Request $request)
    {
        return 'https://re-nt-upload.s3.ap-northeast-1.amazonaws.com/'.$request->input('receipt_path');
    }
}
