@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">景品交換 申し込みの完了</h2>
    <div class="user_wrap">
        <p>景品交換のお申し込みを完了しました。<br>お申し込みの内容はメールでも送信しております。<br>景品の発送先変更およびキャンセルは「交換申請日当日のみ」可能です。お手続きは「景品交換履歴」ページでお手続きください。<br><br>引き続きキャンペーンをお楽しみください。</p>
        <div class="mt-3">
            <p><a class="blue_btn" href="{{ route('campaign.dashboard', $campaign_id) }}">ダッシュボードに戻る</a></p>
        </div>
    </div>

@endsection