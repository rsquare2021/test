<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPreset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPresetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presets = ProductPreset::withCount("products")->get();
        return view("admin.product.preset", [
            'category_name' => 'product',
            'page_name' => 'product_preset',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品プリセット一覧',
            "presets" => $presets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.product.preset_create", [
            'category_name' => 'product',
            'page_name' => 'product_preset_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品プリセット追加',
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
            "name" => ["required", "string"],
        ]);
        ProductPreset::create($request->all());
        return redirect(route("admin.preset.index"));
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
        $preset = ProductPreset::with("products")->find($id);
        $products = Product::with("product_category")->isNotVariation()->get();
        return view("admin.product.preset_product_edit", [
            'category_name' => 'product',
            'page_name' => 'product_preset_edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品プリセット内景品確認・編集',
            "preset" => $preset,
            "products" => $products,
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
        $request->merge([
            "products" => $request->input("products", []),
        ]);
        $request->validate([
            "name" => ["required", "string"],
            "products.*" => ["integer"],
        ]);
        $preset = ProductPreset::find($id);
        DB::transaction(function() use($request, $preset) {
            $preset->update($request->all());
            $white_list = collect(request()->products)->intersect(Product::isNotVariation()->pluck("id"));
            $preset->products()->sync($white_list);
        });
        return redirect(route("admin.preset.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
