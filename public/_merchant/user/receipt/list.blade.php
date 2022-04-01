@extends('layouts.user')

@section('content')

    <h2 class="mypage_tit">レシート送信履歴</h2>
    <div class="user_wrap">
        <div class="product_search mt-3 mb-4">
            <dl>
                <dt>ステータス</dt>
                <dd>
                    <ul class="ex_status">
                        <li><a data-status="0">全て</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
        @forelse ($receipts as $receipt)
            <div class="re_list mb-3">
                <table>
                    <tr>
                        <th>レシート送信ID</th>
                        <td>{{ $receipt->id }}</td>
                    </tr>
                    <tr>
                        <th>レシート送信日時</th>
                        <td>{{ $receipt->created_at }}</td>
                    </tr>
                    <tr>
                        <th>ステータス</th>
                        <td class="status_value">
                            @if($receipt->status == 0)
                                @php
                                    if($receipt->updated_at < $now) {
                                        echo 'ポイント付与済み';
                                    } else {
                                        echo '確認中';
                                    }
                                @endphp
                            @elseif($receipt->status == 90)
                                @php
                                    if($receipt->updated_at < $now) {
                                        echo 'ポイント付与済み';
                                    } else {
                                        echo '確認中';
                                    }
                                @endphp
                            @elseif($receipt->status == 95)
                                @php
                                    if($receipt->updated_at < $now) {
                                        echo 'ポイント付与済み';
                                    } else {
                                        echo '確認中';
                                    }
                                @endphp
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
                            @else
                                確認中
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>レシート発行日時</th>
                        <td>{{ $receipt->pay_date }}</td>
                    </tr>
                    <tr>
                        <th>ポイント数</th>
                        <td>{{ $receipt->point }}</td>
                    </tr>
                </table>
            </div>
        @empty
            <p class="mt-5 mb-3 text-center">レシートがありません</p>
        @endforelse
    </div>

@endsection