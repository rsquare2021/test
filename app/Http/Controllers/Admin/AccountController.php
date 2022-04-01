<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Company;
use App\Models\FlatShopTreeElement;
use App\Models\ShopTreeElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
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
            $admins = Admin::get();
        }
        else {
            $admins = Admin::where("company_id", Auth::user()->company_id)->get();
        }
        $admins->loadMissing("admin_role", "company");

        return view("admin.user.list", [
            'category_name' => 'user',
            'page_name' => 'user',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '管理ユーザー一覧',
            "admins" => $admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_roles = AdminRole::get();
        $companies = Company::get();
        return view("admin.user.create", [
            'category_name' => 'user',
            'page_name' => 'user_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ユーザー追加',
            "admin_roles" => $admin_roles,
            "default_role_id" => AdminRole::REGULAR_ADMIN,
            "companies" => $companies,
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
        $safe_data = $request->validate($this->accountRule());
        $safe_data["password"] = $this->encryptPassword($safe_data["password"]);
        DB::transaction(function() use($safe_data) {
            $admin = new Admin();
            $admin->fill($safe_data);
            if(Auth::user()->company->isAdministration()) {
                $admin->company_id = $safe_data["company_id"];
            }
            else {
                $admin->company_id = Auth::user()->company_id;
            }
            $admin->save();
        });
        return redirect()->route("admin.user.index");
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
        $this->authorize("editable_admin", $id);
        $admin = Admin::findOrFail($id);
        $admin_roles = AdminRole::get();
        return view("admin.user.edit", [
            'category_name' => 'user',
            'page_name' => 'user_create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ユーザー編集',
            "admin" => $admin,
            "admin_roles" => $admin_roles,
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
        $this->authorize("editable_admin", $id);
        $safe_data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email"],
            "office_name" => ["nullable", "string"],
            "admin_role_id" => ["required", "integer"],
        ]);

        $super_admin_count = Admin::excludeSuperAdminById($id)->count();
        if($super_admin_count <= 0) {
            return back()->withErrors(["super_admin_count" => "スーパー管理ユーザーがいなくなってしまいます。"]);
        }

        $admin = Admin::findOrFail($id);
        $admin->name = $safe_data["name"];
        $admin->email = $safe_data["email"];
        $admin->office_name = $safe_data["office_name"];
        $admin->admin_role_id = $safe_data["admin_role_id"];
        $admin->save();

        if(Auth::user()->isSuperAdmin()) {
            return redirect(route("admin.user.index"));
        }
        else {
            return redirect(route("admin.home"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("editable_admin", $id);
        // 自分は削除できない
        if(Auth::guard("admin")->id() == $id) {
            return back()->withErrors(["cant_delete_own" => "自分自身は削除できません。"]);
        }

        $super_admin_count = Admin::excludeSuperAdminById($id)->count();
        if($super_admin_count <= 0) {
            return back()->withErrors(["super_admin_count" => "スーパー管理ユーザーがいなくなってしまいます。"]);
        }

        $admin = Admin::find($id);
        if($admin) $admin->delete();
        return redirect()->route("admin.user.index");
    }

    public function charge($id)
    {
        $admin = Admin::with(["company.shopTrees", "shop_tree_elements"])->find($id);
        $expanded_roots = [];
        foreach($admin->company->getShopTreeRoots() as $root) {
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

        return view("admin.user.charge", [
            'category_name' => 'user',
            'page_name' => 'charge',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '担当確認・編集',
            "admin" => $admin,
            "roots" => $expanded_roots,
            "shops" => $shops,
        ]);
    }

    public function updateCharge(Request $request, $id)
    {
        $request->validate([
            "element_ids" => ["nullable", "array"],
            "element_ids.*" => ["integer"],
        ]);

        $admin = Admin::with("company")->find($id);
        $element_ids = $request->input("element_ids", []);
        $white_shop_ids = $admin->filterShopTreeElementId($element_ids);
        $white_shop_ids = $white_shop_ids->diff(FlatShopTreeElement::getLowersWithoutSelf($white_shop_ids)->pluck("id"));
        $admin->shop_tree_elements()->sync($white_shop_ids);

        return redirect(route("admin.user.index"));
    }

    public function editProfile()
    {
        $admin = Auth::user();
        return view("admin.user.profile", [
            'category_name' => 'user',
            'page_name' => 'profile',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'マイプロフィール編集',
            "admin" => $admin,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email"],
            "password" => ["nullable", "alpha_num", "min:8"],
            "office_name" => ["nullable", "string"],
        ]);

        /** @var Admin */
        $admin = Auth::user();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->office_name = $request->office_name;
        if($request->input("password")) {
            $admin->password = $this->encryptPassword($request->password);
        }
        $admin->save();

        return back();
    }

    private function accountRule()
    {
        if(Auth::user()->company->isAdministration()) {
            return [
                "name" => ["required", "string"],
                "email" => ["required", "email", "unique:admins"],
                "password" => ["required", "alpha_num", "min:8"],
                "company_id" => ["required", "integer"],
                "office_name" => ["nullable", "string"],
                "admin_role_id" => ["required", "integer"],
            ];
        }
        else {
            return [
                "name" => ["required", "string"],
                "email" => ["required", "email", "unique:admins"],
                "password" => ["required", "alpha_num", "min:8"],
                "office_name" => ["nullable", "string"],
                "admin_role_id" => ["required", "integer"],
            ];
        }
    }

    public function database(Request $request)
    {
        $request->session()->put('database', 'true');
        $host = $_SERVER['HTTP_REFERER'];
        ddd($host);
    }

    private function encryptPassword($plain)
    {
        return Hash::make($plain);
    }
}
