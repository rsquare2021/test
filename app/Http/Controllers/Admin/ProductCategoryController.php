<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_categories = ProductCategory::with("parent")->get();
        return view("admin.product.product_cat", [
            'category_name' => 'product',
            'page_name' => 'product_cat',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品カテゴリー一覧',
            "product_categories" => $product_categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_list = ProductCategory::canBecomeParent()->get();
        return view("admin.product.product_cat_create", [
            'category_name' => 'product',
            'page_name' => 'product_cat_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品カテゴリー追加',
            "parent_list" => $parent_list,
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
            "parent_id" => ["integer", "nullable"],
            "name" => ["string", "required"],
        ]);
        ProductCategory::create($request->all());
        return redirect()->route("admin.product_cat.index");
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
        $category = ProductCategory::findOrFail($id);
        $parent_list = ProductCategory::canBecomeParent()->get();
        return view("admin.product.product_cat_edit", [
            'category_name' => 'product',
            'page_name' => 'product_cat_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '景品カテゴリー追加',
            "category" => $category,
            "parent_list" => $parent_list,
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
        $request->validate([
            "parent_id" => ["integer", "nullable"],
            "name" => ["string", "required"],
        ]);
        ProductCategory::findOrFail($id)->update($request->all());
        return redirect()->route("admin.product_cat.index");
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
