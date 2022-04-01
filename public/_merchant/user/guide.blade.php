@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">当サイトのご利用にあたって</h2>
    <div class="user_wrap">
        <p>{!! html_entity_decode(e($campaign->application_requirements)) !!}</p>
    </div>

@endsection