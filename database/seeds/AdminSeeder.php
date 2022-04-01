<?php

use App\Models\AdminRole;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 権限

        DB::table("admin_roles")->insert([
            "name" => "スーパー管理ユーザー",
            "short_name" => "スーパー",
        ]);
        DB::table("admin_roles")->insert([
            "name" => "管理者",
            "short_name" => "管理者",
        ]);
        DB::table("admin_roles")->insert([
            "name" => "一般管理ユーザー",
            "short_name" => "一般",
        ]);

        // 管理者

        DB::table("admins")->insert([
            "name" => "吉見　祐",
            "email" => "yoshimi@flintinc.co.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => 1,
            "company_id" => 2,
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "中田　裕之",
            "email" => "nakata@rsquare.co.jp",
            "password" => Hash::make("nakanaka"),
            "admin_role_id" => 1,
            "company_id" => 3,
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "加納　雅士",
            "email" => "kano@rsquare.co.jp",
            "password" => Hash::make("kanokano"),
            "admin_role_id" => 2,
            "company_id" => 3,
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "竹井　久",
            "email" => "hisa@hisa.jp",
            "password" => Hash::make("hisahisa"),
            "admin_role_id" => AdminRole::SUPER_ADMIN,
            "company_id" => 3,
            "office_name" => "名古屋本社",
            "remember_token" => Str::random(10),
        ]);

        // NextTube

        DB::table("admins")->insert([
            "name" => "吉見 祐",
            "email" => "yoshimi@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::SUPER_ADMIN,
            "company_id" => 1,
            "office_name" => "本社",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "後藤 弘直",
            "email" => "goto@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::REGULAR_ADMIN,
            "company_id" => 1,
            "office_name" => "本社",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "古賀 杏奈",
            "email" => "green_koga@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::REGULAR_ADMIN,
            "company_id" => 1,
            "office_name" => "福岡営業所",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "早坂 季花",
            "email" => "green_hayasaka@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::REGULAR_ADMIN,
            "company_id" => 1,
            "office_name" => "東京営業所",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "中川 優海",
            "email" => "green_nakagawa@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::ROW_ADMIN,
            "company_id" => 1,
            "office_name" => "東京営業所",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "渡邉 朋恵",
            "email" => "green_watanabe@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::ROW_ADMIN,
            "company_id" => 1,
            "office_name" => "東京営業所",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "日下 裕唯",
            "email" => "green_kusaka@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::ROW_ADMIN,
            "company_id" => 1,
            "office_name" => "東京営業所",
            "remember_token" => Str::random(10),
        ]);
        DB::table("admins")->insert([
            "name" => "土井 遥香",
            "email" => "green_doi@next-tube.jp",
            "password" => Hash::make("testtest"),
            "admin_role_id" => AdminRole::ROW_ADMIN,
            "company_id" => 1,
            "office_name" => "",
            "remember_token" => Str::random(10),
        ]);
        
        // DB::table("admins")->insert([
        //     "name" => "宮永　咲",
        //     "email" => "saki@saki.jp",
        //     "password" => Hash::make("sakisaki"),
        //     "admin_role_id" => AdminRole::REGULAR_ADMIN,
        //     "company_id" => 1,
        //     "office_name" => "名古屋本社",
        //     "remember_token" => Str::random(10),
        // ]);

        // エネオスウイング

        // DB::table("admins")->insert([
        //     "name" => "龍門渕　透華",
        //     "email" => "touka@touka.jp",
        //     "password" => Hash::make("toukatouka"),
        //     "admin_role_id" => AdminRole::SUPER_ADMIN,
        //     "company_id" => 4,
        //     "office_name" => "名古屋本社",
        //     "remember_token" => Str::random(10),
        // ]);
        // DB::table("admins")->insert([
        //     "name" => "天江　衣",
        //     "email" => "koro@koro.jp",
        //     "password" => Hash::make("korokoro"),
        //     "admin_role_id" => AdminRole::REGULAR_ADMIN,
        //     "company_id" => 4,
        //     "office_name" => "名古屋本社",
        //     "remember_token" => Str::random(10),
        // ]);

        // 担当店舗

        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 1,
            "shop_tree_element_id" => 1,
        ]);
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 2,
            "shop_tree_element_id" => 2,
        ]);
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 3,
            "shop_tree_element_id" => 10,
        ]);
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 3,
            "shop_tree_element_id" => 11,
        ]);

        // NextTube 竹井久
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 4,
            "shop_tree_element_id" => 1,
        ]);
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 4,
            "shop_tree_element_id" => 22,
        ]);
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 4,
            "shop_tree_element_id" => 26,
        ]);
        // NextTube 宮永咲
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 5,
            "shop_tree_element_id" => 2,
        ]);
        // エネオスウイング 竜門渕透華
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 6,
            "shop_tree_element_id" => 1,
        ]);
        // エネオスウイング 天江衣
        DB::table("admin_shop_tree_element")->insert([
            "admin_id" => 7,
            "shop_tree_element_id" => 3,
        ]);
    }
}
