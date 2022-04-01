<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // エンドユーザー

        DB::table("users")->insert([
            "name" => "ぶっち～",
            "email" => "buchi@wato.jp",
            "email_verified_at" => "2021-12-01 16:00:00",
            "password" => Hash::make("buchibuchi"),
            "remember_token" => Str::random(10),
            "created_at" => "2021-12-01 16:00:00",
            "updated_at" => "2021-12-01 16:00:00",
        ]);
        DB::table("users")->insert([
            "name" => "アールスクエア",
            "email" => "rsquare@me.com",
            "email_verified_at" => "2021-12-01 16:00:00",
            "password" => Hash::make("testtest"),
            "remember_token" => Str::random(10),
            "created_at" => "2021-12-01 16:00:00",
            "updated_at" => "2021-12-01 16:00:00",
        ]);
        DB::table("users")->insert([
            "name" => "中田　裕之",
            "email" => "b@b.com",
            "password" => Hash::make("test"),
            "remember_token" => Str::random(10),
            "created_at" => "2021-12-01 16:00:00",
            "updated_at" => "2021-12-01 16:00:00",
        ]);
        DB::table("users")->insert([
            "name" => "テスト1",
            "email" => "next-cp@next-tube.jp",
            "email_verified_at" => "2021-12-01 16:00:00",
            "password" => Hash::make("testtest"),
            "remember_token" => Str::random(10),
            "created_at" => "2021-12-01 16:00:00",
            "updated_at" => "2021-12-01 16:00:00",
        ]);
        DB::table("users")->insert([
            "name" => "テスト2",
            "email" => "yoshimi.sub01@next-tube.jp",
            "email_verified_at" => "2021-12-01 16:00:00",
            "password" => Hash::make("testtest"),
            "remember_token" => Str::random(10),
            "created_at" => "2021-12-01 16:00:00",
            "updated_at" => "2021-12-01 16:00:00",
        ]);
        DB::table("users")->insert([
            "name" => "テスト3",
            "email" => "yoshimi.sub02@next-tube.jp",
            "email_verified_at" => "2021-12-01 16:00:00",
            "password" => Hash::make("testtest"),
            "remember_token" => Str::random(10),
            "created_at" => "2021-12-01 16:00:00",
            "updated_at" => "2021-12-01 16:00:00",
        ]);

        // 参加キャンペーン

        DB::table("user_campaign_points")->insert([
            "user_id" => 1,
            "campaign_id" => 1,
            "remaining_point" => 262,
            "total_point" => 2080,
        ]);
        DB::table("user_campaign_points")->insert([
            "user_id" => 4,
            "campaign_id" => 1,
            "remaining_point" => 100000,
            "total_point" => 100080,
        ]);
        DB::table("user_campaign_points")->insert([
            "user_id" => 5,
            "campaign_id" => 1,
            "remaining_point" => 100000,
            "total_point" => 100080,
        ]);
        DB::table("user_campaign_points")->insert([
            "user_id" => 6,
            "campaign_id" => 1,
            "remaining_point" => 100000,
            "total_point" => 100080,
        ]);

        // プレポイント

        DB::table("users_pre_points")->insert([
            "receipt_id" => 1,
            "point" => 5,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("users_pre_points")->insert([
            "receipt_id" => 2,
            "point" => 10,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("users_pre_points")->insert([
            "receipt_id" => 3,
            "point" => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("users_pre_points")->insert([
            "receipt_id" => 4,
            "point" => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("users_pre_points")->insert([
            "receipt_id" => 5,
            "point" => 3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
