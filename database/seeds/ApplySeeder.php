<?php

use App\Models\ApplyStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // マスタデータ

        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::APPLYING,
            "name" => "応募初期状態",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::WAITING_LOTTERY,
            "name" => "抽選待ち",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::LOST_LOTTERY,
            "name" => "落選",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::WAITING_ADDRESS,
            "name" => "宛先入力待ち",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::CANCEL,
            "name" => "キャンセル",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::SENT_PRODUCT,
            "name" => "発送済み",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::DEFECTING_ADDRESS,
            "name" => "宛先不備",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::PREPARING_SEND,
            "name" => "発送準備中",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::GIFTEE_APPLIED,
            "name" => "発行済み",
        ]);
        DB::table("apply_statuses")->insert([
            "id" => ApplyStatus::GIFTEE_REQUEST_ERROR,
            "name" => "リクエストエラー",
        ]);

        // 応募
        $yesterday = Carbon::yesterday()->format("Y-m-d H:i:s");
        $today = Carbon::today()->format("Y-m-d H:i:s");

        DB::table("applies")->insert([
            "quantity" => 2,
            "apply_status_id" => ApplyStatus::GIFTEE_APPLIED,
            "user_id" => 1,
            "campaign_product_id" => 1,
            "product_id" => 1,
            "shipping_address_id" => 1,
            "created_at" => $yesterday,
            "updated_at" => $yesterday,
        ]);
        DB::table("applies")->insert([
            "quantity" => 1,
            "apply_status_id" => ApplyStatus::WAITING_ADDRESS,
            "user_id" => 1,
            "campaign_product_id" => 2,
            "product_id" => 15,
            "created_at" => $today,
            "updated_at" => $today,
        ]);
        DB::table("applies")->insert([
            "quantity" => 2,
            "apply_status_id" => ApplyStatus::WAITING_ADDRESS,
            "user_id" => 1,
            "campaign_product_id" => 4,
            "product_id" => 19,
            "shipping_address_id" => 2,
            "created_at" => $today,
            "updated_at" => $today,
        ]);

        // 宛先

        DB::table("shipping_addresses")->insert([
            "personal_name" => "加納雅士",
            "personal_name_kana" => "カノウマサシ",
            "post_code" => "446-0076",
            "prefectures" => "愛知県",
            "municipalities" => "安城市美園町",
            "address_code" => "2-12-9",
            "building" => null,
            "tel" => "09042352965",
            "delivery_time_id" => 1,
        ]);
        DB::table("shipping_addresses")->insert([
            "company_name" => "株式会社oooo",
            "personal_name" => "山田　太郎",
            "personal_name_kana" => "ヤマダ　タロウ",
            "post_code" => "440-0881",
            "prefectures" => "愛知県",
            "municipalities" => "豊橋市広小路",
            "address_code" => "1丁目1-18",
            "building" => "ユメックスビル8F",
            "tel" => "0532-31-5334",
            "delivery_time_id" => 2,
        ]);
    }
}
