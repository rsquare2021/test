<div class="subject_receipt">
    <h3>対象のレシート</h3>
    <dl class="outline">
        <dt>有効レシート発行日時</dt>
        <dd>{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}〜{{ $campaign->end_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}<br>
        <span class="red">※レシート発行日から20日以内のものに限る</span></dd>
        <dt>ポイント付与条件</dt>
        <dd>軽油25Lにつき1ポイント</dd>
        <dt>対象店舗</dt>
        <dd>株式会社ENEOSウイングの直営店および特約店<br>※一部の特約店を除く。</dd>
    </dl>
</div>

<div class="snap_example">
    <h3 class="text-left"><i class="fas fa-exclamation-triangle"></i>レシート読み取りの注意点</h3>
    <h3 class="mt-3 text-left">○ 良い例</h3>
    <div>
        <img src="/assets/img/snap-example-ok.jpg" class="mb-3 w100">
        <p>以下の条件をすべて満たしてください。</p>
        <ul class="mb-3 text-left">
            <li>しわ、破れ、汚れ、丸まり、影などがない</li>
            <li>手書きの文字がない</li>
            <li>手で持たず、暗い色の物の上にレシートを置く</li>
            <li><em>真上から</em>レシート全体を写す</li>
        </ul>
    </div>
</div>

<div class="snap_example">
    <h3 class="mt-3 text-left">× 悪い例</h3>
    <div>
        <p class="title">真上から撮影していない。</p>
        <img src="/assets/img/snap-example-ng-1.jpg" class="mb-3 w100">
        <p class="title">レシートが上下や左右に丸まっている。</p>
        <img src="/assets/img/snap-example-ng-2.jpg" class="mb-3 w100">
        <p class="title">その他</p>
        <p>以下の条件に1つでも当てはまるとエラーになります。</p>
        <img src="/assets/img/snap-example-ng-3.jpg" class="mb-3 w100">
        <ul class="mb-3 text-left">
            <li>しわ、破れ、汚れ、丸まり、影がある</li>
            <li>手書きの文字が書かれている</li>
            <li>レシート以外の不要な文字が写っている</li>
            <li>レシートが著しく傾いている、歪んでいる、または一部が写っていない</li>
        </ul>
    </div>
</div>

<div class="caution mt-4">
    <p class="title"><i class="fas fa-exclamation-triangle mr-1"></i>注意事項</p>
    <p>レシートの複製、数字の偽装などの悪質な不正があった場合はアカウント削除などの措置を取らせていただきますのでご了承ください。</p>
</div>