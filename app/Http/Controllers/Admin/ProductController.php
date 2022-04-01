<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\ApplyStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Supplier;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use SplFileObject;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with("product_category", "supplier")->isNotVariation()->get();
        return view("admin.product.list", [
            'category_name' => 'product',
            'page_name' => 'product',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品一覧',
            "products" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::getProductCategoryList();
        $suppliers = Supplier::get();
        return view("admin.product.create", [
            'category_name' => 'product',
            'page_name' => 'product_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品追加',
            "product_categories" => $categories,
            "suppliers" => $suppliers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            "variations" => $request->input("variations", []),
            "images" => $request->input("images", []),
        ]);

        $request->validate([
            "name" => ["required", "string"],
            "product_category_id" => ["nullable", "integer"],
            "catalog_basic_point" => ["nullable", "integer"],
            "basic_win_limit" => ["nullable", "integer"],
            "maker_name" => ["nullable", "string"],
            "maker_url" => ["nullable", "string"],
            "description_1" => ["nullable", "string"],
            "description_2" => ["nullable", "string"],
            "notice" => ["nullable", "string"],
            "supplier_id" => ["required", "integer"],
            "operation_id" => ["nullable", "string"],
            "variations" => ["present", "array"],
            "variations.*.variation_name" => ["required", "string"],
            "variations.*.operation_id" => ["nullable", "string"],
            "images" => ["present", "array"],
            "images.*.image_file" => ["filled", "file"],
        ]);

        DB::transaction(function() use($request) {
            $product = Product::create($request->all());
            // バリエーション生成
            $variations = collect($request->variations)->map(function($v) use($request) {
                $p = new Product();
                $p->fill($request->all());
                $p->variation_name = $v["variation_name"];
                $p->operation_id = $v["operation_id"];
                $p->save();
                return $p;
            });
            $product->variations()->saveMany($variations);
            // 画像ファイル生成
            $images = collect($request->images)->map(function($v) use($product) {
                $file = $v["image_file"];
                $file_name = $file->getClientOriginalName();
                $file->move(public_path("uploads/"), $file_name);
                $image = new ProductImage();
                $image->fill([
                    "path" => $file_name,
                ]);
                $image->product()->associate($product);
                $image->save();
                return $image;
            });
            $product->images()->saveMany($images);
        });

        return redirect()->route("admin.product.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(["variations", "images"])->isNotVariation()->findOrFail($id);
        $categories = ProductCategory::getProductCategoryList();
        $suppliers = Supplier::get();
        return view("admin.product.edit", [
            'category_name' => 'product',
            'page_name' => 'product_edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品修正',
            "product" => $product,
            "product_categories" => $categories,
            "suppliers" => $suppliers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // ddd($request->all());
        $request->merge([
            "variations" => $request->input("variations", []),
            "images" => $request->input("images", []),
        ]);

        $safe_data = $request->validate([
            "name" => ["required", "string"],
            "product_category_id" => ["nullable", "integer"],
            "catalog_basic_point" => ["nullable", "integer"],
            "basic_win_limit" => ["nullable", "integer"],
            "maker_name" => ["nullable", "string"],
            "maker_url" => ["nullable", "string"],
            "description_1" => ["nullable", "string"],
            "description_2" => ["nullable", "string"],
            "notice" => ["nullable", "string"],
            "supplier_id" => ["required", "integer"],
            "operation_id" => ["nullable", "string"],
            "variations" => ["present", "array"],
            "variations.*.id" => ["filled", "integer"],
            "variations.*.variation_name" => ["required", "string"],
            "variations.*.operation_id" => ["nullable", "string"],
            "images" => ["present", "array"],
            "images.*.id" => ["filled", "integer"],
            "images.*.path" => ["required_with:images.*.id", "string"],
            "images.*.image_file" => ["required_without:images.*.id", "file"],
        ]);

        // ddd($request->all());

        DB::transaction(function() use($safe_data, $product) {
            $product->update($safe_data);
            // バリエーション設定
            // 削除
            $old_ids = $product->variations->pluck("id");
            $new_ids = collect($safe_data["variations"])->pluck("id");
            $delete_ids = $old_ids->diff($new_ids);
            Product::whereIn("id", $delete_ids)->delete();
            // 追加
            $variations = collect($safe_data["variations"])->map(function($v) use($safe_data) {
                $p = Product::findOrNew($v["id"] ?? "");
                $p->fill($safe_data);
                $p->variation_name = $v["variation_name"];
                $p->operation_id = $v["operation_id"];
                $p->save();
                return $p;
            });
            $product->variations()->saveMany($variations);
            // 画像ファイル設定
            // 削除
            $old_ids = $product->images->pluck("id");
            $new_ids = collect($safe_data["images"])->pluck("id");
            $delete_ids = $old_ids->diff($new_ids);
            ProductImage::whereIn("id", $delete_ids)->delete();
            // 追加
            collect($safe_data["images"])->where("id", null)->each(function($v) use($product) {
                $this->createProductImage($product, $v);
            });
        });

        return redirect()->route("admin.product.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 外部キー制約でエラーになると思うのでソフトデリートに変えるべき。
        Product::destroy($id);
        return back();
    }

    public function uploadCsv()
    {
        return view("kano.admin.product.upload_csv");
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            "csv" => ["required", "file"],
        ]);

        $file_info = $request->file("csv");
        $file_object = $file_info->openFile();
        $file_object->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);
        $loop_counter = 0;
        foreach($file_object as $row) {
            if($loop_counter++ < 2) continue;
            $t = [];
            $t["supplier_id"] = $row[1];
            $t["operation_id"] = $row[2];
            $t["name"] = $row[3];
            $t["variation_name"] = $row[4];
            $t["category_name"] = $row[5];
            $t["description"] = $row[7];
            $t["notice"] = $row[9];
            $t["maker_url"] = $row[10];
            $records[] = $t;
        }

        $request->merge([
            "content" => $records,
        ]);

        $request->validate([
            "content" => ["required", "array"],
            "content.*.supplier_id" => ["required", "integer"],
            "content.*.operation_id" => ["required", "string"],
            "content.*.name" => ["required", "string"],
            "content.*.variation_name" => ["nullable", "string"],
            "content.*.category_name" => ["nullable", "string"],
            "content.*.description" => ["present", "string"],
            "content.*.notice" => ["present", "string"],
            "content.*.maker_url" => ["nullable", "string"],
        ]);

        list($variation_items, $single_items) = collect($records)->partition(function($v) {
            return $v["variation_name"];
        });

        DB::transaction(function() use($variation_items, $single_items) {
            // バリエーション景品
            $variation_items = $variation_items->groupBy(function($v) {
                return mb_split("-", $v["operation_id"])[0];
            });
            foreach($variation_items as $k => $records) {
                $p = $records[0];
                $category = ProductCategory::firstOrNew(["name" => $p["category_name"]]);
                $parent = Product::updateOrCreate(
                    [
                        "supplier_id" => $p["supplier_id"],
                        "operation_id" => $k,
                    ],
                    [
                        "name" => $p["name"],
                        "product_category_id" => $category->id,
                        "description" => $p["description"],
                        "notice" => $p["notice"],
                        "maker_url" => $p["maker_url"],
                    ],
                );

                foreach($records as $record) {
                    Product::updateOrCreate(
                        [
                            "supplier_id" => $record["supplier_id"],
                            "operation_id" => $record["operation_id"],
                        ],
                        [
                            "name" => $record["name"],
                            "product_category_id" => $category->id,
                            "description" => $record["description"],
                            "notice" => $record["notice"],
                            "maker_url" => $record["maker_url"],
                            "variation_parent_id" => $parent->id,
                            "variation_name" => $record["variation_name"],
                        ],
                    );
                }
            }

            // 単品の景品
            foreach($single_items as $record) {
                $record = (object)$record;
                $category = ProductCategory::firstOrNew(["name" => $record->category_name]);
                Product::updateOrCreate(
                    [
                        "supplier_id" => $record->supplier_id,
                        "operation_id" => $record->operation_id,
                    ],
                    [
                        "name" => $record->name,
                        "product_category_id" => $category->id,
                        "description" => $record->description,
                        "notice" => $record->notice,
                        "maker_url" => $record->maker_url,
                    ],
                );
            }
        });
        return redirect(route("admin.product.index"));
    }

    // CSV選択画面
    public function shippingCsvSelect(Request $request)
    {
        return view("admin.product.csv.select", [
            'category_name' => 'csv',
            'page_name' => 'csv_select',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'CSV選択',
        ]);
    }

    public function exportSelectShippingCsv(Request $request)
    {
        // リクエスト
        $start_date = $request->input('csv_startdate');
        $end_date = $request->input('csv_enddate');
        if(!$start_date || !$end_date) {
            return redirect( route('admin.project.download.shippingCsv.select') )->with('flash_message', '開始日と終了日の両方を入力してください。');
        }
        $filename = $start_date.'_'.$end_date.".csv";
        $date = new Carbon($end_date);
        $end_date = $date->addDay();
        // csvファイル生成
        $stream = fopen("php://temp", "rw");
        // stream_filter_prepend($stream, "convert.iconv.utf-8/cp932//TRANSLIT");
        fputcsv($stream, [
            "交換ID",
            "申し込み日時",
            "サプライヤーID",
            "景品管理番号",
            "景品名",
            "バリエーション",
            "数量",
            "メーカー・ブランド",
            "型番",
            "JANコード",
            "会社名",
            "名前",
            "フリガナ",
            "郵便番号",
            "都道府県",
            "市区町村",
            "町名・番地",
            "建物名",
            "電話番号",
        ]);
        fputcsv($stream, [
            "id", //交換ID
            "apply_date", //申し込み日時
            "supplier_id", //サプライヤーID
            "operation_id", //景品管理番号
            "name", //景品名
            "variation", //バリエーション
            "quantity", //数量
            "maker", //メーカー・ブランド
            "", //型番
            "", //JANコード
            "company_name", //会社名
            "name", //名前
            "phonetic_name", //フリガナ
            "zipcode", //郵便番号
            "prefecture", //都道府県
            "city", //市区町村
            "street", //町名・番地
            "building", //建物名
            "tel", //電話番号
        ]);
        // 検索
        $targets = Apply::with("shipping_address", "product.product_category")->where("shipping_address_id", "<>", null)
            ->whereIn("apply_status_id", [ApplyStatus::WAITING_ADDRESS])
            ->whereNull("giftee_box_url")
            ->whereBetween("updated_at", [$start_date, $end_date]);
        // CSV
        $targets->chunk(100, function($applies) use($stream) {
            foreach($applies as $apply) {
                $fields = [
                    $apply->id, // 交換ID
                    $apply->created_at, // 申し込み日時
                    $apply->quantity, // サプライヤーID
                    $apply->product->operation_id, // 景品管理番号
                    $apply->product->name, // 景品名
                    $apply->product->variation_name, // バリエーション
                    $apply->quantity, // 数量
                    $apply->product->maker_name, // メーカー・ブランド名
                    "", // 型番
                    "", // JANコード
                    $apply->shipping_address->personal_name, // 会社名
                    ($apply->shipping_address->company_name ? $apply->shipping_address->company_name." " : "") . $apply->shipping_address->personal_name, // 名前
                    $apply->shipping_address->personal_name_kana, // フリガナ
                    $apply->shipping_address->post_code, // 郵便番号
                    $apply->shipping_address->prefectures, // 都道府県
                    $apply->shipping_address->municipalities, // 市区町村
                    $apply->shipping_address->address_code, // 番地
                    $apply->shipping_address->building, // 建物名
                    $apply->shipping_address->tel, // 電話番号
                ];
                fputcsv($stream, $fields);
            }
        });
        Storage::put($filename, $stream);
        fclose($stream);
        return Storage::download($filename);
    }

    public function exportShippingCsv($yyyymmdd)
    {
        // 指定日付のフォーマットチェック
        if(strlen($yyyymmdd) != 8) {
            return back();
        }

        $y = substr($yyyymmdd,0,4);
        $m = substr($yyyymmdd,4,2);
        $d = substr($yyyymmdd,6,2);
        if(!checkdate($m, $d, $y)) {
            return back();
        }

        $filename = $y.$m.$d.".csv";
        if(Storage::exists($filename)) {
            return Storage::download($filename);
        }

        // csvファイル生成
        $stream = fopen("php://temp", "rw");
        // stream_filter_prepend($stream, "convert.iconv.utf-8/cp932//TRANSLIT");
        fputcsv($stream, [
            "システムID",
            "交換申請日時",
            "サプライヤー番号",
            "管理番号",
            "商品名",
            "バリエーション",
            "メーカー・ブランド",
            "型番",
            "JANコード",
            "個数",
            "会社名・名前",
            "フリガナ",
            "郵便番号",
            "都道府県",
            "市区町村",
            "町名・番地",
            "建物名",
            "電話番号",
        ]);
        fputcsv($stream, [
            "id",
            "apply_date",
            "supplier_id",
            "operation_id",
            "name",
            "variation",
            "maker",
            "",
            "",
            "quantity",
            "name",
            "phonetic_name",
            "zipcode",
            "prefecture",
            "city",
            "street",
            "building",
            "tel",
        ]);

        $date = DateTimeImmutable::createFromFormat("Ymd", $y.$m.$d)->setTime(5, 0);
        $targets = Apply::with("shipping_address", "product.product_category")->where("shipping_address_id", "<>", null)
            ->whereIn("apply_status_id", [ApplyStatus::WAITING_ADDRESS])
            ->whereBetween("updated_at", [$date->add(DateInterval::createFromDateString("-1day")), $date->add(DateInterval::createFromDateString("-1second"))])
            ;
        $targets->chunk(100, function($applies) use($stream) {
            foreach($applies as $apply) {
                $fields = [
                    $apply->id, // システムID
                    $apply->created_at, // 交換申請日時
                    $apply->quantity, // サプライヤー番号
                    $apply->product->operation_id, // 管理番号
                    $apply->product->name, // 商品名
                    $apply->product->variation_name, // バリエーション名
                    $apply->product->maker_name, // メーカー・ブランド名
                    "", // 型番
                    "", // JANコード
                    $apply->quantity, // 個数
                    ($apply->shipping_address->company_name ? $apply->shipping_address->company_name." " : "") . $apply->shipping_address->personal_name, // 名前
                    $apply->shipping_address->personal_name_kana, // フリガナ
                    $apply->shipping_address->post_code, // 郵便番号
                    $apply->shipping_address->prefectures, // 都道府県
                    $apply->shipping_address->municipalities, // 市区町村
                    $apply->shipping_address->address_code, // 番地
                    $apply->shipping_address->building, // 建物名
                    $apply->shipping_address->tel, // 電話番号
                ];
                fputcsv($stream, $fields);
            }
        });
        $targets->update(["apply_status_id" => ApplyStatus::SENT_PRODUCT]);

        Storage::writeStream($filename, $stream);
        fclose($stream);

        return Storage::download($filename);
    }

    private function createProductImage($product, $image_data)
    {
        $file = $image_data["image_file"];
        $file_name = $file->getClientOriginalName();
        $file->move(public_path("uploads/"), $file_name);
        $image = new ProductImage();
        $image->fill([
            "path" => $file_name,
        ]);
        $image->product()->associate($product);
        $image->save();
        return $image;
    }
}
