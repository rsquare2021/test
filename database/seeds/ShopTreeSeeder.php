<?php

use Illuminate\Database\Seeder;

class ShopTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 体系レベル

        DB::table("shop_tree_levels")->insert([
            "name" => "企業",
            "depth" => 0,
        ]);
        DB::table("shop_tree_levels")->insert([
            "name" => "支社",
            "depth" => 1,
        ]);
        DB::table("shop_tree_levels")->insert([
            "name" => "店舗エリア",
            "depth" => 2,
        ]);
        DB::table("shop_tree_levels")->insert([
            "name" => "店舗",
            "depth" => 3,
        ]);

        // エネオスウイング

        DB::table("shop_tree_elements")->insert([
            "name" => "株式会社ＥＮＥＯＳウイング",
            "shop_tree_level_id" => 1,
        ]);

        // エネオスウイング支社

        DB::table("shop_tree_elements")->insert([
            "name" => "北海道支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東京支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関1支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "信越支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関2支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "静岡支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東海支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中部支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関西支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中国支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "九州支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "西九州支店",
            "parent_id" => 1,
            "shop_tree_level_id" => 2,
        ]);

        // エリア

        DB::table("shop_tree_elements")->insert([
            "name" => "北海道",
            "parent_id" => 2,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北",
            "parent_id" => 3,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東京",
            "parent_id" => 4,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関1",
            "parent_id" => 5,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "信越",
            "parent_id" => 6,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関2",
            "parent_id" => 7,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "静岡",
            "parent_id" => 8,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東海",
            "parent_id" => 9,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中部",
            "parent_id" => 10,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸",
            "parent_id" => 11,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関西",
            "parent_id" => 12,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中国",
            "parent_id" => 13,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "九州",
            "parent_id" => 14,
            "shop_tree_level_id" => 3,
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "西九州",
            "parent_id" => 15,
            "shop_tree_level_id" => 3,
        ]);

        // 店舗
        
        DB::table("shop_tree_elements")->insert([
            "name" => "函館大野新道TS",
            "parent_id" => 16,
            "code1" => "100903",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0138497178",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート275新十津川TS",
            "parent_id" => 16,
            "code1" => "100906",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0125722160",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "朝里インターSS",
            "parent_id" => 16,
            "code1" => "109132",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0134547668",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート337石狩湾新港TS",
            "parent_id" => 16,
            "code1" => "109171",
            "code2" => "109170",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0133602525",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート36札幌ＴＳ",
            "parent_id" => 16,
            "code1" => "100559",
            "code2" => "109150",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0118824688",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "恵庭ﾊﾞｲﾊﾟｽTS",
            "parent_id" => 16,
            "code1" => "100904",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0123323300",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート38帯広TS",
            "parent_id" => 16,
            "code1" => "100905",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0155626375",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "札幌新道TS",
            "parent_id" => 16,
            "code1" => "109133",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0116131656",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr,Drive苫小牧TS",
            "parent_id" => 16,
            "code1" => "059342",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0144531785",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "八戸TS",
            "parent_id" => 17,
            "code1" => "002045",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0178290100",
        ]);
        //11
        DB::table("shop_tree_elements")->insert([
            "name" => "青森インターTS",
            "parent_id" => 17,
            "code1" => "200994",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0177872158",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "滝沢インターTS",
            "parent_id" => 17,
            "code1" => "210280",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0196885527",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive盛岡ＴＳ",
            "parent_id" => 17,
            "code1" => "210223",
            "code2" => "210286",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0196978839",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート4北上TS",
            "parent_id" => 17,
            "code1" => "210275",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0197666331",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（下り）前沢サービスエリアSS",
            "parent_id" => 17,
            "code1" => "210282",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0197413770",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（上り）紫波サービスエリアSS",
            "parent_id" => 17,
            "code1" => "210283",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0196736123",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（下り）紫波サービスエリアSS",
            "parent_id" => 17,
            "code1" => "210281",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0196717013",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大衡TS",
            "parent_id" => 17,
            "code1" => "278536",
            "code2" => "220336",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0223455108",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "仙台新港TS",
            "parent_id" => 17,
            "code1" => "220303",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0227861350",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート45石巻TS",
            "parent_id" => 17,
            "code1" => "220298",
            "code2" => "220335",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0225873922",
        ]);
        //21
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ仙台長町南ＳＳ",
            "parent_id" => 17,
            "code1" => "220290",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0227480558",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北道白石インターTS",
            "parent_id" => 17,
            "code1" => "220299",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0224243590",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岩沼TS",
            "parent_id" => 17,
            "code1" => "220310",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0223292207",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（下り）菅生パーキングエリアSS",
            "parent_id" => 17,
            "code1" => "220302",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0224834543",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（上り）菅生パーキングエリアSS",
            "parent_id" => 17,
            "code1" => "220329",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0224834544",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "天童ＴＳ",
            "parent_id" => 17,
            "code1" => "240155",
            "code2" => "240172",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0236520561",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "酒田南TS",
            "parent_id" => 17,
            "code1" => "240162",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0234924034",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "郡山南ＴＳ",
            "parent_id" => 17,
            "code1" => "250318",
            "code2" => "250375",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0248732956",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveルート4本宮インターTS",
            "parent_id" => 17,
            "code1" => "250414",
            "code2" => "250429",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0243361861",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "矢吹インターTS",
            "parent_id" => 17,
            "code1" => "250415",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0248442609",
        ]);
        //31
        DB::table("shop_tree_elements")->insert([
            "name" => "東京平和島ＴＳ",
            "parent_id" => 18,
            "code1" => "300872",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0337640068",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新木場ＴＳ",
            "parent_id" => 18,
            "code1" => "301391",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0356359760",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "菊川SS",
            "parent_id" => 18,
            "code1" => "304832",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0336315682",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "厩橋SS",
            "parent_id" => 18,
            "code1" => "304834",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0336237681",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "湾岸浦安フリートTS",
            "parent_id" => 18,
            "code1" => "330382",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0473506631",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "水戸南ＴＳ",
            "parent_id" => 18,
            "code1" => "008315",
            "code2" => "404615",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0299482822",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "船橋卸団地TS",
            "parent_id" => 18,
            "code1" => "330336",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0474344120",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "船橋湾岸ＴＳ",
            "parent_id" => 18,
            "code1" => "330460",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0474200590",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート16柏TS",
            "parent_id" => 18,
            "code1" => "333316",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0471912700",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "カーウォッシュ亀有ＳＳ",
            "parent_id" => 18,
            "code1" => "340296",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0368025820",
        ]);
        //41
        DB::table("shop_tree_elements")->insert([
            "name" => "板橋ＴＳ",
            "parent_id" => 18,
            "code1" => "340883",
            "code2" => "350018",
            "code3" => "350018",
            "code4" => "841066",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0339387120",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dｒ．Driveルート16庄和TS",
            "parent_id" => 19,
            "code1" => "320488",
            "code2" => "320550",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0487451751",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "三郷インター南ＴＳ",
            "parent_id" => 19,
            "code1" => "320534",
            "code2" => "320532",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0489493344",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート122加須ＴＳ",
            "parent_id" => 19,
            "code1" => "320596",
            "code2" => "320597",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0480641155",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート4越谷ＴＳ",
            "parent_id" => 19,
            "code1" => "320607",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0489693981",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上武道深谷バイパスＴＳ",
            "parent_id" => 19,
            "code1" => "320637",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0485303733",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dｒ．Driveセルフ春日部中央SS",
            "parent_id" => 19,
            "code1" => "586762",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0487310550",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "入間ＴＳ",
            "parent_id" => 19,
            "code1" => "320419",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0429345566",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート17大宮バイパスTS",
            "parent_id" => 19,
            "code1" => "320510",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0486231851",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "和光笹目通りTS",
            "parent_id" => 19,
            "code1" => "320511",
            "code2" => "320551",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0484510541",
        ]);
        //51
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート16入間宮寺ＴＳ ",
            "parent_id" => 19,
            "code1" => "320541",
            "code2" => "320540",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0429351571",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（上り）蓮田サービスエリアＳＳ",
            "parent_id" => 19,
            "code1" => "320620",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0487652871",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "安中下りＴＳ",
            "parent_id" => 19,
            "code1" => "010143",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0273850166",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート122白岡菖蒲インターTS",
            "parent_id" => 19,
            "code1" => "320632",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0480731801",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveルート50足利TS",
            "parent_id" => 19,
            "code1" => "410375",
            "code2" => "715784",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0284738100",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "高崎インター東TS",
            "parent_id" => 19,
            "code1" => "420453",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0272656161",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上信越自動車道(下り）横川サービスエリアSS",
            "parent_id" => 19,
            "code1" => "420460",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0273952770",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関越自動車道(下り）赤城高原サービスエリアSS",
            "parent_id" => 19,
            "code1" => "420461",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0278247866",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "栃木小山ＴＳ",
            "parent_id" => 19,
            "code1" => "009091",
            "code2" => "009094",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0285491091",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "宇都宮南ＴＳ",
            "parent_id" => 19,
            "code1" => "410292",
            "code2" => "715875",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0286560530",
        ]);
        //61
        DB::table("shop_tree_elements")->insert([
            "name" => "佐野藤岡インターＴＳ",
            "parent_id" => 19,
            "code1" => "410350",
            "code2" => "714272",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0282620640",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート新4号小山北TS",
            "parent_id" => 19,
            "code1" => "410386",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0285258071",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "西那須野TS",
            "parent_id" => 19,
            "code1" => "410387",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0287366541",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東北自動車道（上り）那須高原サービスエリア",
            "parent_id" => 19,
            "code1" => "410395",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0287721207",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dｒ．Drive中条ＴＳ",
            "parent_id" => 20,
            "code1" => "015313",
            "code2" => "015038",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0254447704",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新潟ＴＳ",
            "parent_id" => 20,
            "code1" => "470447",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0253621515",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "塩沢ＴＳ",
            "parent_id" => 20,
            "code1" => "470482",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0257824783",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上越ＴＳ",
            "parent_id" => 20,
            "code1" => "470484",
            "code2" => "577629",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0255454710",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新潟白根TS",
            "parent_id" => 20,
            "code1" => "470513",
            "code2" => "577434",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0253754155",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "関越自動車道（下り）越後川口サービスエリアSS",
            "parent_id" => 20,
            "code1" => "470517",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0258894386",
        ]);
        //71
        DB::table("shop_tree_elements")->insert([
            "name" => "松本インターＴＳ",
            "parent_id" => 20,
            "code1" => "020530",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263400180",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "長野自動車道(下り）梓川サービスエリアSS",
            "parent_id" => 20,
            "code1" => "020975",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263474205",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "カーウォッシュ深ヶ丘SS",
            "parent_id" => 20,
            "code1" => "302545",
            "code2" => "460729",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263329259",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "穂高中央ＳＳ",
            "parent_id" => 20,
            "code1" => "729966",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263820315",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ高宮ＳＳ",
            "parent_id" => 20,
            "code1" => "729968",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263292224",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道（下り）駒ケ岳サービスエリアSS",
            "parent_id" => 20,
            "code1" => "020976",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0265837817",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道（上り）阿智パーキングエリアSS",
            "parent_id" => 20,
            "code1" => "460032",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0265452098",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート19塩尻ＴＳ",
            "parent_id" => 20,
            "code1" => "460681",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263510620",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート１９塩尻ＴＳ（セルフ）　　",
            "parent_id" => 20,
            "code1" => "460682",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263510620",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "駒ケ根インターTS",
            "parent_id" => 20,
            "code1" => "460717",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0265839900",
        ]);
        //81
        DB::table("shop_tree_elements")->insert([
            "name" => "中央道諏訪インターTS",
            "parent_id" => 20,
            "code1" => "460718",
            "code2" => "720939",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0266573927",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ塩尻広丘ＳＳ",
            "parent_id" => 20,
            "code1" => "460730",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0263548081",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート18篠ﾉ井バイパスTS",
            "parent_id" => 20,
            "code1" => "020016",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0262922821",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "小諸ﾊﾞｲﾊﾟｽTS",
            "parent_id" => 20,
            "code1" => "020038",
            "code2" => "724050",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0267237710",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "長野ＴＳ",
            "parent_id" => 20,
            "code1" => "020501",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0262969925",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上信越自動車道（下り）松代パーキングエリアSS",
            "parent_id" => 20,
            "code1" => "460625",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0262784406",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ大豆島ＳＳ",
            "parent_id" => 20,
            "code1" => "464877",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0262670260",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ北尾張部ＳＳ",
            "parent_id" => 20,
            "code1" => "729967",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0262397266",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ佐久平ＳＳ",
            "parent_id" => 20,
            "code1" => "729969",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0267660524",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "圏央厚木インターＴＳ",
            "parent_id" => 21,
            "code1" => "310507",
            "code2" => "311516",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0462456236",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート16橋本ＴＳ",
            "parent_id" => 21,
            "code1" => "310712",
            "code2" => "311394",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0427709231",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ横浜ゆめが丘ＳＳ",
            "parent_id" => 21,
            "code1" => "310743",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0458003278",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "相模原ﾌﾘｰﾄTS",
            "parent_id" => 21,
            "code1" => "310744",
            "code2" => "313323",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0427614220",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東名高速道路（上り）海老名サービスエリアSS",
            "parent_id" => 21,
            "code1" => "310745",
            "code2" => "314576",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0462311019",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ﾙｰﾄ129厚木TS",
            "parent_id" => 21,
            "code1" => "311172",
            "code2" => "313321",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0462041670",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "藤沢ＴＳ",
            "parent_id" => 21,
            "code1" => "310080",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0466841066",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "藤沢ＴＳ（セルフ）　　　　　　　",
            "parent_id" => 21,
            "code1" => "314115",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0466841066",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "厚木ＴＳ",
            "parent_id" => 21,
            "code1" => "310338",
            "code2" => "311333",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0463930334",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東扇島ＴＳ",
            "parent_id" => 21,
            "code1" => "310731",
            "code2" => "313138",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0442803625",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ平塚ＳＳ",
            "parent_id" => 21,
            "code1" => "310733",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0463373343",
        ]);
        //101
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive川崎産業道路TS",
            "parent_id" => 21,
            "code1" => "311171",
            "code2" => "316352",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0442762223",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "厚木インターTS",
            "parent_id" => 21,
            "code1" => "311173",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0462274711",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新屋ＳＳ",
            "parent_id" => 21,
            "code1" => "019032",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0555226837",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート246大和ＴＳ",
            "parent_id" => 21,
            "code1" => "310490",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0462602206",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート246座間TS",
            "parent_id" => 21,
            "code1" => "311170",
            "code2" => "313322",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0462537911",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ富士見バイパスＳＳ",
            "parent_id" => 21,
            "code1" => "450017",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0555212155",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道（下り）談合坂サービスエリアSS",
            "parent_id" => 21,
            "code1" => "450360",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0554662451",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道（上り）談合坂サービスエリアSS",
            "parent_id" => 21,
            "code1" => "450361",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0554662452",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ富士吉田ＳＳ",
            "parent_id" => 21,
            "code1" => "450733",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0555301555",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "甲府南口ＳＳ",
            "parent_id" => 21,
            "code1" => "019010",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0552334481",
        ]);
        //111
        DB::table("shop_tree_elements")->insert([
            "name" => "甲府東ＴＳ",
            "parent_id" => 21,
            "code1" => "019220",
            "code2" => "019222",
            "code3" => "019223",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0552611374",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "甲府勝沼ＴＳ",
            "parent_id" => 21,
            "code1" => "019221",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0553475241",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "昭和バイパスＳＳ",
            "parent_id" => 21,
            "code1" => "019263",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0552759080",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "甲西ＳＳ",
            "parent_id" => 21,
            "code1" => "019264",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0552835410",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道（上り）双葉サービスエリアSS",
            "parent_id" => 21,
            "code1" => "019270",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0551283175",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "甲府双葉ＴＳ",
            "parent_id" => 21,
            "code1" => "019272",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0551286911",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道（下り）双葉サービスエリアSS",
            "parent_id" => 21,
            "code1" => "450391",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0551283115",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ竜王ＳＳ",
            "parent_id" => 21,
            "code1" => "454798",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0552408115",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ敷島ＳＳ",
            "parent_id" => 21,
            "code1" => "454799",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0552672511",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート246裾野インターTS",
            "parent_id" => 22,
            "code1" => "022218",
            "code2" => "481982",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0550870380",
        ]);
        //121
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive沼津下香貫ＳＳ",
            "parent_id" => 22,
            "code1" => "480275",
            "code2" => "483227",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0559321055",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート246御殿場下りＴＳ",
            "parent_id" => 22,
            "code1" => "480442",
            "code2" => "483413",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0550875140",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ梅名ＳＳ",
            "parent_id" => 22,
            "code1" => "480463",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0559721223",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ大仁ＳＳ",
            "parent_id" => 22,
            "code1" => "480480",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0558755581",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "沼津バイパス下りＴＳ",
            "parent_id" => 22,
            "code1" => "480488",
            "code2" => "480748",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0559292411",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ長泉なめりＳＳ",
            "parent_id" => 22,
            "code1" => "480496",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0559806652",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "沼津バイパス上りＴＳ",
            "parent_id" => 22,
            "code1" => "481135",
            "code2" => "481138",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0559297121",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "本吉原ＳＳ",
            "parent_id" => 22,
            "code1" => "480070",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0545523571",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "清水インター下りＴＳ",
            "parent_id" => 22,
            "code1" => "480073",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543656413",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "田子の浦港ＳＳ",
            "parent_id" => 22,
            "code1" => "480074",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0545331127",
        ]);
        //131
        DB::table("shop_tree_elements")->insert([
            "name" => "富士ＴＳ",
            "parent_id" => 22,
            "code1" => "480298",
            "code2" => "483228",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0545634469",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "富士インターＴＳ",
            "parent_id" => 22,
            "code1" => "480443",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0545577550",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "清水インター東ＴＳ",
            "parent_id" => 22,
            "code1" => "480462",
            "code2" => "483108",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543611400",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ厚原ＳＳ",
            "parent_id" => 22,
            "code1" => "480473",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0545732822",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ広見インターＳＳ",
            "parent_id" => 22,
            "code1" => "480487",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0545372202",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive清水西ＳＳ",
            "parent_id" => 22,
            "code1" => "480062",
            "code2" => "483647",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543666856",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "静岡南SS",
            "parent_id" => 22,
            "code1" => "480075",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542821731",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive清水ＴＳ",
            "parent_id" => 22,
            "code1" => "480323",
            "code2" => "483648",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543510307",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ梅が岡ＳＳ",
            "parent_id" => 22,
            "code1" => "480395",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543538822",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ村松ＳＳ",
            "parent_id" => 22,
            "code1" => "480467",
            "code2" => "841147",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543371055",
        ]);
        //141
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ高橋ＳＳ",
            "parent_id" => 22,
            "code1" => "480472",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0543611151",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "高松SS",
            "parent_id" => 22,
            "code1" => "480755",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542376763",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "静岡ＳＳ",
            "parent_id" => 22,
            "code1" => "480060",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542545371",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "石田ＳＳ",
            "parent_id" => 22,
            "code1" => "480296",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542817455",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ沓谷ＳＳ",
            "parent_id" => 22,
            "code1" => "480303",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542626123",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "静岡丸子ＴＳ",
            "parent_id" => 22,
            "code1" => "480400",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542560508",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ焼津ＳＳ",
            "parent_id" => 22,
            "code1" => "480461",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0546215758",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ静岡インターＳＳ",
            "parent_id" => 22,
            "code1" => "480478",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542035123",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ藤枝大手ＳＳ",
            "parent_id" => 22,
            "code1" => "480486",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0546471140",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新東名高速道路（下り）静岡サービスエリアSS",
            "parent_id" => 22,
            "code1" => "480867",
            "code2" => "481980",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0542762381",
        ]);
        //151
        DB::table("shop_tree_elements")->insert([
            "name" => "原谷ＳＳ",
            "parent_id" => 22,
            "code1" => "480265",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0537260207",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "掛川北ＳＳ",
            "parent_id" => 22,
            "code1" => "480331",
            "code2" => "483109",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0537243882",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上山梨ＳＳ",
            "parent_id" => 22,
            "code1" => "480369",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0538486018",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "掛川ＴＳ",
            "parent_id" => 22,
            "code1" => "480375",
            "code2" => "483150",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0537221680",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "袋井ＴＳ",
            "parent_id" => 22,
            "code1" => "480452",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0538447111",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ菊川ＳＳ",
            "parent_id" => 22,
            "code1" => "480485",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0537372424",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "袋井インターＴＳ",
            "parent_id" => 22,
            "code1" => "480490",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0538453660",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート１掛川TS",
            "parent_id" => 22,
            "code1" => "480758",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0537272065",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "豊川インターＴＳ",
            "parent_id" => 23,
            "code1" => "023365",
            "code2" => "023891",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0533842787",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ浜松南陽ＳＳ",
            "parent_id" => 23,
            "code1" => "480405",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534660700",
        ]);
        //161
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ天竜川ＳＳ",
            "parent_id" => 23,
            "code1" => "480474",
            "code2" => "483650",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534231600",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ磐田一言ＳＳ",
            "parent_id" => 23,
            "code1" => "480499",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0538393911",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜松インターＴＳ",
            "parent_id" => 23,
            "code1" => "480500",
            "code2" => "484374",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534311611",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ新城杉山ＳＳ",
            "parent_id" => 23,
            "code1" => "101857",
            "code2" => "500139",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0536243205",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive浜松西ＳＳ",
            "parent_id" => 23,
            "code1" => "480121",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534523875",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜松中央通りＳＳ",
            "parent_id" => 23,
            "code1" => "480138",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534544351",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ小豆餅ＳＳ",
            "parent_id" => 23,
            "code1" => "480464",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534161283",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ有玉ＳＳ",
            "parent_id" => 23,
            "code1" => "480470",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534316350",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東名高速道路（下り）上郷サービスエリアＳＳ",
            "parent_id" => 23,
            "code1" => "500759",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0565285448",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東名高速道路（上り）上郷サービスエリアＳＳ",
            "parent_id" => 23,
            "code1" => "500762",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0565285446",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東名高速道路（下り）浜名湖サービスエリアSS",
            "parent_id" => 23,
            "code1" => "480125",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0535267621",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜松高丘西ＴＳ",
            "parent_id" => 23,
            "code1" => "480311",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534373533",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "三ヶ日インターＴＳ",
            "parent_id" => 23,
            "code1" => "480434",
            "code2" => "483229",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0535262546",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ新居ＳＳ",
            "parent_id" => 23,
            "code1" => "480476",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0535951721",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜松西インターTS",
            "parent_id" => 23,
            "code1" => "480766",
            "code2" => "481981",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534863333",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "富士見台ＳＳ",
            "parent_id" => 23,
            "code1" => "023265",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532250121",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート1豊橋東ＴＳ",
            "parent_id" => 23,
            "code1" => "023268",
            "code2" => "023889",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532410411",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ豊橋飯村ＳＳ",
            "parent_id" => 23,
            "code1" => "023501",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532692081",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ豊橋立岩ＳＳ",
            "parent_id" => 23,
            "code1" => "023834",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532652252",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜松中田島下りＴＳ",
            "parent_id" => 23,
            "code1" => "480377",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534420852",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜松中田島上りＴＳ",
            "parent_id" => 23,
            "code1" => "480453",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0534431300",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ磯辺ＳＳ",
            "parent_id" => 23,
            "code1" => "504725",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532388580",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "豊橋新栄ＳＳ",
            "parent_id" => 23,
            "code1" => "023269",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532336511",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ岡崎六ッ美ＳＳ",
            "parent_id" => 23,
            "code1" => "023285",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0564536811",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "豊橋西ＴＳ",
            "parent_id" => 23,
            "code1" => "023364",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0533854820",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新東名高速道路岡崎サービスエリアSS",
            "parent_id" => 23,
            "code1" => "500272",
            "code2" => "500392",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0564662130",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ新栄ＳＳ",
            "parent_id" => 23,
            "code1" => "560022",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0532352511",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "安城東栄ＴＳ",
            "parent_id" => 23,
            "code1" => "561347",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0566978333",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "名岐ﾊﾞｲﾊﾟｽＴＳ",
            "parent_id" => 24,
            "code1" => "023073",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0568225725",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート41小牧ＴＳ",
            "parent_id" => 24,
            "code1" => "023718",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0568281505",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveルート41豊山ＴＳ",
            "parent_id" => 24,
            "code1" => "500744",
            "code2" => "500783",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0568391256",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "小牧インターＴＳ",
            "parent_id" => 24,
            "code1" => "500749",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0568715115",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "小牧ＴＳ",
            "parent_id" => 24,
            "code1" => "500758",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0568741950",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート22木曽川インターＴＳ",
            "parent_id" => 24,
            "code1" => "500772",
            "code2" => "500786",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0586861701",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート１９恵那ＴＳ",
            "parent_id" => 24,
            "code1" => "520078",
            "code2" => "520198",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0573200630",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岐阜羽島インターＴＳ",
            "parent_id" => 24,
            "code1" => "520275",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0583981904",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ各務原インターＳＳ",
            "parent_id" => 24,
            "code1" => "520292",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0583823532",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東海北陸自動車道（上り）関サービスエリアＳＳ",
            "parent_id" => 24,
            "code1" => "520302",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0575249277",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央道多治見インターＴＳ",
            "parent_id" => 24,
            "code1" => "520303",
            "code2" => "520310",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0572295754",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東海北陸自動車道下り長良川サービスエリアＳＳ",
            "parent_id" => 24,
            "code1" => "520304",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0575232373",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中央自動車道上り虎渓山パーキングエリアＳＳ",
            "parent_id" => 24,
            "code1" => "520306",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0572214805",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "若宮大通ＳＳ",
            "parent_id" => 24,
            "code1" => "500761",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0522624661",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "菊井町ＳＳ",
            "parent_id" => 24,
            "code1" => "561318",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0525713538",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ雁道ＳＳ",
            "parent_id" => 24,
            "code1" => "561320",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0528714795",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "洲崎橋ＳＳ",
            "parent_id" => 24,
            "code1" => "561322",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0522217005",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大曽根ＳＳ",
            "parent_id" => 24,
            "code1" => "561324",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0529146057",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "丸の内ＳＳ",
            "parent_id" => 24,
            "code1" => "561325",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0522116366",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "加福本通ＴＳ",
            "parent_id" => 24,
            "code1" => "500775",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0526125915",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "新栄町ＳＳ",
            "parent_id" => 24,
            "code1" => "561317",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0522624561",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大須ＳＳ",
            "parent_id" => 24,
            "code1" => "561321",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0523312238",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東郊通ＳＳ",
            "parent_id" => 24,
            "code1" => "561323",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0528710604",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "千種橋ＳＳ",
            "parent_id" => 24,
            "code1" => "561327",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0522623071",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東川端ＳＳ",
            "parent_id" => 24,
            "code1" => "561329",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0522516441",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "名阪治田インターＴＳ",
            "parent_id" => 24,
            "code1" => "024072",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0595201196",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "伊勢自動車道（上り）安濃サービスエリアＳＳ",
            "parent_id" => 24,
            "code1" => "510148",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0592681206",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "伊勢自動車道（下り）安濃サービスエリアＳＳ",
            "parent_id" => 24,
            "code1" => "510156",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0592681102",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "名阪白樫インターＴＳ",
            "parent_id" => 24,
            "code1" => "510227",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0595201043",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive名阪中瀬インターＴＳ",
            "parent_id" => 24,
            "code1" => "510229",
            "code2" => "510329",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0595239925",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ高茶屋ＳＳ",
            "parent_id" => 24,
            "code1" => "510238",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0592383017",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "飛島臨海ＴＳ",
            "parent_id" => 24,
            "code1" => "023074",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0567552886",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveあま七宝ＳＳ",
            "parent_id" => 24,
            "code1" => "023764",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0524492381",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "国道堀田ＴＳ",
            "parent_id" => 24,
            "code1" => "500756",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0528112146",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ七宝下田SS",
            "parent_id" => 24,
            "code1" => "560041",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0524626450",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート23飛島ＴＳ",
            "parent_id" => 24,
            "code1" => "560044",
            "code2" => "560045",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0567565580",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート23四日市ＴＳ",
            "parent_id" => 24,
            "code1" => "519706",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0593662031",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "亀山ＴＳ",
            "parent_id" => 24,
            "code1" => "024115",
            "code2" => "024171",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0595821084",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート23川越ＴＳ",
            "parent_id" => 24,
            "code1" => "519707",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0593660673",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート23鈴鹿ＴＳ",
            "parent_id" => 24,
            "code1" => "510255",
            "code2" => "510257",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0593835267",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ東日野ＳＳ",
            "parent_id" => 24,
            "code1" => "510249",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0593202150",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "富山小杉ＴＳ",
            "parent_id" => 25,
            "code1" => "016249",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0766553981",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸自動車道（下り）尼御前サービスエリアＳＳ",
            "parent_id" => 25,
            "code1" => "017080",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0761752217",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "富山黒部ＴＳ",
            "parent_id" => 25,
            "code1" => "530176",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0765725200",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸自動車道(上り)小矢部川サービスエリアＳＳ",
            "parent_id" => 25,
            "code1" => "530258",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0766614354",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸自動車道（上り）有磯海サービスエリアＳＳ",
            "parent_id" => 25,
            "code1" => "530259",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0764771318",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸自動車道（下り）有磯海サービスエリアＳＳ",
            "parent_id" => 25,
            "code1" => "530263",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0765245349",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "北陸自動車道(下り)小矢部川サービスエリアＳＳ",
            "parent_id" => 25,
            "code1" => "530264",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0766614353",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート8滑川インターＴＳ",
            "parent_id" => 25,
            "code1" => "531840",
            "code2" => "531857",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0764759545",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "金沢東インターＴＳ",
            "parent_id" => 25,
            "code1" => "540201",
            "code2" => "540203",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0762523635",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "金沢西インターＴＳ",
            "parent_id" => 25,
            "code1" => "540202",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0762676521",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "武生ＴＳ",
            "parent_id" => 25,
            "code1" => "550141",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0778223858",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "栗東ひがしＴＳ",
            "parent_id" => 26,
            "code1" => "630091",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0748722394",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート１水口ＴＳ",
            "parent_id" => 26,
            "code1" => "630102",
            "code2" => "630134",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0748636931",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート8木之本ＴＳ",
            "parent_id" => 26,
            "code1" => "630129",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0749828101",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "名神八日市インターＴＳ",
            "parent_id" => 26,
            "code1" => "630130",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0748230058",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "栗東ＴＳ",
            "parent_id" => 26,
            "code1" => "630131",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0775522173",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート8彦根ＴＳ",
            "parent_id" => 26,
            "code1" => "639348",
            "code2" => "630133",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0749212322",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveルート1京都八幡ＴＳ",
            "parent_id" => 26,
            "code1" => "026252",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0759826511",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート171大山崎ＴＳ",
            "parent_id" => 26,
            "code1" => "026306",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0759555706",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "寝屋川ＴＳ",
            "parent_id" => 26,
            "code1" => "600426",
            "code2" => "600825",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0728376710",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "機械団地ＴＳ",
            "parent_id" => 26,
            "code1" => "600755",
            "code2" => "600851",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0667442527",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "京都南ＴＳ",
            "parent_id" => 26,
            "code1" => "620011",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0756315643",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート27東舞鶴ＴＳ",
            "parent_id" => 26,
            "code1" => "620161",
            "code2" => "620164",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0773662150",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岸和田臨海ＴＳ",
            "parent_id" => 26,
            "code1" => "027397",
            "code2" => "600859",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0724397490",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大阪南港大和川通りＴＳ",
            "parent_id" => 26,
            "code1" => "600711",
            "code2" => "600827",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0647028181",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "阪和道岸和田インターＴＳ",
            "parent_id" => 26,
            "code1" => "600756",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0724791071",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "阪和自動車道（上り）岸和田サービスエリアＳＳ",
            "parent_id" => 26,
            "code1" => "600806",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0724792265",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大阪南港通りＴＳ",
            "parent_id" => 26,
            "code1" => "600815",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0666860801",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive大阪南港通り柴谷ＴＳ",
            "parent_id" => 26,
            "code1" => "600878",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0666815101",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "阪和自動車道(下り）紀ノ川サービスエリアSS",
            "parent_id" => 26,
            "code1" => "650109",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0734618870",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "第2神明明石西インターチェンジＴＳ",
            "parent_id" => 26,
            "code1" => "028248",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0789420407",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "第二神明道路（上）明石ＳＡＳＳ",
            "parent_id" => 26,
            "code1" => "610625",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0789355200",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "相生上りＴＳ",
            "parent_id" => 26,
            "code1" => "028354",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0791492265",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート９和田山ＴＳ",
            "parent_id" => 26,
            "code1" => "610485",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0796703050",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "神戸摩耶ＴＳ",
            "parent_id" => 26,
            "code1" => "610509",
            "code2" => "619000",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0788060181",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山陽道竜野インターＴＳ",
            "parent_id" => 26,
            "code1" => "610521",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0791629771",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート43神戸ＴＳ",
            "parent_id" => 26,
            "code1" => "610572",
            "code2" => "610593",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0788547330",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "舞鶴若狭自動車道（上り）西紀サービスエリアSS",
            "parent_id" => 26,
            "code1" => "610600",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0795931333",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "徳島自動車道（上り）吉野川サービスエリアSS",
            "parent_id" => 26,
            "code1" => "660155",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0883765551",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "徳島自動車道（下り）吉野川サービスエリアSS",
            "parent_id" => 26,
            "code1" => "660154",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0883765070",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "高知自動車道（上り）南国サービスエリアSS",
            "parent_id" => 26,
            "code1" => "690134",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0888783660",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr．Driveルート２岡山東ＴＳ",
            "parent_id" => 27,
            "code1" => "033004",
            "code2" => "033970",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0862970451",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山陽道笠岡インターＴＳ",
            "parent_id" => 27,
            "code1" => "033154",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0865637383",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岡山下りＴＳ",
            "parent_id" => 27,
            "code1" => "033432",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0865644120",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岡山ＴＳ",
            "parent_id" => 27,
            "code1" => "800215",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0862748051",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "美作インターＴＳ",
            "parent_id" => 27,
            "code1" => "800218",
            "code2" => "804235",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0868726118",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート2早島インターＴＳ",
            "parent_id" => 27,
            "code1" => "800222",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0864822111",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山陽自動車道（下り）吉備サービスエリアＳＳ",
            "parent_id" => 27,
            "code1" => "800298",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0862848621",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "広島東ＴＳ",
            "parent_id" => 27,
            "code1" => "810323",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0846291980",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "尾道ＴＳ",
            "parent_id" => 27,
            "code1" => "810389",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0848461890",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "西部流通団地ＴＳ",
            "parent_id" => 27,
            "code1" => "810411",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0822782665",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート54三次ＴＳ",
            "parent_id" => 27,
            "code1" => "810442",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0824641221",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "出島ＴＳ",
            "parent_id" => 27,
            "code1" => "810443",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0822546856",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中国自動車道（上り）安佐サービスエリアＳＳ",
            "parent_id" => 27,
            "code1" => "810449",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0828350855",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中国自動車道（下り）安佐サービスエリアＳＳ",
            "parent_id" => 27,
            "code1" => "810450",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0828352348",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "米子自動車道（下り）蒜山高原サービスエリアＳＳ",
            "parent_id" => 27,
            "code1" => "800252",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0867664517",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中国自動車道（下り）大佐サービスエリアＳＳ",
            "parent_id" => 27,
            "code1" => "800256",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0867982774",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中国自動車道（上り）大佐サービスエリアＳＳ",
            "parent_id" => 27,
            "code1" => "800257",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0867982773",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "米子インターＴＳ",
            "parent_id" => 27,
            "code1" => "820090",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0859275371",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "出雲ＴＳ",
            "parent_id" => 27,
            "code1" => "830198",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0853430102",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東出雲インターＴＳ",
            "parent_id" => 27,
            "code1" => "838975",
            "code2" => "834147",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0852530278",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "広島廿日市インターＴＳ",
            "parent_id" => 27,
            "code1" => "810426",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0829372631",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山陽道埴生インター下りＴＳ",
            "parent_id" => 27,
            "code1" => "840173",
            "code2" => "840266",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0836791122",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岩国欽明路ＴＳ",
            "parent_id" => 27,
            "code1" => "840213",
            "code2" => "840267",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0827460927",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "宇部ＴＳ",
            "parent_id" => 27,
            "code1" => "840216",
            "code2" => "840297",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0836621086",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "徳山西インターＴＳ",
            "parent_id" => 27,
            "code1" => "840221",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0834833777",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山陽道埴生インター上りＴＳ",
            "parent_id" => 27,
            "code1" => "840283",
            "code2" => "848123",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0836790560",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "福岡上りＴＳ",
            "parent_id" => 28,
            "code1" => "910053",
            "code2" => "910650",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0929406868",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート10豊前ＴＳ",
            "parent_id" => 28,
            "code1" => "910205",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0979834201",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ豊前ＳＳ",
            "parent_id" => 28,
            "code1" => "910222",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0979840252",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "久山町ＴＳ",
            "parent_id" => 28,
            "code1" => "910235",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0929761664",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "太宰府インターＴＳ",
            "parent_id" => 28,
            "code1" => "910253",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0925039541",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート200飯塚東ＴＳ",
            "parent_id" => 28,
            "code1" => "910262",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0949627402",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大分自動車道（下り）山田サービスエリアSS",
            "parent_id" => 28,
            "code1" => "910534",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0946522272",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "基山ＴＳ",
            "parent_id" => 28,
            "code1" => "041173",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0942925907",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ﾙｰﾄ3鳥栖TS",
            "parent_id" => 28,
            "code1" => "910233",
            "code2" => "920076",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0942817045",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Ｄｒ.Drive遠賀みずまきＴＳ",
            "parent_id" => 28,
            "code1" => "910489",
            "code2" => "910522",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0932807688",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "九州自動車道（上り）宮原サービスエリアＳＳ",
            "parent_id" => 28,
            "code1" => "940037",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0965623525",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "九州自動車道（上り）山江サービスエリアＳＳ",
            "parent_id" => 28,
            "code1" => "940064",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0966242807",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "植木インターＴＳ",
            "parent_id" => 28,
            "code1" => "940100",
            "code2" => "940171",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0962730033",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "九州自動車道（下り）宮原サービスエリアＳＳ",
            "parent_id" => 28,
            "code1" => "940162",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0965623369",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "八代インターTS",
            "parent_id" => 28,
            "code1" => "940446",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0965349801",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "武雄インターＳＳ",
            "parent_id" => 29,
            "code1" => "041217",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0954365665",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "小城ＳＳ",
            "parent_id" => 29,
            "code1" => "041184",
            "code2" => "041186",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952733158",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive佐賀牛津ＳＳ",
            "parent_id" => 29,
            "code1" => "041185",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952665222",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "多久インターＳＳ",
            "parent_id" => 29,
            "code1" => "041075",
            "code2" => "041085",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952763320",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "佐賀城北ＳＳ",
            "parent_id" => 29,
            "code1" => "041010",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952313558",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Driveセルフ八戸溝ＳＳ",
            "parent_id" => 29,
            "code1" => "041007",
            "code2" => "041011",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952333988",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "佐賀西与賀ＳＳ",
            "parent_id" => 29,
            "code1" => "041008",
            "code2" => "041012",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952282226",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "佐賀光法ＳＳ",
            "parent_id" => 29,
            "code1" => "041005",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952255525",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "佐賀鍋島ＳＳ",
            "parent_id" => 29,
            "code1" => "041006",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952337575",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "長崎自動車道（下り）金立サービスエリアＳＳ",
            "parent_id" => 29,
            "code1" => "920118",
            "direct" => 1,
            "shop_tree_level_id" => 4,
            "tel" => "0952982892",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "掛田ＳＳ",
            "parent_id" => 17,
            "code1" => "295860",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0245642666",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "松島ＳＳ",
            "parent_id" => 17,
            "code1" => "278493",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0223543313",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "落合ＳＳ",
            "parent_id" => 17,
            "code1" => "278494",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0223922261",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "藤崎ＳＳ",
            "parent_id" => 17,
            "code1" => "209238",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0172753439",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート6小名浜ＳＳ",
            "parent_id" => 17,
            "code1" => "295861",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0246566851",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "大郷バイパスＳＳ",
            "parent_id" => 17,
            "code1" => "278538",
            "code2" => "278545",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0223592129",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "郡山インターＳＳ",
            "parent_id" => 17,
            "code1" => "250126",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0249592701",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山形バイパス漆山ＳＳ",
            "parent_id" => 17,
            "code1" => "860020",
            "code2" => "2401305",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0236863300",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ﾆｭｰ鹿島ＳＳ",
            "parent_id" => 17,
            "code1" => "007371",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0244463072",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "六日町ＳＳ",
            "parent_id" => 17,
            "code1" => "470530",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0257762483",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "高森ＳＳ",
            "parent_id" => 24,
            "code1" => "460716",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0265352497",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート150浅羽町ＳＳ",
            "parent_id" => 24,
            "code1" => "480765",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0538238233",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "浜岡バイパスＳＳ",
            "parent_id" => 24,
            "code1" => "480761",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0537864788",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "桜ヶ池ＳＳ",
            "parent_id" => 24,
            "code1" => "480760",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0537865800",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "セルフ藤枝ＳＳ",
            "parent_id" => 24,
            "code1" => "480762",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0546413440",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上品野ＳＳ",
            "parent_id" => 24,
            "code1" => "561330",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0561410881",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "春日井ＳＳ",
            "parent_id" => 24,
            "code1" => "561326",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0568818731",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "黒部ﾌﾘｰﾄＳＳ",
            "parent_id" => 25,
            "code1" => "531839",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0765720088",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "鈴鹿道伯ＳＳ",
            "parent_id" => 24,
            "code1" => "519702",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0593781442",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ライク津島ＳＳ",
            "parent_id" => 24,
            "code1" => "519704",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0567310562",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ﾆｭｰ 海津ＳＳ",
            "parent_id" => 24,
            "code1" => "520280",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0584532400",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "桑名インターＳＳ",
            "parent_id" => 24,
            "code1" => "510228",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0594311500",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート258多度ＳＳ",
            "parent_id" => 24,
            "code1" => "510250",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0594482994",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東端ＳＳ",
            "parent_id" => 24,
            "code1" => "561335",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0566415489",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "江原町ＳＳ",
            "parent_id" => 24,
            "code1" => "561334",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0563523151",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "上町ＳＳ",
            "parent_id" => 24,
            "code1" => "561333",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0563571273",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "稲津ＳＳ",
            "parent_id" => 24,
            "code1" => "529856",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0572684581",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "岸貝ＳＳ",
            "parent_id" => 26,
            "code1" => "600813",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0724399234",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive淀川ＳＳ",
            "parent_id" => 26,
            "code1" => "027159",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0664750397",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "Dr.Drive大和田ＳＳ",
            "parent_id" => 26,
            "code1" => "027205",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0664730288",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "東大田ＴＳ",
            "parent_id" => 27,
            "code1" => "830252",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0854824455",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "ルート54八千代ＳＳ",
            "parent_id" => 27,
            "code1" => "810451",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0826522818",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "山代ＳＳ",
            "parent_id" => 29,
            "code1" => "041040",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0955282115",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "中泉ＳＳ",
            "parent_id" => 28,
            "code1" => "040204",
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0949231975",
        ]);
        DB::table("shop_tree_elements")->insert([
            "name" => "本社ＳＳ",
            "parent_id" => 24,
            "direct" => 0,
            "shop_tree_level_id" => 4,
            "tel" => "0522693210",
        ]);
            
            

        // エネオスウイング 中部支社 愛知エリア 豊橋店1 商品
        DB::table("shop_oils")->insert([
            "name" => "レギュラー",
            "shop_tree_element_id" => 8,
        ]);
    }
}