@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>応募者</th>
                                            <th>送信日時</th>
                                            <th>発行日</th>
                                            <th>発行時間</th>
                                            <th>店舗名</th>
                                            <th>数量</th>
                                            <th>ポイント</th>
                                            <th>読み取り</th>
                                            <th>ステータス</th>
                                            <th>確認</th>
                                        </tr>
                                    </thead>

                                    <tbody class="receipt_body">
                                        @foreach($receipts as $receipt)
                                            <tr id="{{ $receipt->receipt_id }}" data-userid="{{ $receipt->user_id }}">
                                                <td><a class="mb-2 re_img_get" data-receipt_path="{{ $receipt->receipt_path }}" data-toggle="modal" data-target="#editModal">{{ $receipt->receipt_id }}</a></td>
                                                <td>{{ $receipt->user_id }}</td>
                                                <td>
                                                    @php
                                                        $date = $receipt->created_at;
                                                        echo date('Y年m月d日 H時i分',  strtotime($date));
                                                    @endphp
                                                </td>
                                                <td class="re_date">
                                                    {{ $receipt->mk_date }}
                                                </td>
                                                <td class="re_time">{{ $receipt->mk_time }}</td>
                                                <td>
                                                    @if($receipt->tel_company)
                                                        {{ $receipt->tel_company }}
                                                    @else
                                                        {{ $receipt->company }}
                                                    @endif
                                                </td>
                                                <td class="re_value">
                                                    @if($receipt->mk_value == NULL || $receipt->mk_value == '')
                                                        {{ $receipt->receipt_value }}
                                                    @else
                                                        {{ $receipt->mk_value }}
                                                    @endif
                                                </td>
                                                <td class="re_point">{{ $receipt->point }}</td>
                                                <td>
                                                    @foreach($target_receipt_statuses as $target_receipt_status)
                                                        @if($receipt->$target_receipt_status == 1)
                                                            @foreach($receipt_statuses as $receipt_status)
                                                                @if($receipt_status->key == $target_receipt_status)
                                                                    {{ $receipt_status->value1 }}
                                                                @endif
                                                            @endforeach
                                                        @elseif($receipt->$target_receipt_status == 2)
                                                            @foreach($receipt_statuses as $receipt_status)
                                                                @if($receipt_status->key == $target_receipt_status)
                                                                    {{ $receipt_status->value1 }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="status">{{ $receipt->normal_display_name }}</td>
                                                <td><a href="/admin/re/{{ $receipt->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="pager">
                                    {{$receipts->appends(request()->query())->links()}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

<!-- モーダル -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">レシート画像</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="re_body">
                    <img src="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

















































































