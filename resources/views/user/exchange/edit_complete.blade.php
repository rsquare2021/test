@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">景品交換履歴 発送先変更の完了</h2>
    <div class="user_wrap">
        <p>景品の発送先変更が完了しました。<br>引き続きキャンペーンをお楽しみください。</p>
        <div class="mt-3">
            <p><a class="blue_btn" href="{{ route('campaign.dashboard', $campaign->id) }}">ダッシュボードに戻る</a></p>
        </div>
    </div>

@endsection