<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("companies")->insert([
            "name" => "株式会社Next.Tube",
            "is_integration" => true,
            "is_administration" => true,
        ]);
        DB::table("companies")->insert([
            "name" => "株式会社燧",
            "is_integration" => true,
            "is_administration" => true,
        ]);
        DB::table("companies")->insert([
            "name" => "合同会社Rスクエア",
            "is_integration" => true,
            "is_administration" => true,
        ]);
        DB::table("companies")->insert([
            "name" => "エネオスウイング",
            "is_integration" => false,
            "is_administration" => false,
        ]);

        DB::table("company_shop_tree_element")->insert([
            "company_id" => 4,
            "shop_tree_element_id" => 1,
        ]);
    }
}
