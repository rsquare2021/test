@extends('layouts.merchant')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <input type="hidden" value="{{ $meken_id }}" id="mk_id">
                    <input type="hidden" value="{{ $kengen }}" id="kengen">
                    <input type="hidden" value="{{ $company_id }}" id="company_id">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <p>作業数：{{ $receipt_count }}件</p>
                            <form action="{{ route('merchant.meken.work') }}" method="get" id="re_select">
                                <div class="flex">
                                    <div class="bloc">
                                        目検日<input class="form-control datepicker" type="text" name="start_date" value="{{ $start_date }}">〜<input class="form-control datepicker" type="text" name="end_date" value="{{ $end_date }}">
                                    </div>
                                </div>
                                @if($kengen == 1)
                                    <dl class="mb-0 mt-3">
                                        <dt>目検担当者</dt>
                                        <dd>
                                            @foreach($tantous as $tantou)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="mk_user{{ $tantou->id }}" name="mk_user[]" value="{{ $tantou->serial }}" 
                                                        @foreach($mk_users as $mk_user)
                                                            @if($mk_user == $tantou->serial)
                                                                checked
                                                            @endif
                                                        @endforeach
                                                    >
                                                    <label class="custom-control-label 
                                                        @foreach($mk_users as $mk_user)
                                                            @if($mk_user == $tantou->serial)
                                                                active
                                                            @endif
                                                        @endforeach
                                                    " for="mk_user{{ $tantou->id }}">{{ $tantou->name }}</label>
                                                </div>
                                            @endforeach
                                        </dd>
                                    </dl>
                                @endif
                                <dl class="mb-0 mt-3">
                                    <dt>目検ステータス</dt>
                                    <dd>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="to_accept" name="to_accept" value="1" @if($to_accept == 1) checked @endif>
                                            <label class="custom-control-label @if($to_accept == 1) active @endif" for="to_accept">仮承認</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="to_reject" name="to_reject" value="1" @if($to_reject == 1) checked @endif>
                                            <label class="custom-control-label @if($to_reject == 1) active @endif" for="to_reject">仮否認</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="to_nojudge" name="to_nojudge" value="1" @if($to_nojudge == 1) checked @endif>
                                            <label class="custom-control-label @if($to_nojudge == 1) active @endif" for="to_nojudge">判断不可</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="to_illegal" name="to_illegal" value="1" @if($to_illegal == 1) checked @endif>
                                            <label class="custom-control-label @if($to_illegal == 1) active @endif" for="to_illegal">不正疑い</label>
                                        </div>
                                    </dd>
                                </dl>
                                <input type="submit" name="meken_select_btn" class="btn btn-primary meken_select_btn" value="検索">
                                <input type="submit" name="meken_select_btn" class="btn btn-primary meken_select_btn" value="全件表示">
                                <a class="btn btn-warning select_reset_btn">リセット</a>
                            </form>
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>応募者</th>
                                            <th>送信日時</th>
                                            <th>発行日</th>
                                            <th>発行時間</th>
                                            <th>数量</th>
                                            <th>ステータス</th>
                                            <th>目検ステータス</th>
                                            <th>作業日時</th>
                                            <th>検査者</th>
                                        </tr>
                                    </thead>

                                    <tbody class="receipt_body">
                                        @foreach($receipts as $receipt)
                                            <tr id="{{ $receipt->id }}" data-userid="{{ $receipt->user_id }}">
                                                <td><a class="mb-2 re_confirm_btn re_img_get" data-toggle="modal" data-target="#editModal" data-receipt_path="{{ $receipt->receipt_path }}">{{ $receipt->receipt_id }}</a></td>
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
                                                <td class="re_value">
                                                    @if($receipt->total_price == NULL || $receipt->total_price == '')
                                                        {{ $receipt->mk_value }}
                                                    @else
                                                        {{ $receipt->total_price }}
                                                    @endif
                                                </td>
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
                                                                    {{ $receipt_status->value2 }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $receipt->normal_display_name }}</td>
                                                <td>
                                                    {{ $receipt->meken_at }}
                                                </td>
                                                <td>
                                                    {{ $receipt->name }}
                                                </td>
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

















































































