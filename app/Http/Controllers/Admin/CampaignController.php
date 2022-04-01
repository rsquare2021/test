<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\CampaignTheme;
use App\Models\CampaignType;
use App\Models\FlatShopTreeElement;
use App\Models\ShopTreeElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::getRelatingCampaigns(Auth::user());
        return view("admin.project.list", [
            'category_name' => 'project',
            'page_name' => 'project',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン一覧',
            "campaigns" => $campaigns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaign_types = CampaignType::get();
        return view("admin.project.create", [
            'category_name' => 'project',
            'page_name' => 'project_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン作成',
            "campaign_types" => $campaign_types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        DB::transaction(function() use($request) {
            $campaign = new Campaign();
            $campaign->fill($request->all());
            $campaign->campaign_type_id = $request->campaign_type_id;
            $campaign->company()->associate(Auth::user()->company);
            $campaign->save();
            $campaign->shop_tree_elements()->saveMany(Auth::user()->shop_tree_elements);
        });
        return redirect(route("admin.project.index"));
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
        $this->authorize("editable_campaign", $id);
        $campaign = Campaign::find($id);
        $campaign_types = CampaignType::get();
        return view("admin.project.edit", [
            'category_name' => 'project',
            'page_name' => 'project_edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン編集',
            "campaign" => $campaign,
            "campaign_types" => $campaign_types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, $id)
    {
        $this->authorize("editable_campaign", $id);
        $campaign = Campaign::find($id);
        $campaign->update($request->all());
        return redirect(route("admin.project.index"));
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

    public function editShops($id)
    {
        $campaign = Campaign::with("shop_tree_elements")->find($id);
        $expanded_roots = [];
        foreach(Auth::user()->company->getShopTreeRoots() as $root) {
            $expanded_roots[] = ShopTreeElement::getTreeFrom($root->id);
        }

        function getShops($e, &$shops) {
            if($e->shop_tree_level_id == 4) {
                $shops[] = $e;
            }
            else {
                foreach($e->children as $child) {
                    getShops($child, $shops);
                }
            }
        }
        $shops = [];
        foreach($expanded_roots as $e) {
            getShops($e, $shops);
        }

        return view("admin.project.shop.edit", [
            'category_name' => 'project',
            'page_name' => 'charge',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン店舗確認・編集',
            "campaign" => $campaign,
            "roots" => $expanded_roots,
            "shops" => $shops,
        ]);
    }

    public function updateShops(Request $request, $id)
    {
        $request->merge([
            "element_ids" => $request->input("element_ids", []),
        ]);
        $request->validate([
            "element_ids" => ["required", "array"],
            "element_ids.*" => ["integer"],
        ]);
        /** @var Admin */
        $admin = Auth::user();
        $white_shop_ids = $admin->filterShopTreeElementId($request->element_ids);
        $white_shop_ids = $white_shop_ids->diff(FlatShopTreeElement::getLowersWithoutSelf($white_shop_ids)->pluck("id"));

        $campaign = Campaign::find($id);
        $campaign->shop_tree_elements()->sync($white_shop_ids);
        return redirect(route("admin.project.index"));
    }

    public function createCopy($id)
    {
        $campaign = Campaign::find($id);
        $campaign_types = CampaignType::get();
        return view("admin.project.copy", [
            'category_name' => 'project',
            'page_name' => 'project_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'キャンペーン作成（コピー）',
            "campaign" => $campaign,
            "campaign_types" => $campaign_types,
        ]);
    }

    public function storeCopy(CampaignRequest $request, $id)
    {
        DB::transaction(function() use($request, $id) {
            $src = Campaign::with(["products.products", "shop_tree_elements"])->find($id);

            $new = $src->replicate();
            $new->fill($request->all());
            $new->company()->associate(Auth::user()->company);
            $new->save();
            // 店舗設定をコピー
            $new->shop_tree_elements()->sync($src->shop_tree_elements);
            // 景品設定をコピー
            $children = $src->products->map(function($n1) {
                $tmp = $n1->replicate();
                $tmp->save();
                $children = $n1->products->map(function($n2) {
                    $tmp = $n2->replicate();
                    $tmp->save();
                    return $tmp;
                });
                $tmp->products()->saveMany($children);
                return $tmp;
            });
            $new->products()->saveMany($children);
        });
        return redirect(route("admin.project.index"));
    }
}
