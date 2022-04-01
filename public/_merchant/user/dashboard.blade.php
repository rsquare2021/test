@extends('layouts.user')

@section('content')
    <h2 class="mypage_tit">ダッシュボード</h2>
        <div class="user_wrap">
            <div class="campaign_date mt-4 mb-4">
                <p class=" blue"><span>実施期間：{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y-m-d") }}〜{{ $campaign->end_datetime_to_convert_receipts_to_points->format("Y-m-d") }}</span></p>
                <p>キャンペーン終了まで残り {{ $campaign->getDayCountToCloseReceipt() }}日</p>
            </div>
            <div class="white">
                <h3>保有ポイント数</h3>
                <!-- <div class="obi"><span><point class="get_point">2</point> ポイントゲット！</span></div> -->
                <count class="now_point">{{ $point->remaining_point }}</count>
                <div class="total_point">（累計ポイント数：<span>{{ $point->total_point }}</span>）</div>
            </div>
            <div class="flex around mt-3 mb-3">
                <div class="white">
                    <h3>累計交換回数</h3>
                    <count class="total_exchange">{{ $exchange_count }}</count>
                    <a href="{{ route('campaign.apply.index', $campaign->id) }}">交換履歴 ></a>
                </div>
                <div class="white">
                    <h3>承認待ちレシート数（否認：{{$reject}}）</h3>
                    <count class="stay_receipt">{{ $stay_receipt_count }}</count>
                    <a href="{{ route('campaign.receipt.index', $campaign->id) }}">送信履歴 ></a>
                </div>
            </div>
            <div class="news mt-4">
                <h3 class="color_blue text-center fz_16 bold">お知らせ</h3>
                <dl>
                    <dt>2023/04/01</dt>
                    <dd>レシートの読み取りは終了しました。景品の交換期限は4月30日 18:00までです。</dd>
                </dl>
                <dl>
                    <dt>2022/05/01</dt>
                    <dd>2022年6月20日 0:00〜4:00は定期メンテナンスのため、ご利用いただけません。</dd>
                </dl>
                <dl>
                    <dt>2022/06/10</dt>
                    <dd>「ドリップオン・レギュラーコーヒーギフト」を景品に追加しました。</dd>
                </dl>
            </div>
            @if(isset( $user_setmail ))
            @else
                <div class="white mail_alert">
                    <p class="blue_text alert_blue mt-2">お客様はまだメールアドレスをご登録いただいておりません。景品の交換などのお手続きの際はメールアドレスのご登録が必要です。</p>
                    <a href="/{{ $campaign->id }}/mail/change" class="basic_login blue_btn mt-1 mb-2">メールアドレスの登録</a>
                </div>
            @endif
            <a href="{{ route('campaign.receipt.snap', [$campaign->id,$user->id]) }}" class="camera_link mt-3"><i class="fas fa-camera"></i>レシート撮影</a>
            <a href="{{ route('campaign.catalog.gift.index', $campaign->id) }}" class="product_list_link mt-3">景品一覧</a>
        </div>

@endsection