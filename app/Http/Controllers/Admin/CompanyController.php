<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ShopTreeElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with("shopTrees")->get();
        return view("admin.company.list", [
            'category_name' => 'company',
            'page_name' => 'company',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '会社一覧',
            "companies" => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trees = ShopTreeElement::root()->get();
        return view("admin.company.create", [
            'category_name' => 'company',
            'page_name' => 'company_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '会社追加',
            "trees" => $trees,
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
            "shopTrees" => [],
        ]);
        DB::transaction(function() use($request) {
            $company = Company::create($request->all());
            $company->shopTrees()->attach(request()->shopTrees);
        });
        return redirect()->route("admin.company.index");
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
        $company = Company::with("shopTrees")->find($id);
        $trees = ShopTreeElement::root()->get();
        return view("admin.company.edit", [
            'category_name' => 'company',
            'page_name' => 'company_edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '会社編集',
            "company" => $company,
            "trees" => $trees,
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
            "name" => ["required", "string"],
            "shopTrees" => [],
        ]);
        $company = Company::find($id);
        DB::transaction(function() use($company, $request) {
            $company->update($request->all());
            $company->shopTrees()->sync(request()->shopTrees);
        });
        return redirect()->route("admin.company.index");
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
