@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">景品交換 取り消しの完了</h2>
    <div class="user_wrap">
        <p>景品交換の取り消しを完了しました。<br>引き続きキャンペーンをお楽しみください。</p>
        <div class="mt-3">
            <p><a class="blue_btn" href="{{ route('campaign.dashboard', $campaign->id) }}">ダッシュボードに戻る</a></p>
        </div>
    </div>

@endsection