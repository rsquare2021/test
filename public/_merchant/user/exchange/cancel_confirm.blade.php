@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">景品交換 取り消し</h2>
    <div class="white mt-3">
        <form action="{{ route('campaign.apply.cancel', [$campaign_id, $apply->id]) }}" method="post" id="order_form">
            @csrf
            <h3 class="text-center mt-3 mb-3 fz_16">景品の確認</h3>
            <attention>以下の取り消し内容をご確認のうえ、よろしければお手続きを確定してください。</attention>
            <table class="blue_table mt-3">
                <tr>
                    <th>景品名</th>
                    <td>
                        <span class="pro_name_disp" name="">{{ $apply->product->name }}</span>
                    </td>
                </tr>
                <tr>
                    <th>数量</th>
                    <td>
                        <span class="pro_amount_disp" name="">{{ $apply->quantity }}</span>
                    </td>
                </tr>
                <tr>
                    <th>種類</th>
                    <td>
                        <span class="pro_valiation_disp" name="">{{ $apply->product->variation_name }}</span>
                    </td>
                </tr>
                <tr>
                    <th>消費ポイント数</th>
                    <td><span class="total_use_point_disp">{{ $apply->getTotalPoint() }}</span>pts</td>
                </tr>
            </table>
            <form action="{{ route('campaign.apply.cancel', [$campaign_id, $apply->id]) }}" method="post">
                @csrf
                <button class="red_btn mt-3 mb-3">取り消しを確定する</button>
            </form>
            <a href="javascript:history.back();" class="gray_btn mb-3">戻る</a>
        </form>
    </div>

@endsection