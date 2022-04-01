<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Models\Receipt;
use App\Models\FlatShopTreeElement;
use App\Models\UsersPrePoint;
use App\Models\Ngword;
use App\Models\Ng;
use App\Models\OcrList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
// use Intervention\Image\Facades\Image;
// use \InterventionImage;
// use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

class ReceiptController extends Controller
{
    // レシート一覧
    public function index(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $user_id = Auth::id();
        $campaign = Campaign::findOrFail($campaign_id);
        $select_re_status = $request->input('select_re_status');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $search_date = '';
        $search_status = '';
        $search_word = '';
        if($start_date && $end_date) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $search_date = '検索期間：'.$start_date.'〜'.$end_date;
        } elseif($start_date) {
            $start_date = $request->input('start_date');
            $end_date = '2030-10-10';
            $search_date = '検索期間：'.$start_date.'〜';
        } elseif($end_date) {
            $start_date = '2010-10-10';
            $end_date = $request->input('end_date');
            $search_date = '検索期間：〜'.$end_date;
        }
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        if($start_date || $end_date) {
            if($select_re_status == '0') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereBetween('pay_date', [$start_date, $end_date])->orderBy('id', 'desc')->get();
                $search_status = '全て';
            } elseif($select_re_status == '1') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereIn( 'status', [100] )->whereBetween('pay_date', [$start_date, $end_date])->orderBy('id', 'desc')->get();
                $search_status = 'ポイント付与済み';
            } elseif($select_re_status == '2') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereNotIn( 'status', [91, 92, 96, 97, 98, 99, 100] )->whereBetween('pay_date', [$start_date, $end_date])->orderBy('id', 'desc')->get();
                $search_status = '確認中';
            } elseif($select_re_status == '3') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereIn( 'status', [91, 92, 96, 97, 98, 99] )->whereBetween('pay_date', [$start_date, $end_date])->orderBy('id', 'desc')->get();
                $search_status = '否認';
            } else {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereBetween('pay_date', [$start_date, $end_date])->orderBy('id', 'desc')->get();
            }
        } else {
            if($select_re_status == '0') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->orderBy('id', 'desc')->get();
                $search_status = '全て';
            } elseif($select_re_status == '1') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereIn( 'status', [100] )->orderBy('id', 'desc')->get();
                $search_status = 'ポイント付与済み';
            } elseif($select_re_status == '2') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereNotIn( 'status', [91, 92, 96, 97, 98, 99, 100] )->orderBy('id', 'desc')->get();
                $search_status = '確認中';
            } elseif($select_re_status == '3') {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->whereIn( 'status', [91, 92, 96, 97, 98, 99] )->orderBy('id', 'desc')->get();
                $search_status = '否認';
            } else {
                $receipts = Receipt::where('campaign_id',$campaign_id)->where('user_id',$user_id)->orderBy('id', 'desc')->get();
            }
        }
        if($search_status && $search_date) {
            $search_word = 'ステータス：'.$search_status.'　'.$search_date;
        } elseif($search_status) {
            $search_word = 'ステータス：'.$search_status;
        } elseif($search_date) {
            $search_word = $search_date;
        }
        // この日付より前だとポイント付与済み
        $now = date("Y-m-d H:i:s",strtotime("-5 day"));
        return view("user.receipt.list", [
            'category_name' => 'receipt',
            'page_name' => 'receipt_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'レシート送信履歴',
            "campaign" => $campaign,
            "point" => $point,
            "campaign_id" => $campaign_id,
            "user" => $user,
            "receipts" => $receipts,
            "now" => $now,
            "search_word" => $search_word,
        ]);
    }

    // レシート撮影画面
    public function snap(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $user_id = Auth::id();
        $campaign = Campaign::findOrFail($campaign_id);
        $campaign_shop_tree = "1";
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $parents = FlatShopTreeElement::where('depth','=',2)->get();
        $children = FlatShopTreeElement::where('depth','=',3)->get();
        $ocr_lists = OcrList::where('campaign_id',$campaign_id)->where('level',0)->first();
        $level1_lists = OcrList::where('campaign_id',$campaign_id)->where('level',1)->get();
        return view("user.snap.snap", [
            'category_name' => 'receipt',
            'page_name' => 'receipt',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'レシート送信画面',
            "campaign" => $campaign,
            "point" => $point,
            "campaign_id" => $campaign_id,
            "user" => $user,
            "campaign_shop_tree" => $campaign_shop_tree,
            "parents" => $parents,
            "children" => $children,
            "ocr_value" => $ocr_lists->products,
            "level1_lists" => $level1_lists,
        ]);
    }

    // レシート送信完了
    public function snapComplete(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $user_id = Auth::id();
        $campaign = Campaign::findOrFail($campaign_id);
        $campaign_shop_tree = "1";
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $parents = FlatShopTreeElement::where('depth','=',2)->get();
        $children = FlatShopTreeElement::where('depth','=',3)->get();
        $ocr_lists = OcrList::where('campaign_id',$campaign_id)->where('level',0)->first();
        $level1_lists = OcrList::where('campaign_id',$campaign_id)->where('level',1)->get();
        return view("user.snap.snap_complete", [
            'category_name' => 'receipt',
            'page_name' => 'receipt',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'レシート送信画面',
            "campaign" => $campaign,
            "point" => $point,
            "campaign_id" => $campaign_id,
            "user" => $user,
            "campaign_shop_tree" => $campaign_shop_tree,
            "parents" => $parents,
            "children" => $children,
            "ocr_value" => $ocr_lists->products,
            "level1_lists" => $level1_lists,
        ]);
    }

    // レシート送信エラー
    public function snapError(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $user_id = Auth::id();
        $campaign = Campaign::findOrFail($campaign_id);
        $campaign_shop_tree = "1";
        $point = UserCampaignPoint::firstOrNew(["user_id" => $user->id, "campaign_id" => $campaign_id]);
        $parents = FlatShopTreeElement::where('depth','=',2)->get();
        $children = FlatShopTreeElement::where('depth','=',3)->get();
        $ocr_lists = OcrList::where('campaign_id',$campaign_id)->where('level',0)->first();
        $level1_lists = OcrList::where('campaign_id',$campaign_id)->where('level',1)->get();
        return view("user.snap.snap_error", [
            'category_name' => 'receipt',
            'page_name' => 'receipt',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'レシート送信エラー',
            "campaign" => $campaign,
            "point" => $point,
            "campaign_id" => $campaign_id,
            "user" => $user,
            "campaign_shop_tree" => $campaign_shop_tree,
            "parents" => $parents,
            "children" => $children,
            "ocr_value" => $ocr_lists->products,
            "level1_lists" => $level1_lists,
        ]);
    }

    // レシート受け付け前処理
    public function snapBefore(Request $request, $campaign_id)
    {
        $user = Auth::guard("user")->user();
        $user_id = Auth::id();
        $campaign = Campaign::findOrFail($campaign_id);
        $campaign_shop_tree = "1";
        // 情報セット
        $pay_date = $request->input('pay_date'); //日付
        $time = $request->input('time'); //時間
        $tel = $request->input('tel'); //電話番号
        $re_value = $request->input('re_value'); //数量
        $isNg = $request->input('isNg'); //NGワード
        $dateInt = $request->input('dateInt'); //レシート発行日ハイフンなし
        $items = $request->input('items'); //対象商品
        $str = $request->input('str'); //レシート文字
        $re_point = $request->input('re_point'); //ポイント
        $len_ng = $request->input('ren_ng');//jsからのlengthチェック
        $startTime = $campaign->start_datetime_to_convert_receipts_to_points->format('Ymd'); //キャンペーン開始日
        $endTime = $campaign->end_datetime_to_convert_receipts_to_points->format('Ymd'); //キャンペーン終了日
        $safe_day = new Carbon('-21 day'); //21日前
        $safe_day = $safe_day->format('Ymd'); //日付フォーマット
        $safe_day = (int) $safe_day; //日付フォーマット
        $ngs = Ngword::select('name')->where('campaign_id',$campaign_id)->where('level',1)->get();
        
        // 最初にNGワード確認
        $isNg = 0;
        foreach($ngs as $ng) {
            $isNg += substr_count($str, $ng->name);
        };
        if($isNg > 0) {
            $re_value = (float) $re_value;
            Ng::insert([
                'campaign_id' => $campaign_id,
                'user_id' => $user_id,
                'str' => $str,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $result = array(
                'result' => false,
                'ng' => 'ng',
                'alert' => "本キャンペーン対象外のレシートのため、申し訳ありませんが読み取りできません。 (81)",
            );
            return $result;
        }
        // 店舗情報確認
        $shop = FlatShopTreeElement::where('root_id', 1)->where('depth', 3)->where('tel', $tel)->count();
        if($shop == 0) {
            $result = array(
                'result' => false,
                'shop' => 'ng',
                'alert' => "本キャンペーン対象外のレシートのため、申し訳ありませんが読み取りできません。 (61)",
            );
            return $result;
        }
        // 特定店舗確認
        $ill_shop = false;
        $ill_lists = OcrList::where('campaign_id',$campaign_id)->where('level',2)->get();
        foreach($ill_lists as $ill_list) {
            $ill_list_tel = $ill_list->tel;
            if($tel == $ill_list_tel) {
                $ill_shop = true;
                $result = array(
                    'result' => true,
                    'shop' => 'illegal',
                );
                return $result;
            } else {
                $ill_shop = false;
            }
        }
        // 対象期間のチェック
        if(!$pay_date || !$time) { //日付か時間のどちらかが空の場合
            $result = array(
                'result' => false,
                'alert' => "レシートが正しく読取できません。\nお手数ですが、再撮影をお願いします。 (52)",
            );
            return $result;
        }
        // 本番用計算
        if(($dateInt < $startTime || $dateInt > $endTime) || $dateInt < $safe_day){
        // if($dateInt < $startTime || $dateInt > $endTime){
            $result = array(
                'result' => false,
                'alert' => "このレシートは対象期間外か読み取り期限を過ぎています。\n読み取り期限は発行日から20日以内です。",
            );
            return $result;
        }
        // 対象商品
        $value_count = 0;
        $value_count = substr_count($re_value, '.');
        if(!$items || (!$re_value || !$re_point || $re_point == '0' || $re_point == 'NaN' || $len_ng == true || $value_count == 0)) {
            $result = array(
                'result' => false,
                'alert' => "レシートが正しく読取できません。\nお手数ですが、再撮影をお願いします。 (12)",
            );
            return $result;
        } elseif(!$items && (!$re_value || !$re_point || $re_point == '0' || $re_point == 'NaN' || $len_ng == true)) {
            $result = array(
                'result' => false,
                'alert' => "本キャンペーン対象外のレシートのため、申し訳ありませんが読み取りできません。 (11)",
            );
            return $result;
        }
        // 電話番号存在チェック
        if(!$tel) {
            $result = array(
                'result' => false,
                'shop' => 'none',
                'alert' => "レシートが正しく読取できません。\nお手数ですが、再撮影をお願いします。 (62)",
            );
            return $result;
        }
        // 重複チェック
        $self = 0; $other = 0;
        $doubles = Receipt::select('user_id')->where('campaign_id', $campaign_id)->where('mk_date', $pay_date)->where('mk_time', $time)->where('mk_value', $re_value)->where('tel',$tel)->get();
        if($doubles->isNotEmpty()) {
            foreach($doubles as $double) {
                if($double->user_id == $user_id) {
                    $self += 1;
                } else {
                    $other += 1;
                }
            }
            if($self > 0) {
                $result = array(
                    'result' => false,
                    'double' => 'self',
                    'alert' => '既に送信済みのレシートです。',
                );
            } elseif($other > 0) {
                $result = array(
                    'result' => false,
                    'double' => 'other',
                    'alert' => "重複するレシートを検知しました。\nご自身のレシートでお間違いなければ\n「このまま送信」で送信してください。",
                );
            }
            return $result;
        }
        $result = array(
            'result' => true,
        );
        return $result;
    }

    // レシート送信
    public function snapSend(Request $request, $campaign_id)
    {
        // 基本情報
        $user = Auth::guard("user")->user();
        $user_id = Auth::id();
        $campaign = Campaign::findOrFail($campaign_id);
        $campaign_shop_tree = "1";
        // 情報セット
        $str = $request->input('str');
        $tel = $request->input('tel');
        $no = $request->input('no');
        $pay_date = $request->input('pay_date');
        $time = $request->input('time');
        $point = $request->input('point');
        $val = $request->input('val');
        $base_oil = $request->input('base_oil');
        $products = $request->input('products');
        $shopNg = $request->input('shopNg');
        $com = $request->input('com');
        $isDouble = $request->input('isDouble');
        $light_ngs = Ngword::select('name')->where('campaign_id',$campaign_id)->where('level',2)->get();
        $tel_company = '';
        // 画像
        $file = $request->file('image');
        // 店舗名検索
        $tel_company = FlatShopTreeElement::where('root_id', 1)->where('depth', 3)->where('tel', $tel)->first();
        $tel_company = $tel_company->name;
        if(!$tel_company) {
            $isShopNg = 1;
        }
        // ステータスプリセット
        $status_product = 0; //1_対象商品
        $status_oil = 0; //2_給油量
        $status_input = 0; //3_自己申告
        $status_diff = 0; //4_自己申告と実際の給油量の差
        $status_term = 0; //5_対象期間
        $status_shop = 0; //6_対象店舗
        $status_double = 0; //7_重複
        $status_ngword = 0; //8_NGワード
        $status_count = 0; //9_強制送信
        $status_multi = 0; //複数商品あり
        $status_status = 0; //全てのステータス
        // 特定店舗
        if($shopNg == 1) {
            $status_shop = 1;
            $status_status = 11;
        }
        // 複数商品あり
        $multi_count = 0;
        $multi_count = substr_count($products, '.');
        if($multi_count > 1) {
            $status_multi = 1;
            $status_status = 11;
        }
        // NGワード
        $isLightNg = 0;
        foreach($light_ngs as $light_ng) {
            $isLightNg += substr_count($str, $light_ng->name);
        };
        if($isLightNg > 0) {
            $status_ngword = 2;
        }
        // 7_重複 000000100
        if($isDouble == 1) {
            $status_double = 1;
            $status_status = 31;
        }
        // 最終ステータス
        $status = $status_product.$status_oil.$status_input.$status_diff.$status_term.$status_shop.$status_double.$status_ngword.$status_count;
        // デバッグ用
        if($request->input('test_send') == '送信') {
            ddd([
                '特定店舗' => $status_shop,
                '複数商品' => $status_multi,
                'NGワード' => $status_ngword,
                '重複' => $status_double,
            ]);
        }
        // S3設定
        $bucket = 're-nt-upload';
        $key = 'AKIAXX2QIUVNC3XBKYRO';
        $secret = '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';
        $s3 = new S3Client(array(
                'version' => 'latest',
                'credentials' => array(
                'key' => $key,
                'secret' => $secret,
            ),
            'region'  => 'ap-northeast-1',
        ));
        // S3に画像アップロード
        $now = date_format(Carbon::now(), 'YmdHis');
        $tempPath = $file->getRealPath();
        $upfile = 'receipts/'.$campaign_id.'/'.$user_id.'_'.date("YmdHis").'.jpg';
        $result = $s3->putObject(array(
            'Bucket' => $bucket,
            'Key' => 'receipts/'.$campaign_id.'/'.$user_id.'_'.date("YmdHis").'.jpg',
            'Body' => fopen($file, 'rb'),
            'ACL' => 'public-read',
            'ContentType' => mime_content_type($tempPath),
        ));
        // ポイント計算
        $point = floor((int) $val / 25);
        $self = Receipt::where('campaign_id', $campaign_id)->where('user_id', $user_id)->where('mk_date', $pay_date)->where('mk_time', $time)->where('mk_value', $val)->count();
        // float
        $base_oil = (float) $base_oil;
        $val = (float) $val;
        if($self == 0) {
            Receipt::insert([
                'campaign_id' => $campaign_id,
                'user_id' => $user_id,
                'point' => $point,
                'products' => $products,
                'tel' => $tel,
                'no' => $no,
                'status' => $status_status,
                'pay_date' => $pay_date,
                'time' => $time,
                'receipt_path' => $upfile,
                'mk_status' => $status,
                'status_product' => $status_product,
                'status_oil' => $status_oil,
                'status_input' => $status_input,
                'status_diff' => $status_diff,
                'status_term' => $status_term,
                'status_shop' => $status_shop,
                'status_double' => $status_double,
                'status_ngword' => $status_ngword,
                'status_count' => $status_count,
                'status_multi' => $status_multi,
                'status_nodata' => 0,
                'tel_company' => $tel_company,
                'company' => $com,
                'receipt_value' => $base_oil,
                'receipt_str' => $str,
                'mk_no' => $no,
                'mk_tel' => $tel,
                'mk_date' => $pay_date,
                'mk_time' => $time,
                'mk_value' => $val,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // 送信したレシートをチェックしてプレポイントへ追加
            $check = Receipt::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
            $this_status = $check->status;
            if($this_status == 0) {
                $id = $check->id;
                $point = $check->point;
                UsersPrePoint::insert([
                    'receipt_id' => $id,
                    'point' => $point,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $result = array(
            'result' => true,
            'path' => $tempPath,
        );
        return $result;
    }
}
