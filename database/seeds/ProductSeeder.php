<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // サプライヤー

        DB::table("suppliers")->insert([
            "name" => "株式会社コジマ",
        ]);
        DB::table("suppliers")->insert([
            "name" => "株式会社ハーモニック",
        ]);
        DB::table("suppliers")->insert([
            "name" => "ギフティ",
        ]);

        // 景品カテゴリ

        DB::table("product_categories")->insert([
            "name" => "家電",
        ]);
        DB::table("product_categories")->insert([
            "name" => "パソコン・周辺機器",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "映像・音響",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "生活家電",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "キッチン家電",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "照明",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "美容・健康家電",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "その他",
            "parent_id" => 1,
        ]);
        DB::table("product_categories")->insert([
            "name" => "衣・食・住",
        ]);
        DB::table("product_categories")->insert([
            "name" => "インテリア・収納",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "キッチン用品",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "食品・飲料",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "日用品",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "スポーツ・レジャー",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "避難・防災用品",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "その他",
            "parent_id" => 9,
        ]);
        DB::table("product_categories")->insert([
            "name" => "雑貨・ギフト",
        ]);
        DB::table("product_categories")->insert([
            "name" => "雑貨・ギフト",
            "parent_id" => 17,
        ]);
        DB::table("product_categories")->insert([
            "name" => "カタログギフト",
            "parent_id" => 17,
        ]);
        DB::table("product_categories")->insert([
            "name" => "その他",
            "parent_id" => 17,
        ]);
        DB::table("product_categories")->insert([
            "name" => "その他",
        ]);
        DB::table("product_categories")->insert([
            "name" => "その他",
            "parent_id" => 21,
        ]);
        DB::table("product_categories")->insert([
            "name" => "自動車用品",
        ]);
        DB::table("product_categories")->insert([
            "name" => "トラック用品",
            "parent_id" => 23,
        ]);
        DB::table("product_categories")->insert([
            "name" => "洗車・清掃用品",
            "parent_id" => 23,
        ]);
        DB::table("product_categories")->insert([
            "name" => "その他",
            "parent_id" => 23,
        ]);
        DB::table("product_categories")->insert([
            "name" => "自動車用品",
        ]);
        DB::table("product_categories")->insert([
            "name" => "トラック用品",
            "parent_id" => 23,
        ]);
        DB::table("product_categories")->insert([
            "name" => "デジタルギフト券",
        ]);
        DB::table("product_categories")->insert([
            "name" => "デジタルギフト券",
            "parent_id" => 29,
        ]);

        // 景品

        DB::table("products")->insert([
            "name" => "giftee Box",
            "catalog_basic_point" => 40,
            "product_category_id" => 29,
            "supplier_id" => 3,
            "operation_id" => "A0000001-1",
            "maker_name" => "giftee",
            "maker_url" => "https://giftee.biz/consumer/gifteebox/about/",
            "description_1" => "giftee Boxは、最大500種類のラインナップの中から、好きな商品を選べるギフトです。
            ポイント内であれば複数のギフトと自由に交換することができます。
            giftee Boxの利用に専用アプリのダウンロードや会員登録は必要ありません。",
            "description_2" => "・ラインナップの中から好きな商品と交換できる、giftee Box ポイントを付与します。
            ・ラインナップおよび交換に必要なポイントは付与されたgiftee Boxにより異なり、変更になる場合がございます。またgiftee Box内のポイント交換レートは商品により異なります。記載された必要ポイント数をよくご確認の上、商品と交換ください。
            ・ポイントの利用には期限がございます。ホーム画面に表示された期限までにお好きな商品と交換ください。
            ・期限終了後、ポイント残高は失効します。ポイントの払い戻しはお受けしておりません。
            ・ポイントの追加チャージはできません。
            ・商品交換後の商品の変更・キャンセルはできません。",
            "notice" => "※ギフトのご利用は、期限がございます。また期限の延長は致しかねますので、ご了承ください。
            ※スマートフォンでご利用ください。
            ※スクリーンショットではご利用いただけません。
            ※交換権利の換金・他人への譲渡・転売はできませんのでご注意ください。
            ※いかなる理由があっても再発行は致しかねます。
            ※本キャンペーンに関して応募者が被った損害または損失などについては、当社の故意または重過失に起因する場合を除き、当社は一切の責任を負わないものとします。
            ※本キャンペーンは株式会社ENEOSウイングによる提供です。
            ※本キャンペーンについてのお問い合わせはAmazonではお受けしておりません。株式会社ENEOSウイング 乗務員様 謝恩祭 2022年 コンタクトセンター（フリーダイヤル 0120-737-105）までお願いいたします。
            ※Amazon、Amazon.co.jp およびそれらのロゴはAmazon.com, Inc.またはその関連会社の商標です。",
            "is_giftee_box" => true,
        ]);
        DB::table("products")->insert([
            "name" => "アシカぬいぐるみ",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "ウサギぬいぐるみ",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "ネコぬいぐるみ",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "シャープ 50V型 液晶テレビ AQUOS 4T-C50CL1",
            "product_category_id" => 2,
        ]);
        DB::table("products")->insert([
            "name" => "パナソニック 55V型 有機ELテレビ VIERA TH-55JZ2000",
            "product_category_id" => 2,
        ]);
        DB::table("products")->insert([
            "name" => "アイリスオーヤマ ハンディスティッククリーナー IC-SLDCP10-R",
            "product_category_id" => 3,
        ]);
        DB::table("products")->insert([
            "name" => "シャープ サイクロン掃除機 EC-CT12-C",
            "product_category_id" => 3,
        ]);
        DB::table("products")->insert([
            "name" => "ポテトチップス（コンソメ）",
            "product_category_id" => 5,
        ]);
        DB::table("products")->insert([
            "name" => "ジャガリコ",
            "product_category_id" => 5,
        ]);
        DB::table("products")->insert([
            "name" => "缶コーヒー（無糖）",
            "product_category_id" => 6,
        ]);
        DB::table("products")->insert([
            "name" => "コカ・コーラ",
            "product_category_id" => 6,
        ]);
        DB::table("products")->insert([
            "name" => "ラッコぬいぐるみ",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "ラッコぬいぐるみ",
            "product_category_id" => 7,
        ]);

        DB::table("products")->insert([
            "name" => "こだわり暖簾 味くらべ6食",
            "catalog_basic_point" => 60,
            "product_category_id" => 12,
            "supplier_id" => 1,
            "operation_id" => "A0000001-1",
            "description_1" => "こだわりの味を4種類詰め合わせました。",
            "description_2" => "●セット内容:豚骨（麺80g、スープ付）・味噌（麺80g、スープ付）各2、水炊き（麺80g、スープ付）・あごだし醤油（麺80g、スープ付）各1　●加工地:日本【小麦・卵・乳】●箱:約33.5×21.8×4.5cm（化粧箱）【12】",
            "notice" => "※乾麺です。※このページの商品は、シーズン途中で内容・パッケージ・原産地・加工地等が変更になる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "酵素焙煎ドリップコーヒーセット",
            "catalog_basic_point" => 60,
            "product_category_id" => 12,
            "supplier_id" => 1,
            "operation_id" => "A0000002-1",
            "description_1" => "世界の優れた珈琲農園から厳選した珈琲豆を独自製法「酵素焙煎」。ベテラン珈琲焙煎士が丁寧に焙煎。それぞれの産地に合わせた焙煎度合いでアフターブレンドしています。「味・香り・旨み」の揃った珈琲を1杯ずつドリップバッグに凝縮しました。",
            "description_2" => "●セット内容:クラシックブレンド7g×8・エクセレントブレンド7g×4 ●生豆生産国:ブラジル・コロンビア他 ●加工地:日本 ●箱:約33×26×3.5cm（化粧箱） 【20】",
            "notice" => "※このページの商品は、シーズン途中で内容・パッケージ・原産地・加工地等が変更になる場合がございます。",
            "maker_name" => "ビクトリアコーヒー",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "フィルターインボトル",
            "product_category_id" => 11,
            "supplier_id" => 1,
            "operation_id" => "A0000003-0",
            "description_1" => "ワインのように食事の時に水出し茶を愉しんでいただきたいという思いからできた、ワインボトル型の水出し茶ボトル。注ぎ口部分にフィルターがセットされているのでそのまま注げます。",
            "description_2" => "●商品:約8.7×8.4×高さ30cm・750ml●材質:耐熱ガラス・シリコーンゴム・ポリプロピレン●日本製",
            "notice" => "※商品の性質上、色彩・柄・形状等が多少異なる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "フィルターインボトル",
            "catalog_basic_point" => 80,
            "product_category_id" => 11,
            "variation_parent_id" => 17,
            "variation_name" => "レッド",
            "supplier_id" => 1,
            "operation_id" => "A0000003-1",
        ]);
        DB::table("products")->insert([
            "name" => "フィルターインボトル",
            "catalog_basic_point" => 80,
            "product_category_id" => 11,
            "variation_parent_id" => 17,
            "variation_name" => "オリーブグリーン",
            "supplier_id" => 1,
            "operation_id" => "A0000003-2",
        ]);
        DB::table("products")->insert([
            "name" => "タンブラー6個セット",
            "catalog_basic_point" => 96,
            "product_category_id" => 11,
            "supplier_id" => 1,
            "operation_id" => "A0000004-1",
            "description_1" => "全面物理強化ガラスの安全性はもちろん、小ぶりなサイズなので、お子様の手にもなじみ、大人も子供も安心してお使いいただけます。",
            "description_2" => "●商品:タンブラー(約口径7.4×高さ7.8cm・170ml)×6●材質:強化ガラス●フランス製",
            "notice" => "※海外より輸入している為、お届けが大幅に遅れる場合がございます。※商品の性質上、色彩・柄・形状等が多少異なる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ブランケット1枚",
            "product_category_id" => 17,
            "supplier_id" => 1,
            "operation_id" => "A0000005-0",
            "description_1" => "ブランケットにもぬいぐるみにも!洗濯機でお洗濯もできます。",
            "description_2" => "●商品:使用時/約65×100cm、収納時/約15×15×高さ23cm　●材質:ポリエステル100%　●中国製●箱:約15×12×30cm（袋）",
            "notice" => "洗濯機OK※商品の性質上、サイズ・色彩・形状等が多少異なる場合がございます。※シーズン途中でデザイン等が変更になる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ブランケット1枚",
            "catalog_basic_point" => 120,
            "product_category_id" => 17,
            "variation_parent_id" => 21,
            "variation_name" => "いぬ",
            "supplier_id" => 1,
            "operation_id" => "A0000005-1",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "ブランケット1枚",
            "catalog_basic_point" => 120,
            "product_category_id" => 17,
            "variation_parent_id" => 21,
            "variation_name" => "ぞう",
            "supplier_id" => 1,
            "operation_id" => "A0000005-2",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "エマ－ジェンシ－セット",
            "catalog_basic_point" => 120,
            "product_category_id" => 15,
            "supplier_id" => 1,
            "operation_id" => "A0000006-1",
            "description_1" => "外出時のバッグの中などに収納して万が一に備える携帯防災ツール。化粧箱にまとめて本棚などに収納できます。",
            "description_2" => "●商品:収納ポーチ(約20×5×高さ15cm)・アルミブランケット(約130×210cm)・IDホイッスル&カラビナリング・レインコート・防災用ウェットティッシュ・携帯トイレ・ソーイングセット・軍手・カイロ・マスク・防災の心得各1●防災用ウェットティッシュ・カイロ・防災の心得/日本製、その他/中国製",
            "notice" => "※ソーイングセットはアソート商品のため、写真と色が異なる場合がございます。※シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "アイスクリーム・シャーベットセット",
            "catalog_basic_point" => 160,
            "product_category_id" => 12,
            "supplier_id" => 1,
            "operation_id" => "A0000007-1",
            "description_1" => "神戸　芦屋の人気洋菓子店「シェフアサヤマ」オーナーシェフ朝山末男氏が監修したアイスアソートは素材を活かして作り上げたバニラ、ストロベリー、マンゴー、カスタードの4つの味が楽しめます。",
            "description_2" => "●セット内容:アイスクリーム(バニラ80ml×4、ストロベリー80ml・カスタード80ml各3)、マンゴーシャーベット80ml×3●加工地:兵庫県【卵・乳】",
            "maker_name" => "芦屋アサヤマ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "3WAY防災バッグセット",
            "catalog_basic_point" => 160,
            "product_category_id" => 15,
            "supplier_id" => 1,
            "operation_id" => "A0000008-1",
            "description_1" => "ポケットが2つと網ポケットが2つ付いている便利な防災バッグ。リュックタイプ・肩掛け・手提げの3通りで使用できます。",
            "description_2" => "●商品:3WAY防災バッグ(約28×15×高さ18cm)・ジャバラ式水タンク(約3L用)・保温アルミシート(約180×90cm)・非常用ロープ(約3m)・簡易寝袋(約100×200cm)・軍手・ホイッスル各1●中国製",
            "notice" => "※シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "LEDサーチライト(充電式)",
            "catalog_basic_point" => 200,
            "product_category_id" => 6,
            "supplier_id" => 1,
            "operation_id" => "A0000009-1",
            "description_1" => "アウトドアや暗い場所での作業などに使用できます。ハンドルで手持ちもできます。",
            "description_2" => "●商品:約幅23.5×奥16×高さ18cm・LED球●材質:ポリプロピレン・ABS樹脂・ポリスチレン・ポリエステル●内容:2WAYハンドル式・約8～9時間充電式・約4～5時間使用可・ACアダプター・DCアダプター・ショルダーストラップ付●電源:2電源式(AC100V・DC12V)●中国製",
            "notice" => "※シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ツールセット",
            "catalog_basic_point" => 200,
            "product_category_id" => 16,
            "supplier_id" => 1,
            "operation_id" => "A0000010-1",
            "description_1" => "単行本サイズのケースに、ドライバーやペンチなど基本的な工具をセットしました。本棚や引き出しにも収納できます。",
            "description_2" => "●商品:ケース/約23×17×4.5cm●材質:ポリエチレン樹脂・炭素鋼・ABS樹脂●台湾製",
            "notice" => "※シーズン途中で色・デザイン等が変更になる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "卓上シチリンセット",
            "product_category_id" => 11,
            "supplier_id" => 1,
            "operation_id" => "A0000011-0",
            "description_1" => "断熱構造+遮熱板により熱を通しにくいため、テーブルの上でも使用できます。高さ15cmの薄型ボディで卓上に置いても焼きやすい高さです。軽量で持ち運びらくらく。夏のアウトドアはもちろん、花見や秋の行楽シーズンなど四季を通じて炭火焼きが楽しめます。",
            "description_2" => "●商品:約36.5×21.5×高さ15cm●材質:本体/スチール(焼付塗装)、網/スチール(メッキ)●内容:網・グリルブラシ・ステンレストング付●本体/日本製、網・グリルブラシ/台湾製、トング/中国製",
            "notice" => "※実際の商品と印刷物に色味の差が生じる場合がございます。予めご了承ください。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "卓上シチリンセット",
            "catalog_basic_point" => 200,
            "product_category_id" => 11,
            "variation_parent_id" => 29,
            "variation_name" => "レッド",
            "supplier_id" => 1,
            "operation_id" => "A0000011-1",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "卓上シチリンセット",
            "catalog_basic_point" => 200,
            "product_category_id" => 11,
            "variation_parent_id" => 29,
            "variation_name" => "ホワイト",
            "supplier_id" => 1,
            "operation_id" => "A0000011-2",
        ]);
        DB::table("products")->insert([
            "name" => "卓上シチリンセット",
            "catalog_basic_point" => 200,
            "product_category_id" => 11,
            "variation_parent_id" => 29,
            "variation_name" => "ブルー",
            "supplier_id" => 1,
            "operation_id" => "A0000011-3",
        ]);
        DB::table("products")->insert([
            "name" => "折りたたみキャリー",
            "catalog_basic_point" => 252,
            "product_category_id" => 16,
            "supplier_id" => 1,
            "operation_id" => "A0000012-1",
            "description_1" => "重い荷物を運ぶ時に便利なキャリー。災害時や旅行、アウトドアなどさまざまなシーンで活躍します。使わない時は折りたたんで収納しておけます。",
            "description_2" => "●商品:使用時/約31.5×36×高さ96cm、折りたたみ時/約31.5×11.5×高さ41.5cm(約1.9kg)●材質:スチール(粉体塗装)・EVA・PVC●内容:載荷重40kg・ゴムバンド付●台湾製",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "折りたたみキャリー",
            "product_category_id" => 16,
            "supplier_id" => 1,
            "operation_id" => "A0000013-0",
            "description_1" => "コンパクトで扱いやすい台車。ハンドルを倒すと平台車としても使う事ができます。",
            "description_2" => "●商品:使用時/約39×60×高さ89cm、収納時/約39×89×高さ12.5cm(約3.87kg)●材質:再生ポリプロピレン●内容:耐荷重約100kg・収納カバー付●キャリー/日本製、収納カバー/中国製",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "折りたたみキャリー",
            "catalog_basic_point" => 240,
            "product_category_id" => 16,
            "variation_parent_id" => 34,
            "variation_name" => "ピンク",
            "supplier_id" => 1,
            "operation_id" => "A0000013-1",
        ]);
        DB::table("products")->insert([
            "name" => "フェイス&ノーズケア・シェーバーセット",
            "catalog_basic_point" => 240,
            "product_category_id" => 7,
            "supplier_id" => 1,
            "operation_id" => "A0000014-1",
            "description_1" => "フェイスとボディーをやさしくケアするセット。",
            "description_2" => "●商品:フェイス&ノーズケア(約幅2×奥2.1×長さ14.8cm)●材質:ABS樹脂●内容:アタッチメント(フェイスシェーバー・ノーズケア)●電池:単４乾電池1本使用(別売)●中国製●商品:ボディーシェーバー(約幅2.2×奥2.5×長さ12.5cm)●材質:ABS樹脂●内容:掃除用ブラシ付・回転式●電池:単３乾電池1本使用(別売)●中国製",
            "notice" => "【電池別売】※シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_name" => "コイズミ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "スポットケア",
            "catalog_basic_point" => 280,
            "product_category_id" => 7,
            "supplier_id" => 1,
            "operation_id" => "A0000015-1",
            "description_1" => "3つの機能で魅力的な目元や口元に導きます。",
            "description_2" => "●商品:約幅2.8×奥2.8×長さ13cm●材質:ポリカーボネート・ABS樹脂●機能:振動・保湿ケア・HOT・オートオフ●電池:単4乾電池2本使用(別売)●中国製",
            "notice" => "【電池別売】※ ペースメーカー等の医用電気機器をご使用の方はご利用できません。※電気関連商品は、シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_name" => "コイズミ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "地球儀・月球儀セット(日本語表記)",
            "catalog_basic_point" => 280,
            "product_category_id" => 22,
            "supplier_id" => 1,
            "operation_id" => "A0000016-1",
            "description_1" => "球径15ｃｍの本棚に置けるサイズの人気の地球儀と月球儀のセットです。地球儀の陸地は読みやすさを配慮して国別に色分けされた行政地図です。海洋水深200mの大陸棚を淡い水色で表現しています。月球儀は日本の探査機かぐやのデータを基に作成されています。",
            "description_2" => "●商品:地球儀(約球径15×高さ19.5cm)・月球儀(約球径15×高さ16.5cm)各1●材質:地球儀/(球体)再生紙・(台座)木、月球儀/(球体)再生紙・(台座)プラスチック●内容:地球儀/縮尺約8400万分の1、月球儀/縮尺約2300万分の1●日本製",
            "notice" => "※シーズン途中でデザイン等が変更になる場合がございます。※世界情勢の変化に伴い、最新の国名とは異なる場合がございます。",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "カークリーナー",
            "catalog_basic_point" => 340,
            "product_category_id" => 4,
            "supplier_id" => 1,
            "operation_id" => "A0000017-1",
            "description_1" => "吸引ノズルの角度を調整できるユニークな機能の車専用クリーナー。シガーソケットから電源を供給するので、安定した吸引力が持続します。",
            "description_2" => "●商品:本体/約17×14.5×長さ27cm(約1.28kg)●内容:コードの長さ約5m・サイクロン方式・大型ブラシノズル・蛇腹ホース・アダプター・収納バッグ付●機能:ノズル角度調節●電源:DC12V●中国製",
            "notice" => "※電気関連商品は、シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_name" => "ブラック・アンド・デッカー",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "折りたたみステップ",
            "product_category_id" => 16,
            "supplier_id" => 1,
            "product_category_id" => 7,
            "operation_id" => "A0000018-0",
            "description_1" => "耐荷重約130㎏の丈夫なつくり。折りたたんだ状態で自立するので、収納にも便利です。",
            "description_2" => "●商品:使用時/約37×33×高さ30cm、収納時/約37×16×高さ34cm(約2kg)●材質:アルミ合金・ABS樹脂・PVC樹脂●内容:耐荷重約130kg●中国製またはベトナム製",
            "maker_name" => "長谷川工業",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "折りたたみステップ",
            "catalog_basic_point" => 360,
            "product_category_id" => 16,
            "variation_parent_id" => 40,
            "variation_name" => "シルバー",
            "supplier_id" => 1,
            "operation_id" => "A0000018-1",
            "product_category_id" => 7,
        ]);
        DB::table("products")->insert([
            "name" => "折りたたみステップ",
            "catalog_basic_point" => 360,
            "product_category_id" => 16,
            "variation_parent_id" => 40,
            "variation_name" => "ブラック",
            "supplier_id" => 1,
            "operation_id" => "A0000018-2",
        ]);
        DB::table("products")->insert([
            "name" => "カークリーナー",
            "catalog_basic_point" => 400,
            "product_category_id" => 4,
            "supplier_id" => 1,
            "operation_id" => "A0000019-1",
            "description_1" => "シートの隙間や足元もホースを伸ばしてラクラクお掃除。シガーソケット電源なので、安定した吸引力が続きます。",
            "description_2" => "●商品:本体/約29.5×15×高さ24cm(約1.36kg)●内容:コードの長さ約5m・サイクロン方式・先細ノズル・コンビネーションノズル・収納バッグ付●電源:DC12V●中国製",
            "notice" => "※シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_name" => "ブラック・アンド・デッカー",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "コンフォートベッド",
            "catalog_basic_point" => 400,
            "product_category_id" => 14,
            "supplier_id" => 1,
            "operation_id" => "A0000020-1",
            "description_1" => "広げるだけでスピーディーにセッティングが完了する、組立て不要の収束型。",
            "description_2" => "●商品:使用時/約72×205×高さ34cm、収納時/約30×15×74cm●材質:ポリエステル(PVコーティング)・スチール●内容:耐荷重約100kg・折りたたみ式・収納袋付●中国製",
            "notice" => "※シーズン途中でデザイン等が変更になる場合がございます。※実際の商品と印刷物に色味の差が生じる場合がございます。予めご了承ください。",
            "maker_name" => "ロゴス",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "コーヒーメーカー(5杯用)",
            "product_category_id" => 4,
            "supplier_id" => 1,
            "operation_id" => "A0000021-0",
            "description_1" => "ノアは、メリタゴールドスタンダードを満たしたコーヒーメーカーです。お水とお好みの挽きたてのコーヒーを量ってセットすれば、湯温、湯量、抽出時間をコントロールしてくれます。保温性のあるステンレス製真空二重構造のポットとオートスイッチオフ機能の付いたシンプル設計です。",
            "description_2" => "●商品:本体/約幅26.9×奥15.2×高さ31.1cm・700ml●材質:ステンレス・ポリプロピレン●内容:計量スプーン・ペーパー5枚付・ペーパーフィルター式●機能:アラーム＆オートオフ・しずくもれ防止●電源:AC100V-650W●中国製",
            "notice" => "※シーズン途中で内容・デザイン・生産国が変更になる場合がございます。",
            "maker_name" => "メリタ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "コーヒーメーカー(5杯用)",
            "catalog_basic_point" => 480,
            "product_category_id" => 4,
            "variation_parent_id" => 45,
            "variation_name" => "ホワイト",
            "supplier_id" => 1,
            "operation_id" => "A0000021-1",
        ]);
        DB::table("products")->insert([
            "name" => "コーヒーメーカー(5杯用)",
            "catalog_basic_point" => 480,
            "product_category_id" => 4,
            "variation_parent_id" => 45,
            "variation_name" => "ブラック",
            "supplier_id" => 1,
            "operation_id" => "A0000021-2",
        ]);
        DB::table("products")->insert([
            "name" => "ﾎｲｰﾙ/ﾀｲﾔ用ﾌﾞﾗｼ 500MM",
            "catalog_basic_point" => 28,
            "product_category_id" => 25,
            "supplier_id" => 2,
            "operation_id" => "00593452-1",
            "maker_name" => "JET",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "バケツ石けん　5kg　×2個セット",
            "catalog_basic_point" => 202,
            "product_category_id" => 25,
            "supplier_id" => 2,
            "operation_id" => "E0593465-1",
            "product_category_id" => 7,
            "maker_name" => "イーグルスター",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ｱﾋﾟｶ180匁もんめﾀｵﾙ 300枚 ｶﾗｰｱｿｰﾄ",
            "catalog_basic_point" => 992,
            "product_category_id" => 25,
            "supplier_id" => 2,
            "operation_id" => "E0671021-1",
            "maker_name" => "アピカ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ｱﾋﾟｶ200匁もんめﾀｵﾙ 200枚 ｶﾗｰｱｿｰﾄ",
            "catalog_basic_point" => 826,
            "product_category_id" => 25,
            "supplier_id" => 2,
            "operation_id" => "E0671022-1",
            "maker_name" => "アピカ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "高圧洗浄機 AJP-1620Ａ",
            "catalog_basic_point" => 960,
            "product_category_id" => 25,
            "supplier_id" => 2,
            "operation_id" => "E0672404-1",
            "maker_name" => "京セラインダストリアルツールズ",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ﾅｯﾄｶﾊﾞｰ 51L 41MM ABS 8個入 丸型",
            "catalog_basic_point" => 64,
            "product_category_id" => 24,
            "supplier_id" => 2,
            "operation_id" => "E0500371-1",
            "maker_name" => "JET",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ﾅｯﾄｶﾊﾞｰ 51L 38MM ABS 5個入 丸型",
            "catalog_basic_point" => 40,
            "product_category_id" => 24,
            "supplier_id" => 2,
            "operation_id" => "E0500374-1",
            "maker_name" => "JET",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ﾅｯﾄｶﾊﾞｰ 51L 41MM ABS 8個入 角型",
            "catalog_basic_point" => 72,
            "product_category_id" => 24,
            "supplier_id" => 2,
            "operation_id" => "E0500381-1",
            "maker_name" => "JET",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ﾅｯﾄｶﾊﾞｰ 51L 41MM ABS 6個入 角型",
            "catalog_basic_point" => 56,
            "product_category_id" => 24,
            "supplier_id" => 2,
            "operation_id" => "E0500382-1",
            "maker_name" => "JET",
            "maker_url" => "https://example.com",
        ]);
        DB::table("products")->insert([
            "name" => "ﾅｯﾄｶﾊﾞｰ 60L 41MM ｽﾁｰﾙ 8個入 丸型",
            "catalog_basic_point" => 87,
            "product_category_id" => 24,
            "supplier_id" => 2,
            "operation_id" => "E0500436-1",
            "maker_name" => "JET",
            "maker_url" => "https://example.com",
        ]);
        
        // 景品画像

        DB::table("product_images")->insert([ //1
            "path" => "1-A0000001-1.jpg",
            "product_id" => 15,
        ]);
        DB::table("product_images")->insert([ //2
            "path" => "1-A0000002-1.jpg",
            "product_id" => 16,
        ]);
        DB::table("product_images")->insert([ //3
            "path" => "1-A0000003-1.jpg",
            "product_id" => 17,
        ]);
        DB::table("product_images")->insert([ //4
            "path" => "1-A0000003-2.jpg",
            "product_id" => 17,
        ]);
        DB::table("product_images")->insert([ //5
            "path" => "1-A0000004-1.jpg",
            "product_id" => 20,
        ]);
        DB::table("product_images")->insert([ //6
            "path" => "1-A0000005-1.jpg",
            "product_id" => 21,
        ]);
        DB::table("product_images")->insert([ //7
            "path" => "1-A0000005-2.jpg",
            "product_id" => 21,
        ]);
        DB::table("product_images")->insert([ //8
            "path" => "1-A0000006-1.jpg",
            "product_id" => 24,
        ]);
        DB::table("product_images")->insert([ //9
            "path" => "1-A0000007-1.jpg",
            "product_id" => 25,
        ]);
        DB::table("product_images")->insert([ //10
            "path" => "1-A0000008-1.jpg",
            "product_id" => 26,
        ]);
        DB::table("product_images")->insert([ //11
            "path" => "1-A0000009-1.jpg",
            "product_id" => 27,
        ]);
        DB::table("product_images")->insert([ //12
            "path" => "1-A0000010-1.jpg",
            "product_id" => 28,
        ]);
        DB::table("product_images")->insert([ //13
            "path" => "1-A0000011-1.jpg",
            "product_id" => 29,
        ]);
        DB::table("product_images")->insert([ //14
            "path" => "1-A0000011-2.jpg",
            "product_id" => 29,
        ]);
        DB::table("product_images")->insert([ //15
            "path" => "1-A0000011-3.jpg",
            "product_id" => 29,
        ]);
        DB::table("product_images")->insert([ //16
            "path" => "1-A0000012-1.jpg",
            "product_id" => 33,
        ]);
        DB::table("product_images")->insert([ //17
            "path" => "1-A0000013-1.jpg",
            "product_id" => 34,
        ]);
        DB::table("product_images")->insert([ //18
            "path" => "1-A0000014-1.jpg",
            "product_id" => 36,
        ]);
        DB::table("product_images")->insert([ //19
            "path" => "1-A0000015-1.jpg",
            "product_id" => 37,
        ]);
        DB::table("product_images")->insert([ //20
            "path" => "1-A0000016-1.jpg",
            "product_id" => 38,
        ]);
        DB::table("product_images")->insert([ //21
            "path" => "1-A0000017-1.jpg",
            "product_id" => 39,
        ]);
        DB::table("product_images")->insert([ //22
            "path" => "1-A0000018-1.jpg",
            "product_id" => 40,
        ]);
        DB::table("product_images")->insert([ //23
            "path" => "1-A0000018-2.jpg",
            "product_id" => 40,
        ]);
        DB::table("product_images")->insert([ //24
            "path" => "1-A0000019-1.jpg",
            "product_id" => 43,
        ]);
        DB::table("product_images")->insert([ //25
            "path" => "1-A0000020-1.jpg",
            "product_id" => 44,
        ]);
        DB::table("product_images")->insert([ //26
            "path" => "1-A0000021-1.jpg",
            "product_id" => 45,
        ]);
        DB::table("product_images")->insert([ //27
            "path" => "1-A0000021-2.jpg",
            "product_id" => 45,
        ]);
        DB::table("product_images")->insert([ //28
            "path" => "2-00593452-1.jpg",
            "product_id" => 48,
        ]);
        DB::table("product_images")->insert([ //29
            "path" => "2-E0593465-1.jpg",
            "product_id" => 49,
        ]);
        DB::table("product_images")->insert([ //30
            "path" => "2-E0671021-1.jpg",
            "product_id" => 50,
        ]);
        DB::table("product_images")->insert([ //31
            "path" => "2-E0671022-1.jpg",
            "product_id" => 51,
        ]);
        DB::table("product_images")->insert([ //32
            "path" => "2-E0672404-1.jpg",
            "product_id" => 52,
        ]);
        DB::table("product_images")->insert([ //33
            "path" => "2-E0500371-1.jpg",
            "product_id" => 53,
        ]);
        DB::table("product_images")->insert([ //34
            "path" => "2-E0500374-1.jpg",
            "product_id" => 54,
        ]);
        DB::table("product_images")->insert([ //35
            "path" => "2-E0500381-1.jpg",
            "product_id" => 55,
        ]);
        DB::table("product_images")->insert([ //36
            "path" => "2-E0500382-1.jpg",
            "product_id" => 56,
        ]);
        DB::table("product_images")->insert([ //37
            "path" => "2-E0500436-1.jpg",
            "product_id" => 57,
        ]);
        DB::table("product_images")->insert([ //58
            "path" => "3-A0000001-1.jpg",
            "product_id" => 1,
        ]);
        DB::table("product_images")->insert([ //58
            "path" => "3-A0000001-2.jpg",
            "product_id" => 1,
        ]);
    }
}
