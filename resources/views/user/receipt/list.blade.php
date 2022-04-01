@extends('layouts.user')

@section('content')

    <h2 class="mypage_tit">レシート送信履歴</h2>
    <div class="user_wrap">
        <div class="re_search mt-3 mb-4">
            <div class="w100">
                <form action="{{ route('campaign.receipt.index', $campaign->id) }}" method="get">
                    <div class="cp_ipselect cp_sl04">
                        <select name="select_re_status" class="select_re_status">
                            <option value="0">全て</option>
                            <option value="1">ポイント付与済み</option>
                            <option value="2">確認中</option>
                            <option value="3">否認</option>
                        </select>
                    </div>
                    <div class="cp_ipselect">
                        <div class="left">
                            <input type="text" value="" name="start_date" class="datepicker" placeholder="開始日">
                        </div>
                        <div class="right">
                            <input type="text" value="" name="end_date" class="datepicker" placeholder="終了日">
                        </div>
                    </div>
                    <input type="submit" class="blue_btn" value="検索">
                </form>
            </div>
        </div>
        @if($search_word !== '')
            {{ $search_word }}
        @endif
        <p></p>
        @forelse ($receipts as $receipt)
            <div class="re_list mb-3">
                <table>
                    <tr>
                        <th>レシート送信ID</th>
                        <td>{{ $receipt->id }}</td>
                    </tr>
                    <tr>
                        <th>レシート送信日時</th>
                        <td>
                            @php
                                $send_date = $receipt->created_at;
                                echo date('Y年m月d日 H:i:s',  strtotime($send_date));
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th>レシート発行日</th>
                        <td>
                            @php
                                $create_date = $receipt->pay_date;
                                echo date('Y年m月d日',  strtotime($create_date));
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th>数量</th>
                        <td>
                            @if($receipt->mk_value == null || $receipt->mk_value == '')
                                {{ $receipt->receipt_value }} L
                            @else
                                {{ $receipt->mk_value }} L
                            @endif 
                        </td>
                    </tr>
                    <tr>
                        <th>店舗名</th>
                        <td>
                            {{ $receipt->tel_company }}
                        </td>
                    </tr>
                    <tr>
                        <th>ステータス</th>
                        <td class="status_value">
                            @if($receipt->status == 0)
                                確認中
                            @elseif($receipt->status == 90)
                                確認中
                            @elseif($receipt->status == 95)
                                確認中
                            @elseif($receipt->status == 91)
                                否認
                            @elseif($receipt->status == 92)
                                否認
                            @elseif($receipt->status == 96)
                                否認
                            @elseif($receipt->status == 97)
                                否認
                            @elseif($receipt->status == 98)
                                否認
                            @elseif($receipt->status == 99)
                                否認
                            @elseif($receipt->status == 100)
                                ポイント付与済み
                            @else
                                確認中
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        @empty
            <p class="mt-5 mb-3 text-center">レシートがありません</p>
        @endforelse
    </div>

@endsection