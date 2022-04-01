<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignProduct;
use App\Models\GiftDeliveryMethod;
use App\Models\LotteryType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignProductController extends Controller
{
    public function create()
    {
        return view("admin.project.product.create", [
            'category_name' => 'project',
            'page_name' => 'project_product_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン景品追加',
        ]);
    }

    public function store(Request $request, $id)
    {
        //
    }

    public function editLotteryGift($id)
    {
        $campaign = Campaign::with("products.children.product")->isLotteryType()->findOrFail($id);
        $courses = $campaign->products;
        $products = Product::get();
        return view("admin.project.product.course_dev", [
            'category_name' => 'project',
            'page_name' => 'project_product',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン景品確認・編集（抽選型）',
            "campaign_id" => $id,
            "courses" => $courses,
            "products" => $products,
        ]);
    }

    public function updateLotteryGift(Request $request, $id)
    {
        $campaign = Campaign::with("products.products")->isLotteryType()->findOrFail($id);

        $request->validate([
            // "courses" => ["present", "array"],
            "courses.*.name" => ["required", "string"],
            "courses.*.point" => ["required", "integer"],
            "courses.*.win_rate" => ["required_if:courses.*.lottery_type_id,1", "nullable", "numeric"],
            "courses.*.products" => ["required", "array"],
            "courses.*.products.*.id" => ["nullable", "integer"],
            "courses.*.products.*.win_limit" => ["required_if:courses.*.lottery_id,2", "nullable", "integer"],
            "courses.*.products.*.product.id" => ["required", "integer"],
        ]);

        DB::transaction(function() use($request, $campaign) {
            // リクエストに存在しない既存データを削除する。
            $old_courses = $campaign->products()->pluck("id")->toArray();
            $new_courses = array_map(function($v) {
                return $v["id"];
            }, $request->input("courses", []));
            $delete_courses = array_diff($old_courses, $new_courses);
            CampaignProduct::whereIn("id", $delete_courses)->delete();
            
            $old_products = [];
            $campaign->products->each(function($course) use(&$old_products) {
                $old_products = array_merge($old_products, $course->products->pluck("id")->toArray());
            });
            $new_products = [];
            collect($request["courses"])->each(function($course) use(&$new_products) {
                $new_products = array_merge($new_products, collect($course["products"])->pluck("id")->toArray());
            });
            $delete_products = array_diff($old_products, $new_products);
            CampaignProduct::whereIn("id", $delete_products)->delete();

            // リクエストデータを登録
            foreach($request->input("courses", []) as $course_data) {
                $course = CampaignProduct::updateOrCreate(
                    ["id" => $course_data["id"]],
                    [
                        "campaign_id" => $campaign->id,
                        "name" => $course_data["name"],
                        "point" => $course_data["point"],
                        "win_rate" => $course_data["win_rate"],
                        "lottery_type_id" => LotteryType::INSTANT,
                    ],
                );
    
                $products = [];
                foreach($course_data["products"] as $product_data) {
                    $products[] = CampaignProduct::updateOrCreate(
                        ["id" => $product_data["id"]],
                        [
                            "product_id" => $product_data["product"]["id"],
                            "win_limit" => $product_data["win_limit"],
                        ],
                    );
                }
                $course->products()->saveMany($products);
            }
        });

        return redirect(route("admin.project.index"));
    }

    public function editCatalogGift(Request $request, $id)
    {
        $campaign = Campaign::isCatalogType()->findOrFail($id);
        $products = Product::with(["campaign_products" => function($query) use($campaign) {
            $query->where("campaign_id", $campaign->id);
        }])->isNotVariation()->paginate(10);
        $gifts_saved_session = collect();

        if($request->isMethod("put")) {
            // リクエストをバリデート
            // チェックボックスが外れていると、そもそもPOSTされないため初期データが表示されてしまう。
            // なので is_checked がない場合は空文字列をセットすることでその現象を回避する。
            $request->validate([
                "gifts" => ["required", "array"],
            ]);
            $tmp = $request->all();
            foreach($tmp["gifts"] as &$item) {
                if(!isset($item["is_checked"])) {
                    $item["is_checked"] = "";
                }
            }
            $request->replace($tmp);

            $safe_data = $request->validate([
                "gifts" => ["required", "array"],
                "gifts.*.point" => ["required_if:gifts.*.is_checked,on", "nullable", "integer", "min:1"],
                "gifts.*.gift_delivery_method_id" => ["required", "integer"],
                "gifts.*.product_id" => ["required", "integer"],
                "gifts.*.id" => ["nullable", "integer"],
                "gifts.*.is_checked" => ["nullable"],
            ]);

            // セッションに保存
            $ss = $request->session();
            $gifts = collect($ss->get("edit_catalog_gift", []))->keyBy("product_id");
            foreach($safe_data["gifts"] as $gift) {
                $product_id = $gift["product_id"];
                $gifts[$product_id] = $gift;
            }
            $ss->put("edit_catalog_gift", $gifts->toArray());

            // セッションと同じものをビューに渡す用
            $gifts_saved_session = $gifts;
        }
        else {
            // セッションをクリア
            $request->session()->forget("edit_catalog_gift");
        }

        $delivery_methods = GiftDeliveryMethod::get();
        return view("admin.project.product.point", [
            'category_name' => 'project',
            'page_name' => 'project_product_point',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン景品確認・編集（ポイントカタログ型）',
            "campaign_id" => $id,
            "products" => $products,
            "delivery_methods" => $delivery_methods,
            "gifts_saved_session" => $gifts_saved_session,
        ]);
    }

    public function updateCatalogGift(Request $request, $id)
    {
        $campaign = Campaign::with("products")->isCatalogType()->findOrFail($id);

        // チェックボックスが外れていると、そもそもPOSTされないため初期データが表示されてしまう。
        // なので is_checked がない場合は空文字列をセットすることでその現象を回避する。
        $request->validate([
            "gifts" => ["required", "array"],
        ]);
        $tmp = $request->all();
        foreach($tmp["gifts"] as &$item) {
            if(!isset($item["is_checked"])) {
                $item["is_checked"] = "";
            }
        }
        $request->replace($tmp);


        $safe_data = $request->validate([
            "gifts" => ["required", "array"],
            "gifts.*.point" => ["required_if:gifts.*.is_checked,on", "nullable", "integer", "min:1"],
            "gifts.*.gift_delivery_method_id" => ["required", "integer"],
            "gifts.*.product_id" => ["required", "integer"],
            "gifts.*.id" => ["nullable", "integer"],
            "gifts.*.is_checked" => ["nullable"],
        ]);

        // DBからも取ってくる必要あり。そうしないと、ページネーションしなかった部分がセッションにないので登録削除になってしまうため。
        $gifts = CampaignProduct::whereCampaign($id)
            ->get()
            ->mapWithKeys(function($v) {
                return [
                    $v->product_id => [
                        "id" => $v->id,
                        "point" => $v->point,
                        "gift_delivery_method_id" => $v->gift_delivery_method_id,
                        "product_id" => $v->product_id,
                        "is_checked" => "on",
                    ]
                ];
            })
            ;

        // 今回のページ内容とセッションをマージ
        $ss = $request->session();
        $gifts_in_session = collect($ss->get("edit_catalog_gift", []))->keyBy("product_id");
        foreach($safe_data["gifts"] as $gift) {
            $product_id = $gift["product_id"];
            $gifts_in_session[$product_id] = $gift;
        }

        // DBとセッションをマージ
        foreach($gifts_in_session as $gift) {
            $product_id = $gift["product_id"];
            $gifts[$product_id] = $gift;
        }

        DB::transaction(function() use($gifts, $campaign) {
            // リクエストに存在しない既存データを削除する。
            CampaignProduct::whereIn("id", $gifts->where("is_checked", false)->pluck("id"))->delete();

            // リクエストデータを登録
            $request_gifts = $gifts->where("is_checked", "on");
            foreach($request_gifts as $gift) {
                CampaignProduct::updateOrCreate(
                    ["id" => $gift["id"]],
                    [
                        "campaign_id" => $campaign->id,
                        "product_id" => $gift["product_id"],
                        "point" => $gift["point"],
                        "gift_delivery_method_id" => $gift["gift_delivery_method_id"],
                    ],
                );
            }
        });

        $request->session()->forget("edit_catalog_gift");

        return redirect(route("admin.project.index"));
    }
}
