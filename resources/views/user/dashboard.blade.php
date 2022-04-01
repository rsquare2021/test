@extends('layouts.user')

@section('content')
    <h2 class="mypage_tit">ダッシュボード</h2>
        <div class="user_wrap">
            <div class="campaign_date mt-4 mb-4">
                <p class=" blue"><span>実施期間：{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y-m-d") }}〜{{ $campaign->end_datetime_to_convert_receipts_to_points->format("Y-m-d") }}</span></p>
                <p>キャンペーン終了まで残り {{ $campaign->getDayCountToCloseReceipt() }}日</p>
            </div>
            <div class="counter">
                <h3>保有ポイント数</h3>
                <!-- <div class="obi"><span><point class="get_point">2</point> ポイントゲット！</span></div> -->
                <count class="now_point">{{ $point->remaining_point }}</count>
                <div class="total_point">（累計ポイント数：<span>{{ $point->total_point }}</span>）</div>
            </div>
            <div class="counter">
                <h3>送信レシート数<span class="red">（否認数）</span></h3>
                <count class="stay_receipt">{{ $stay_receipt_count }} <span class="reject_receipt"><a href="{{ route('campaign.receipt.index', $campaign->id) }}?select_re_status=3">({{$reject}})</a></span></count>
                <div class="detail_link"><a href="{{ route('campaign.receipt.index', $campaign->id) }}">送信履歴 ></a></div>
            </div>
            <div class="counter">
                <h3>景品交換回数</h3>
                <count class="total_exchange">{{ $exchange_count }}</count>
                <div class="detail_link"><a href="{{ route('campaign.apply.index', $campaign->id) }}">交換履歴 ></a></div>
            </div>
            @if(isset( $user_setmail ))
            @else
                <div class="white mail_alert">
                    <p class="blue_text alert_blue mt-2">お客様はまだメールアドレスをご登録いただいておりません。景品の交換などのお手続きの際はメールアドレスのご登録が必要です。</p>
                    <a href="/{{ $campaign->id }}/mail/change" class="basic_login blue_btn mt-1 mb-2">メールアドレスの登録</a>
                </div>
            @endif
            <a href="{{ route('campaign.receipt.snap', [$campaign->id,$user->id]) }}" class="camera_link mt-3"><i class="fas fa-camera"></i>レシート撮影</a>
            <div class="caution">
                <p>レシート撮影は2022年4月1日からご利用いただけます。</p>
            </div>
            <a href="{{ route('campaign.catalog.gift.index', $campaign->id) }}" class="product_list_link mt-3">景品一覧</a>
        </div>

@endsection