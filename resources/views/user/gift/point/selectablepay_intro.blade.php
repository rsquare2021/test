@extends('layouts.user')

@section('content')
<section class="giftee_intro">
    <div class="hero pc"><img src="/assets/img/gifteebox-hero-sp.jpg" alt=""></div>
    <div class="hero sp"><img src="/assets/img/gifteebox-hero-sp.jpg" alt=""></div>

    <h1>えらべるPayなら、好きな商品を選べます</h2>
    <p class="intro">えらべるPayは、ポイントやPay系の商品を自由に選べるギフトです。ポイント内であれば複数のギフトと自由に交換することができます。<br>えらべるPayの利用に専用アプリのダウンロードや会員登録は必要ありません。<br>このページでは、交換できるギフト商品の一部をご紹介します。ぜひご活用ください。</p>
    <div class="caution">
        <p><em>giftee Boxはスマートフォン（iOS/Android）での利用を基本としています。パソコン、フィーチャーフォンでは一部ご利用いただけないギフトがあります。</em></p>
    </div>
    <div class="notes mb-5">
        <p class="">注意事項</p>
        <ul>
            <li>※giftee Boxでは、保有しているポイント数を上限に交換可能な商品が選べる仕組みになっております。実際には、このリストよりも多くの魅力的な商品を選ぶことができます。</li>
            <li>※時期によって、交換レートや商品内容が変更になる場合がございますので、予めご了承ください。</li>
            <li>※商品によって、交換レートが異なります。</li>
            <li>※ギフトポイントの単価によって交換商品は異なります。</li>
            <li>※店頭で引き換える商品など、スマートフォンで利用する商品が多く含まれております。パソコンでは一部ご利用いただけないギフトがありますので、ご注意ください。</li>
            <li>※交換する商品ごとの注意事項が、giftee Boxのギフトポイントから商品へ交換するページの下部に記載されています。内容をご確認の上、交換ください。</li>
        </ul>
    </div>
</section>
<section class="giftee_lineup">
    <h2 class="">えらべるPay<br>ギフト商品の一部をご紹介<br>※2022年3月21日現在</h2>
    <div class="gift_list">
        <h3>40ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-quo.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 200円分</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 200円分</td>
                </tr>
                <tr>
                    <th>クオ・カード ペイ</th>
                    <td>クオ・カード ペイ 200円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (200円分)</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>200 Pontaポイント</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>100ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-quo.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-famipay.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 500円分</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 500円分</td>
                </tr>
                <tr>
                    <th>クオ・カード ペイ</th>
                    <td>クオ・カード ペイ 500円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (500円分)</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>500 Pontaポイント</td>
                </tr>
                <tr>
                    <th>FamiPay</th>
                    <td>FamiPay ギフト（500円分）</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>200ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-quo.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-nanaco.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-t-money.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-famipay.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 1,000円分</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 1,000円分</td>
                </tr>
                <tr>
                    <th>クオ・カード ペイ</th>
                    <td>クオ・カード ペイ 1,000円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (1,000円分)</td>
                </tr>
                <tr>
                    <th>nanacoポイント</th>
                    <td>nanaco 500ポイント</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>1,000 Pontaポイント</td>
                </tr>
                <tr>
                    <th>T-MONEY</th>
                    <td>Tマネー 500円</td>
                </tr>
                <tr>
                    <th>FamiPay</th>
                    <td>FamiPay ギフト（1,000円分）</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>400ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-nanaco.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-t-money.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 2,000円分</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 2,000円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (2,000円分)</td>
                </tr>
                <tr>
                    <th>nanacoポイント</th>
                    <td>nanaco 1,000ポイント</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>2,000 Pontaポイント</td>
                </tr>
                <tr>
                    <th>T-MONEY</th>
                    <td>Tマネー 1,000円</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>600ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-quo.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-nanaco.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-t-money.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 3,000円分</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 3,000円分</td>
                </tr>
                <tr>
                    <th>クオ・カード ペイ</th>
                    <td>クオ・カード ペイ 3,000円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (3,000円分)</td>
                </tr>
                <tr>
                    <th>nanacoポイント</th>
                    <td>nanaco 2,000ポイント</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>3,000 Pontaポイント</td>
                </tr>
                <tr>
                    <th>T-MONEY</th>
                    <td>Tマネー 2,000円</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>1400ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-rakuten.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-quo.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-nanaco.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-t-money.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 5,000円分</td>
                </tr>
                <tr>
                    <th>楽天ポイント</th>
                    <td>楽天ポイント 3,000ポイント</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 5,000円分</td>
                </tr>
                <tr>
                    <th>クオ・カード ペイ</th>
                    <td>クオ・カード ペイ 5,000円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (5,000円分)</td>
                </tr>
                <tr>
                    <th>nanacoポイント</th>
                    <td>nanaco 3,000ポイント</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>5,000 Pontaポイント</td>
                </tr>
                <tr>
                    <th>T-MONEY</th>
                    <td>Tマネー 3,000円</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>2000ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-rakuten.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-quo.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-paypay.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-nanaco.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-ponta.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-t-money.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 10,000円分</td>
                </tr>
                <tr>
                    <th>楽天ポイント</th>
                    <td>楽天ポイント 5,000ポイント</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 10,000円分</td>
                </tr>
                <tr>
                    <th>クオ・カード ペイ</th>
                    <td>クオ・カード ペイ 10,000円分</td>
                </tr>
                <tr>
                    <th>PayPay</th>
                    <td>PayPayポイント (10,000円分)</td>
                </tr>
                <tr>
                    <th>nanacoポイント</th>
                    <td>nanaco 5,000ポイント</td>
                </tr>
                <tr>
                    <th>Pontaポイント</th>
                    <td>10,000 Pontaポイント</td>
                </tr>
                <tr>
                    <th>T-MONEY</th>
                    <td>Tマネー 5,000円</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>4000ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-rakuten.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-nanaco.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-t-money.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 20,000円分</td>
                </tr>
                <tr>
                    <th>楽天ポイント</th>
                    <td>楽天ポイント 10,000ポイント</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 20,000円分</td>
                </tr>
                <tr>
                    <th>nanacoポイント</th>
                    <td>nanaco 10,000ポイント</td>
                </tr>
                <tr>
                    <th>T-MONEY</th>
                    <td>Tマネー 10,000円</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="gift_list">
        <h3>6000ポイントの交換の一例</h3>
        <ul>
            <li><img src="/assets/img/selectablepay-jcb.jpg" alt=""></li>
            <li><img src="/assets/img/selectablepay-amazon.jpg" alt=""></li>
        </ul>
        <table >
            <tbody>
                <tr>
                    <th>JCB PREMO</th>
                    <td>ギフティプレモPlus 30,000円分</td>
                </tr>
                <tr>
                    <th>Amazon.co.jp</th>
                    <td>Amazonギフト券 30,000円分</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="notes mb-5">
        <ul>
            <li>※「QUOカードPay」もしくは「クオ・カード ペイ」およびそれらのロゴは(株)クオカードの登録商標です。</li>
            <li>※ギフティプレモPlusは、コンビニやドラッグストアをはじめとした全国のSmart Code™加盟店およびJCB PREMO加盟店（オンラインショッピング・ウェブサイト）で利用できるデジタルギフトです。</li>
            <li>※本キャンペーンは株式会社ENEOSウイングによる提供です。本キャンペーンについてのお問い合わせはAmazonではお受けしておりません。株式会社ENEOSウイング 2022年度 乗務員様 謝恩祭 コンタクトセンター（フリーダイヤル 0120-737-105）までお願いいたします。</li>
            <li>※Amazon、Amazon.co.jp およびそれらのロゴはAmazon.com, Inc.またはその関連会社の商標です。</li>
            <li>※PayPayポイントは出金、譲渡不可です。</li>
            <li>※PayPayはPayPay公式ストアでも利用可能です。</li>
            <li>※「nanaco」は株式会社セブン・カードサービスの登録商標です。</li>
        </ul>
    </div>
</section>

@endsection