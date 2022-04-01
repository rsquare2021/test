@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">よくある質問</h2>
    <div class="user_wrap">
        <!--
        <section class="faq_section">
            <h3>キャンペーン</h3>
            <dl>
                <dt>キャンペーンについての問い合わせ先を教えてください。</dt>
                <dd></dd>
            </dl>
        </section>
        -->
        <section class="faq_section">
            <h3>アカウント登録、アカウント情報変更</h3>
            <dl>
                <dt>確認用URLのメールが受信できません。</dt>
                <dd>ご利用の携帯電話会社によってはメールの受信拒否設定が有効になっている可能性があります。<br>「next-cp.com」からのメールを許可してから再度サインインすると確認用URLを再送信できます。</dd>
            </dl>
        </section>
        <section class="faq_section">
            <h3>レシート読み取り、ポイント付与</h3>
            <dl>
                <dt>レシートの読み取りがうまくできません。</dt>
                <dd>レシートは丸まらないようにしっかりと伸ばし、レシートに対して並行に、真上から撮影してください。<br>
                その他にもいくつか注意点がございますので、レシート読み取りの注意点のページをご確認ください。</dd>
            </dl>
        </section>
        <section class="faq_section">
            <h3>ポイント交換・景品</h3>
            <dl>
                <dt>景品交換の発送先の変更やキャンセルはできますか？</dt>
                <dd>景品交換履歴の中から発送先の変更やキャンセルをしたい景品の [発送先の変更]、[キャンセル] でできます。<br>
                なお、発送先の変更とキャンセルは交換申し込みの「当日のみ」可能です。以降はいたしかねますのでご了承ください。</dd>
            </dl>
        </section>
    </div>

@endsection