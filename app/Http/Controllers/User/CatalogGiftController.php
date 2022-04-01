<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignProduct;
use App\Models\Product;
use App\Models\UserCampaignPoint;
use App\Models\DeliveryTime;
use App\Models\ShippingAddress;
use App\Models\ProductCategory;
use App\Models\Apply;
use App\Models\ApplyStatus;
use App\Mail\Applied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CatalogGiftController extends Controller
{
    public function index(Request $request,$campaign_id)
    {
        $user = Auth::guard("user")->user();
        $min_point = $request->input('min_point');
        $max_point = $request->input('max_point');
        $category_id = $request->input('category_id');
        $category_name = $request->input('category_name');
        $keyword = $request->input('keyword');
        $search_word = null;
        $search_point = '';
        $search_category = '';
        $query_for_gifts = CampaignProduct::with("product")->
            whereCampaign($campaign_id)->
            canApply()->
            whereHas('product', function($query){
                $query->whereNull('variation_parent_id');
            });
        if($category_id) {
            $query_for_gifts = $query_for_gifts->whereHas('product.product_category', function($query) use($category_id){
                $query->where('id', $category_id)->orWhere('parent_id', $category_id);
            });
            $search_category = $category_name;
        }
        if($min_point) {
            $query_for_gifts = $query_for_gifts->whereBetween('point', [$min_point, $max_point]);
            if($min_point == "1") {
                $search_point = "〜1000ポイント";
            } elseif($min_point == "1001") {
                $search_point = "1001〜2000ポイント";
            } elseif($min_point == "2001") {
                $search_point = "2001ポイント〜";
            }
        }
        if($keyword) {
            $query_for_gifts = $query_for_gifts->whereHas('product', function($query) use($keyword){
                $query->where('name', 'like', "%$keyword%");
            });
            $search_word = $keyword;
        }
        $gifts = $query_for_gifts->paginate(20);

        // おすすめ5件
        $recommends = CampaignProduct::with("product")->whereCampaign($campaign_id)->whereNotNull('recommend')->whereHas('product', function($query){
            $query->whereNull('variation_parent_id');
        })->canApply()->take(5)->orderBy('recommend', 'asc')->get();

        // カテゴリー一覧
        list($parents, $children) = ProductCategory::withCount(["products" => function($query) use($campaign_id) {
                $query->join("campaign_products", "products.id", "=", "campaign_products.product_id")
                    ->where("campaign_products.campaign_id", $campaign_id)
                    ->isNotVariation();
            }])
            ->with("parent")
            ->get()
            ->partition(function($v) {
                return !$v->parent->id;
            })
            ;
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.gift.point.list", [
            'category_name' => 'gift',
            'page_name' => 'gift_point',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品一覧（ポイントカタログ）',
            "campaign_id" => $campaign_id,
            "gifts" => $gifts,
            "point" => $point,
            "min_point" => $min_point,
            "max_point" => $max_point,
            "category" => $category_id,
            "campaign" => $campaign,
            "recommends" => $recommends,
            "category_parents" => $parents,
            "category_children" => $children,
            "user" => $user,
            "search_word" => $search_word,
            "search_point" => $search_point,
            "search_category" => $search_category,
        ]);
    }

    public function pre_list(Request $request,$campaign_id)
    {
        $min_point = $request->input('min_point');
        $max_point = $request->input('max_point');
        $category_id = $request->input('category_id');
        $category_name = $request->input('category_name');
        $keyword = $request->input('keyword');
        $search_word = null;
        $search_point = '';
        $search_category = '';
        $query_for_gifts = CampaignProduct::with("product")->
            whereCampaign($campaign_id)->
            canApply()->
            whereHas('product', function($query){
                $query->whereNull('variation_parent_id');
            });
        if($category_id) {
            $query_for_gifts = $query_for_gifts->whereHas('product.product_category', function($query) use($category_id){
                $query->where('id', $category_id)->orWhere('parent_id', $category_id);
            });
            $search_category = $category_name;
        }
        if($min_point) {
            $query_for_gifts = $query_for_gifts->whereBetween('point', [$min_point, $max_point]);
            if($min_point == "1") {
                $search_point = "〜1000ポイント";
            } elseif($min_point == "1001") {
                $search_point = "1001〜2000ポイント";
            } elseif($min_point == "2001") {
                $search_point = "2001ポイント〜";
            }
        }
        if($keyword) {
            $query_for_gifts = $query_for_gifts->whereHas('product', function($query) use($keyword){
                $query->where('name', 'like', "%$keyword%");
            });
            $search_word = $keyword;
        }
        $gifts = $query_for_gifts->paginate(20);

        // おすすめ5件
        $recommends = CampaignProduct::with("product")->whereCampaign($campaign_id)->whereNotNull('recommend')->whereHas('product', function($query){
            $query->whereNull('variation_parent_id');
        })->canApply()->take(5)->orderBy('recommend', 'asc')->get();

        // カテゴリー一覧
        list($parents, $children) = ProductCategory::withCount(["products" => function($query) use($campaign_id) {
                $query->join("campaign_products", "products.id", "=", "campaign_products.product_id")
                    ->where("campaign_products.campaign_id", $campaign_id)
                    ->isNotVariation();
            }])
            ->with("parent")
            ->get()
            ->partition(function($v) {
                return !$v->parent->id;
            })
            ;

        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.gift.point.list", [
            'category_name' => 'gift',
            'page_name' => 'gift_point',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品一覧（ポイントカタログ）',
            "campaign_id" => $campaign_id,
            "gifts" => $gifts,
            "min_point" => $min_point,
            "max_point" => $max_point,
            "category" => $category_id,
            "campaign" => $campaign,
            "recommends" => $recommends,
            "category_parents" => $parents,
            "category_children" => $children,
            "search_word" => $search_word,
            "search_point" => $search_point,
            "search_category" => $search_category,
        ]);
    }

    public function show($campaign_id, $gift_id)
    {
        $user = Auth::guard("user")->user();
        $user_setmail = $user->email_verified_at;
        $gift = CampaignProduct::with(["product.product_category.parent", "product.variations"])
            ->whereCampaign($campaign_id)->canApply()->findOrFail($gift_id);
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $images = CampaignProduct::leftJoin('product_images','campaign_products.product_id','=','product_images.product_id')->where('campaign_products.id','=',$gift_id)->whereCampaign($campaign_id)->get();
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.gift.point.detail", [
            'category_name' => 'gift',
            'page_name' => 'gift_point_detail',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品詳細（ポイントカタログ）',
            "campaign_id" => $campaign_id,
            "gift" => $gift,
            "point" => $point,
            "campaign" => $campaign,
            "images" => $images,
            "user_setmail" => $user_setmail,
            "user" => $user,
        ]);
    }

    public function pre_show($campaign_id, $gift_id)
    {
        $gift = CampaignProduct::with(["product.product_category.parent", "product.variations"])
            ->whereCampaign($campaign_id)->canApply()->findOrFail($gift_id);
        $images = CampaignProduct::leftJoin('product_images','campaign_products.product_id','=','product_images.product_id')->where('campaign_products.id','=',$gift_id)->whereCampaign($campaign_id)->get();
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.gift.point.detail", [
            'category_name' => 'gift',
            'page_name' => 'gift_point_detail',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品詳細（ポイントカタログ）',
            "campaign_id" => $campaign_id,
            "gift" => $gift,
            "campaign" => $campaign,
            "images" => $images,
            "gift_id" => $gift_id,
        ]);
    }

    public function setProductToApply(Request $request, $campaign_id, $gift_id)
    {
        $user = Auth::guard("user")->user();
        $safe_data = $request->validate([
            "quantity" => ["required", "min:1"],
            "product_id" => ["required", "integer"],
        ]);

        $gift = CampaignProduct::whereCampaign($campaign_id)->canApply()->findOrFail($gift_id);
        $product = Product::findOrFail($safe_data["product_id"]);
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $deliveries = DeliveryTime::get();

        $safe_data["step"] = "set_product";
        $safe_data["campaign_id"] = $campaign_id;
        $safe_data["gift_id"] = $gift_id;

        $request->session()->put("apply", $safe_data);

        // 前回入力した発送先を初期データにする。
        $default_address = ShippingAddress::whereHas("apply", function($query) use($campaign_id) {
                $query->join("campaign_products", "applies.campaign_product_id", "=", "campaign_products.id")
                    ->where("applies.user_id", Auth::guard("user")->id())
                    ->where("campaign_products.campaign_id", $campaign_id);
            })
            ->orderBy("updated_at", "desc")
            ->firstOrNew([]);

        // 発送先履歴
        $address_histories = ShippingAddress::whereHas("apply", function($query) use($campaign_id) {
                $query->join("campaign_products", "applies.campaign_product_id", "=", "campaign_products.id")
                    ->where("applies.user_id", Auth::guard("user")->id())
                    ->where("campaign_products.campaign_id", $campaign_id);
            })
            ->select([
                "last_name",
                "first_name",
                "last_name_kana",
                // "first_name_kana",
                "post_code",
                "prefectures",
                "municipalities",
                "address_code",
                "building",
                "tel",
                "delivery_time_id",
            ])
            ->distinct()
            ->get();

        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.gift.point.order", [
            'category_name' => 'gift',
            'page_name' => 'gift_order',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '発送先の入力（ポイントカタログ交換画面）',
            "campaign_id" => $campaign_id,
            "gift" => $gift,
            "product" => $product,
            "quantity" => $safe_data["quantity"],
            "point" => $point,
            "default_address" => $default_address,
            "address_histories" => $address_histories,
            "campaign" => $campaign,
            "deliveries" => $deliveries,
            "user" => $user,
        ]);
    }

    public function setAddressToApply(Request $request, $campaign_id, $gift_id)
    {
        
        // リクエストデータとセッションデータの関係性が正しいかどうか検証する。
        $apply_session = $request->session()->get("apply", false);
        if($apply_session === false or $apply_session["step"] !== "set_product") {
            // エラー
            $request->session()->forget("apply");
            return redirect(route('campaign.catalog.gift.show', [$campaign_id, $gift_id]));
        }

        if($campaign_id != $apply_session["campaign_id"] or $gift_id != $apply_session["gift_id"]) {
            return redirect(route('campaign.catalog.gift.show', [$campaign_id, $gift_id]));
        }
        // リクエストデータをバリデーション
        $safe_data = array(
            "last_name" => $request->last_name,
            "first_name" => $request->first_name,
            "last_name_kana" => $request->last_name_kana,
            "post_code" => $request->post_code,
            "prefectures" => $request->prefectures,
            "municipalities" => $request->municipalities,
            "address_code" => $request->address_code,
            "building" => $request->building,
            "tel" => $request->tel,
            "delivery_time_id" => $request->delivery_time_id,
        );
        // $safe_data = $request->validate([
        //     "last_name" => ["required", "string"],
        //     // "first_name" => ["required", "string"],
        //     "last_name_kana" => ["required", "regex:/^[ァ-ヶー]+$/u"],
        //     // "first_name_kana" => ["required", "regex:/^[ァ-ヶー]+$/u"],
        //     "post_code" => ["required", "regex:/^\d{3}[-]\d{4}$/"],
        //     "prefectures" => ["required", "string"],
        //     "municipalities" => ["required", "string"],
        //     "address_code" => ["required", "string"],
        //     "building" => ["nullable", "string"],
        //     "tel" => ["required", "regex:/^\d[\d-]*\d$/"],
        //     "delivery_time_id" => ["required", "integer"],
        // ]);

        // 応募データを作るうえで、キャンペーン、ギフト、商品の関係性が正しいかどうか検証する。
        $gift = CampaignProduct::findOrFail($gift_id);

        // $rule = $gift->getRule();
        // if(!$rule instanceof CatalogGiftRule) {}
        // if(!$rule->canApply($campaign_id) {}
        // if(!$rule->getProduct()->include($safe_data["product_id"])) {}
        if(!$gift->is_catalog_product()) throw new Exception("この景品には応募できません。");
        if(!$gift->can_apply($campaign_id)) throw new Exception("この景品には応募できません。");

        if($gift->product->id != $apply_session["product_id"]) {
            if($gift->product->variations->where("id", $apply_session["product_id"])->isEmpty()) {
                throw new Exception("この景品には応募できません。");
            }
        }

        // エンドユーザーの整合性チェック
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        if($point->remaining_point < $gift->point * $apply_session["quantity"]) {
            throw new Exception("ポイント不足のため応募できません。");
        }

        $user = $request->user();
        if(!$user->hasVerifiedEmail()) {
            throw new Exception("メールアドレスが未設定のため応募できません。");
        }

        // 応募ロジック
        $apply = null;
        DB::transaction(function() use(&$apply, $safe_data, $apply_session, $gift, $point) {
            // 応募データ生成
            $apply = Apply::create([
                "quantity" => $apply_session["quantity"],
                "apply_status_id" => ApplyStatus::APPLYING,
                "user_id" => $point->user_id,
                "campaign_product_id" => $gift->id,
                "product_id" => $apply_session["product_id"],
            ]);
            $address = ShippingAddress::create($safe_data);
            $apply->shipping_address()->associate($address);
            $apply->changeStatus(ApplyStatus::WAITING_ADDRESS);
            // 応募分のポイントをマイナス
            $point->remaining_point -= $gift->point * $apply_session["quantity"];
            $point->save();
        });
        
        Mail::send(new Applied($user, Campaign::findOrFail($campaign_id), $apply));

        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $request->session()->forget("apply");
        $campaign = Campaign::findOrFail($campaign_id);
        return view("user.gift.point.order_complete", [
            'category_name' => 'gift',
            'page_name' => 'gift_order_complete',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'point' => $point,
            'title' => '景品交換完了（ポイントカタログ交換）',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "user" => $user,
        ]);
    }
}