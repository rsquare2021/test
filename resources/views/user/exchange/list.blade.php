@extends('layouts.user')

@section('content')

    <h2 class="mypage_tit">景品交換履歴</h2>
        <div class="user_wrap">
            <div class="product_search mt-3 mb-4">
                <div class="cp_ipselect cp_sl04">
                    <select class="select_ex_status">
                        <option value="0">全て</option>
                        <option value="13">景品確認中・申込済</option>
                        <option value="41">発行済み</option>
                        <option value="31">発送済み</option>
                        <option value="21">キャンセル</option>
                    </select>
                </div>
            </div>
            @forelse ($applies as $apply)
                <div class="mb-4 ex_lists status{{ $apply->status->id }}">
                    <table>
                        <tr>
                            <th>交換ID</th>
                            <td>{{ $apply->id }}</td>
                        </tr>
                        <tr>
                            <th>交換申請日時</th>
                            <td>{{ $apply->created_at }}</td>
                        </tr>
                        <tr>
                            <th>ステータス</th>
                            <td>
                                @if($apply->status->name == "宛先入力待ち")
                                    @php
                                        $create = $apply->created_at;
                                        $create = $create->format('Ymd');
                                        if($create < $now) {
                                            echo '景品確認中';
                                        } else {
                                            echo '申込済';
                                        }
                                    @endphp
                                @else
                                    {{ $apply->status->name }}
                                @endif    
                            </td>
                        </tr>
                        <tr>
                            <th>景品名</th>
                            <td>{{ $apply->product->name }}</td>
                        </tr>
                        <tr>
                        @if (!$apply->product->isGifteeBox())
                            <th>数量</th>
                            <td>{{ $apply->quantity }}</td>
                        @else
                            <th>金額</th>
                            <td>{{ $apply->campaign_product->getGifteeBoxPrice($apply->quantity) }} <span>円分</span></td>
                        @endif
                        </tr>
                        <tr>
                            <th>消費ポイント</th>
                            <td>{{ $apply->getTotalPoint() }} pts</td>
                        </tr>
                        <tr>
                        @if (!$apply->product->isGifteeBox())
                            <th>発送先</th>
                            <td>
                                @php
                                    $ad = $apply->shipping_address;
                                @endphp
                                @if ($ad)
                                    {{ $ad->getName() }}<br>
                                    {{ $ad->post_code }}<br>
                                    {{ $ad->prefectures . $ad->municipalities . $ad->address_code . $ad->building }}<br>
                                    {{ $ad->tel }}
                                @else
                                @endif
                                @if ($apply->canEditAddress())
                                    @php
                                        $create = $apply->created_at;
                                        $create = $create->format('Ymd');
                                        if($create == $now) { @endphp
                                            <div class="w100 text-right">
                                                <a href="{{ route('campaign.apply.address.edit', [$campaign_id, $apply->id]) }}" class="back blue_btn">発送先の変更</a>
                                            </div>
                                    @php } @endphp
                                @endif
                            </td>
                        @else
                            <th>URL</th>
                            <td><a href="{{ $apply->giftee_box_url }}" target="_blank" rel="noopener">{{ $apply->giftee_box_url }}</a></td>
                        @endif
                        </tr>
                    </table>
                    @if ($apply->canCancel())
                        @php
                            $create = $apply->created_at;
                            $create = $create->format('Ymd');
                            if($create == $now) { @endphp
                                <div class="d-sm-flex justify-content-between mt-3 mb-2">
                                    <div class="field-wrapper flex_btns">
                                        <a href="{{ route('campaign.apply.cancel.confirm', [$campaign_id, $apply->id]) }}" class="back red_btn">交換のキャンセル</a>
                                    </div>
                                </div>
                        @php } @endphp
                    @endif
                </div>
            @empty
                <p class="mt-5 mb-3 text-center">履歴交換がありません</p>
            @endforelse
        </div>
    <p class="attention red">※ステータスが確認中の場合のみ発送先の変更、交換のキャンセルができます。</p>

@endsection