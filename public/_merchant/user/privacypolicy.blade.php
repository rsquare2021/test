@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">プライバシーポリシー</h2>
    <div class="user_wrap">
        <p>{!! html_entity_decode(e($campaign->privacy_policy)) !!}</p>
    </div>

@endsection