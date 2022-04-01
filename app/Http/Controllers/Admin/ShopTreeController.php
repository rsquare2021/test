<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlatShopTreeElement;
use App\Models\ShopTreeElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SplFileObject;

class ShopTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user();
        if($admin->company->isAdministration()) {
            $roots = ShopTreeElement::root()->get();
        }
        else {
            $roots = ShopTreeElement::root()->whereIn("id", $admin->company->shopTrees->pluck("id"))->get();
        }

        $count_list = FlatShopTreeElement::whereIn("root_id", $roots->pluck("id"))
            ->where("depth", ">", 0)
            ->groupByRaw("root_id, depth")
            ->selectRaw("root_id as id, depth, count(*) as count")
            ->get()
            ;

        return view("admin.shop_tree.list", [
            'category_name' => 'shop_tree',
            'page_name' => 'shop_tree',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ツリー一覧',
            "roots" => $roots,
            "element_count_list" => $count_list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.shop_tree.create", [
            'category_name' => 'shop_tree',
            'page_name' => 'shop_tree_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ツリー追加',
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
        $request->validate([
            "csv" => ["required", "file"],
        ]);

        $file_info = $request->file("csv");
        $file_object = $file_info->openFile();
        $file_object->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY);
        $loop_counter = 0;
        foreach($file_object as $row) {
            if($loop_counter++ < 1) continue;
            if(!empty($row[22])) continue;
            foreach($row as &$value) {
                $value = $this->mbTrim($value);
            }
            $t = [];
            $t["company"] = $row[10];
            $t["shop"] = $row[11];
            $t["office"] = $row[12];
            $t["area"] = $row[17];
            $records[] = $t;
        }

        $request->merge([
            "content" => $records,
        ]);

        $request->validate([
            "content" => ["required", "array"],
            "content.*.company" => ["required", "string"],
            "content.*.shop" => ["required", "string"],
            "content.*.office" => ["required", "string"],
            "content.*.area" => ["required", "string"],
        ]);

        DB::transaction(function() use($records) {
            $tree = collect($records)->groupBy(["company", "office", "area"]);
            $tree->each(function($offices, $name) {
                ShopTreeElement::create([
                    "name" => $name,
                    "shop_tree_level_id" => 1,
                ])->children()->saveMany(
                    $offices->map(function($areas, $name) {
                        $office = ShopTreeElement::create([
                            "name" => $name,
                            "shop_tree_level_id" => 2,
                        ]);
                        $office->children()->saveMany(
                            $areas->map(function($shops, $name) {
                                $area = ShopTreeElement::create([
                                    "name" => $name,
                                    "shop_tree_level_id" => 3,
                                ]);
                                $area->children()->saveMany(
                                    $shops->map(function($shop) {
                                        return ShopTreeElement::create([
                                            "name" => $shop["shop"],
                                            "shop_tree_level_id" => 4,
                                        ]);
                                    })
                                );
                                return $area;
                            })
                        );
                        return $office;
                    })
                );
            });
        });
        return redirect(route("admin.shop_tree.index"));
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
        $this->authorize("editable_shop_tree_element", $id);
        $root = ShopTreeElement::where("parent_id", null)->find($id);
        return view("admin.shop_tree.edit", [
            'category_name' => 'shop_tree',
            'page_name' => 'shop_tree_edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ツリー編集',
            "root" => $root,
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
        $this->authorize("editable_shop_tree_element", $id);
        $tree_data = $request->all();
        // DOM操作で動的に増減したツリー要素の順番を維持するため、
        // 配列の添え字キーを振り直す。
        // $requestを変更するとエラーになるので、コピーを作って処理してバリデートする。
        function reset_index(&$children) {
            $children = array_values($children);
            foreach($children as &$child) {
                if(isset($child["children"])) {
                    reset_index($child["children"]);
                }
            }
        }
        reset_index($tree_data["children"]);

        $validator = Validator::make($tree_data, [
            "top_name" => ["required", "string"],
            "children" => ["required"],
            "children.*.name" => ["required", "string"],
            "children.*.children" => ["required"],
            "children.*.children.*.name" => ["required", "string"],
            "children.*.children.*.children" => ["required"],
            "children.*.children.*.children.*.name" => ["required", "string"],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::transaction(function() use($tree_data, $id) {
            // リクエストに存在しない既存データを削除する。
            $old_ids = FlatShopTreeElement::where("root_id", $id)->pluck("id");
            $new_ids = [$id];
            foreach($tree_data["children"] as $office) {
                $new_ids[] = $office["id"];
                foreach($office["children"] as $area) {
                    $new_ids[] = $area["id"];
                    foreach($area["children"] as $shop) {
                        $new_ids[] = $shop["id"];
                    }
                }
            }
            $delete_ids = $old_ids->diff($new_ids);
            ShopTreeElement::whereIn("id", $delete_ids)->delete();

            // リクエストデータを登録
            $top = ShopTreeElement::find($id);
            $top->update(["name" => $tree_data["top_name"]]);
            $offices = [];
            foreach($tree_data["children"] as $office) {
                $offices[] = ShopTreeElement::updateOrCreate(
                    ["id" => $office["id"]],
                    [
                        "name" => $office["name"],
                        "shop_tree_level_id" => 2,
                    ],
                );
                $areas = [];
                foreach($office["children"] as $area) {
                    $areas[] = ShopTreeElement::updateOrCreate(
                        ["id" => $area["id"]],
                        [
                            "name" => $area["name"],
                            "shop_tree_level_id" => 3,
                        ],
                    );
                    $shops = [];
                    foreach($area["children"] as $shop) {
                        $shops[] = ShopTreeElement::updateOrCreate(
                            ["id" => $shop["id"]],
                            [
                                "name" => $shop["name"],
                                "shop_tree_level_id" => 4,
                            ],
                        );
                    }
                    end($areas)->children()->saveMany($shops);
                }
                end($offices)->children()->saveMany($areas);
            }
            $top->children()->saveMany($offices);
        });
        return redirect(route("admin.shop_tree.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("editable_shop_tree_element", $id);
        $root = ShopTreeElement::with("companies")->root()->find($id);
        if($root->companies->isEmpty()) {
            $root->delete();
        }
        return back();
    }

    public function editShop($id)
    {
        $shop = ShopTreeElement::where("shop_tree_level_id", 4)->find($id);
        return view("kano.admin.shop.edit", [
            "shop" => $shop,
        ]);
    }

    public function updateShop(Request $request, $id)
    {
        $request->validate([
            // "tel" => ["required"],
        ]);
        $shop = ShopTreeElement::where("shop_tree_level_id", 4)->find($id);
        $shop->update($request->all());

        // <a target="_blank">でページ表示すると、そのページを閉じれるかどうかはブラウザ依存になってしまうっぽい。
        // javascriptのwindow.open()で開いて、window.close()で閉じれれば、ブラウザに依存しないようにできるかも？
        return "このページを閉じてツリー編集ページに戻りたい。";
    }

    public function upload()
    {
    }

    public function importCsv(Request $request)
    {
    }

    public function download($id)
    {
        $tree = ShopTreeElement::with("children.children.children")->find($id);
        return response()->streamDownload(
            function() use($tree) {
                $stream = fopen("php://output", "w");
                // stream_filter_prepend($stream, "convert.iconv.utf-8/cp932//TRANSLIT");
                $tree->children->each(function($v) use($stream) {
                    fputcsv($stream, [
                        $v->id,
                        $v->name,
                    ]);
                });
                fclose($stream);
            },
            $tree->name."_店舗ツリー.csv",
            [
                "Content-Type" => "application/octet-stream",
            ],
        );
    }

    private function mbTrim($pString)
    {
        return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u', '', $pString);
    }
}
