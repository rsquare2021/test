<?php

use App\Models\CampaignType;
use App\Models\GiftDeliveryMethod;
use App\Models\LotteryType;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // マスタデータ
        DB::table("campaign_types")->insert([
            "id" => CampaignType::CATALOG,
            "name" => "ポイントカタログ型",
        ]);
        DB::table("campaign_types")->insert([
            "id" => CampaignType::LOTTERY,
            "name" => "抽選型",
        ]);
        DB::table("lottery_types")->insert([
            "id" => LotteryType::INSTANT,
            "name" => "即時",
        ]);
        DB::table("lottery_types")->insert([
            "id" => LotteryType::BULK,
            "name" => "後日",
        ]);
        DB::table("gift_delivery_methods")->insert([
            "id" => GiftDeliveryMethod::SHOP,
            "name" => "店頭交換",
        ]);
        DB::table("gift_delivery_methods")->insert([
            "id" => GiftDeliveryMethod::SUPPLIER,
            "name" => "発送",
        ]);

        // 配送希望時間

        DB::table("delivery_times")->insert([
            "id" => 1,
            "name" => "指定なし",
        ]);
        DB::table("delivery_times")->insert([
            "id" => 2,
            "name" => "午前中（8時～12時）",
        ]);
        DB::table("delivery_times")->insert([
            "id" => 3,
            "name" => "14:00 ～ 16:00",
        ]);
        DB::table("delivery_times")->insert([
            "id" => 4,
            "name" => "16:00 ～ 18:00",
        ]);
        DB::table("delivery_times")->insert([
            "id" => 5,
            "name" => "18:00 ～ 20:00",
        ]);
        DB::table("delivery_times")->insert([
            "id" => 6,
            "name" => "19:00 ～ 21:00",
        ]);



        // ENEOSウイング 2022年度 乗務員様 謝恩祭

        DB::table("campaigns")->insert([
            "name" => "2022年度 乗務員様 謝恩祭",
            "campaign_type_id" => CampaignType::CATALOG,
            "publish_datetime" => "2021-10-01 00:00:00",
            "close_datetime" => "2022-03-04 00:00:00",
            "start_datetime_to_convert_receipts_to_points" => "2021-10-01 00:00:00",
            "end_datetime_to_convert_receipts_to_points" => "2022-03-04 00:00:00",
            "application_requirements" => '［キャンペーン主催者］<br>
                                            株式会社ENEOSウイング<br>
                                            <br>
                                            ［参加条件］<br>
                                            対象期間中に全国のENEOSウイングサービスステーションで軽油を25L以上給油いただいたレシートをお持ちの方。<br>
                                            日本国内在住で景品のお届け先が日本国内の18歳以上の方。<br>
                                            <br>
                                            ※一部取り扱いしていない店舗もございます。<br>
                                            ※付与ポイントはレシート単位で計算されるため、端数を合算することはできません。<br>
                                            ※レシートの送信および景品の交換は、対象期間中は何度でも可能です。<br>
                                            ※一度送信されたレシートは対象外です。<br>
                                            ※レシートの偽造、改ざんなどが発覚した場合はアカウント削除など厳正な措置をとらせていただきます。<br>
                                            <br>
                                            ［ご注意］<br>
                                            ※インターネット通信料はお客様のご負担となります。<br>
                                            ※景品の内容は諸般の事情によりキャンペーン期間中に変更となる場合がございます。<br>
                                            ※景品到着後の紛失・破損などにつきましては対応いたしかねます。<br>
                                            ※景品のお届け先が不明、連絡不能などの理由によりお届けできない場合、無効となります。<br>
                                            <br>
                                            ［お客様アカウント情報について］<br>
                                            お客様アカウント情報は株式会社ENEOSウイングが開催する他のWebキャンペーンでも共通でご利用いただける場合がございます。<br>詳しくは各キャンペーンの情報をご確認ください。<br>
                                            <br>
                                            ［システム利用推奨環境について］<br>
                                            当サイトを快適、安全にご利用いただくためには、「<a href="https://next-cp.com/terms/" targer="_blank">当サイトのご利用にあたって</a>」に記載の内容に従ってご利用ください。',
            "terms_of_service" => "株式会社Next.Tube
                                    【福岡】コンタクトセンター
                                    Tel：0120-737-105
                                    〒810-0022
                                    福岡県福岡市中央区薬院1-2-5
                                    リアンプレミアム薬院ステーション4階
                                    ※受付時間 10:00〜17:00 (土・日・祝日を除く)
                                    ※くれぐれもお電話のおかけ間違いのない様、お願いいたします。
                                    ※本キャンペーンに関するお問い合わせは、上記キャンペーン事務局のみで受け付けております。店頭では対応できませんので、予めご了承ください。",
            "privacy_policy" => '【個人情報の取り扱いについて】<br>
                                    本キャンペーンの事務局運営は株式会社Next.Tubeがおこなっております。お客様からご提供いただいた個人情報は、当社および当社と秘密保持契約を締結した業務委託先、キャンペーン主催者が景品の抽選および発送の管理、今後の商品やサービスの改善において個人を特定できない形に加工して利用させていただきます。お客様からいただいた個人情報の保管期限は必要な保管期限までとし、その後は速やかに破棄させていただきます。その他の個人情報の取り扱いについては<a href="https://next-tube.jp/privacy-policy" targer="_blank">プライバシーポリシー</a>をご参照ください。',
            "company_id" => 1,
        ]);
        DB::table("campaign_shop_tree_element")->insert([
            "campaign_id" => 1,
            "shop_tree_element_id" => 2,
        ]);
        DB::table("campaign_shop_tree_element")->insert([
            "campaign_id" => 1,
            "shop_tree_element_id" => 6,
        ]);

        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 40,
            "product_id" => 1,
            "access_token" => "cc9b88f5-0bca-46a2-b32f-137c8a111619",
            "config_code" => "eccc0a1f-9605-4498-9bb4-038780d80889",
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 60,
            "product_id" => 15,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 60,
            "product_id" => 16,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 80,
            "product_id" => 17,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 80,
            "product_id" => 18,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 80,
            "product_id" => 19,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 96,
            "product_id" => 20,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 120,
            "product_id" => 21,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 120,
            "product_id" => 22,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 120,
            "product_id" => 23,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 120,
            "product_id" => 24,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 160,
            "product_id" => 25,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 160,
            "product_id" => 26,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 200,
            "product_id" => 27,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 200,
            "product_id" => 28,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 200,
            "product_id" => 29,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 200,
            "product_id" => 30,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 200,
            "product_id" => 31,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 200,
            "product_id" => 32,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 252,
            "product_id" => 33,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 240,
            "product_id" => 34,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 240,
            "product_id" => 35,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 240,
            "product_id" => 36,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 280,
            "product_id" => 37,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 280,
            "product_id" => 38,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 340,
            "product_id" => 39,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 360,
            "product_id" => 40,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 360,
            "product_id" => 41,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 360,
            "product_id" => 42,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 400,
            "product_id" => 43,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 400,
            "product_id" => 44,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 480,
            "product_id" => 45,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 480,
            "product_id" => 46,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 480,
            "product_id" => 47,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 28,
            "product_id" => 48,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 202,
            "product_id" => 49,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 992,
            "product_id" => 50,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 826,
            "product_id" => 51,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 960,
            "product_id" => 52,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 64,
            "product_id" => 53,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 40,
            "product_id" => 54,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 72,
            "product_id" => 55,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 56,
            "product_id" => 56,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 1,
            "point" => 87,
            "product_id" => 57,
        ]);

        // クリスマスキャンペーン

        DB::table("campaigns")->insert([
            "name" => "クリスマスキャンペーン",
            "campaign_type_id" => CampaignType::LOTTERY,
            "publish_datetime" => "2021-12-01 06:00:00",
            "close_datetime" => "2021-12-31 06:00:00",
            "start_datetime_to_convert_receipts_to_points" => "2021-12-20 06:00:00",
            "end_datetime_to_convert_receipts_to_points" => "2021-12-26 06:00:00",
            "application_requirements" => "テスト",
            "terms_of_service" => "テスト",
            "privacy_policy" => "テスト",
            "company_id" => 4,
        ]);
        DB::table("campaign_shop_tree_element")->insert([
            "campaign_id" => 2,
            "shop_tree_element_id" => 1,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 2,
            "name" => "Ａ賞",
            "point" => 2,
            "lottery_type_id" => LotteryType::INSTANT,
            "win_rate" => 60,
        ]);
        DB::table("campaign_products")->insert([
            "product_id" => 1,
            "course_id" => 5,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 2,
            "name" => "Ｂ賞",
            "point" => 1,
            "lottery_type_id" => LotteryType::INSTANT,
            "win_rate" => 20,
        ]);
        DB::table("campaign_products")->insert([
            "product_id" => 2,
            "course_id" => 7,
        ]);
        DB::table("campaign_products")->insert([
            "product_id" => 3,
            "course_id" => 7,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 2,
            "name" => "抽選コースA",
            "point" => 2,
            "lottery_type_id" => LotteryType::BULK,
        ]);
        DB::table("campaign_products")->insert([
            "product_id" => 2,
            "course_id" => 10,
            "win_limit" => 9,
        ]);
        DB::table("campaign_products")->insert([
            "campaign_id" => 2,
            "name" => "抽選コースB",
            "point" => 2,
            "lottery_type_id" => LotteryType::BULK,
        ]);
        DB::table("campaign_products")->insert([
            "product_id" => 3,
            "course_id" => 12,
            "win_limit" => 5,
        ]);
        DB::table("campaign_products")->insert([
            "product_id" => 4,
            "course_id" => 12,
            "win_limit" => 6,
        ]);
    }
}
