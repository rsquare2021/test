@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <form action="{{ route('admin.receipt.list') }}" class="select_form mb-5" method="get" id="re_select">
                                <p>「{{ $re_select_rule }}」</p>
                                <div class="flex">
                                    <div class="bloc">
                                        <p>応募者ID</p>
                                        <input class="form-control" type="text" name="order_id" value="{{ $order_id }}">
                                    </div>
                                    <div class="bloc">
                                        <p>レシートID</p>
                                        <input class="form-control" type="text" name="re_id" value="{{ $re_id }}">
                                    </div>
                                    <div class="bloc">
                                        <p>レシート発行日時</p>
                                        <input class="form-control datepicker" type="text" name="start_date" value="{{ $start_date }}">〜<input class="form-control datepicker" type="text" name="end_date" value="{{ $end_date }}">
                                    </div>
                                    <div class="bloc">
                                        <p>数量</p>
                                        <input class="form-control" type="text" name="min_value" value="{{ $min_value }}">〜<input class="form-control" type="text" name="max_value" value="{{ $max_value }}">
                                    </div>
                                </div>
                                <dl class="mb-4 mt-4">
                                    <dt>読み取りステータス</dt>
                                    <dd>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status_duplicate" name="status_duplicate" value="1" @if($status_duplicate != '') checked @endif>
                                            <label class="custom-control-label @if($status_duplicate != '') active @endif" for="status_duplicate">重複</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status_ng1" name="status_ng1" value="1" @if($status_ng1 != '') checked @endif>
                                            <label class="custom-control-label @if($status_ng1 != '') active @endif" for="status_ng1">NGワード1</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status_ng2" name="status_ng2" value="1" @if($status_ng2 != '') checked @endif>
                                            <label class="custom-control-label @if($status_ng2 != '') active @endif" for="status_ng2">Ngワード2</label>
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="mb-4">
                                    <dt>目検ステータス</dt>
                                    <dd>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_none" name="meken_none" value="1" @if($meken_none != '') checked @endif>
                                            <label class="custom-control-label @if($meken_none != '') active @endif" for="meken_none">目検なし</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_now" name="meken_now" value="1" @if($meken_now != '') checked @endif>
                                            <label class="custom-control-label @if($meken_now != '') active @endif" for="meken_now">確認中</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_ok" name="meken_ok" value="1" @if($meken_ok != '') checked @endif>
                                            <label class="custom-control-label @if($meken_ok != '') active @endif" for="meken_ok">承認</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_ng" name="meken_ng" value="1" @if($meken_ng != '') checked @endif>
                                            <label class="custom-control-label @if($meken_ng != '') active @endif" for="meken_ng">否認</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_danger" name="meken_danger" value="1" @if($meken_danger != '') checked @endif>
                                            <label class="custom-control-label @if($meken_danger != '') active @endif" for="meken_danger">不正</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_judge" name="meken_judge" value="1" @if($meken_judge != '') checked @endif>
                                            <label class="custom-control-label @if($meken_judge != '') active @endif" for="meken_judge">判断不可</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="meken_novalue" name="meken_novalue" value="1" @if($meken_novalue != '') checked @endif>
                                            <label class="custom-control-label @if($meken_novalue != '') active @endif" for="meken_novalue">実在データなし</label>
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="mb-4">
                                    <dt>担当</dt>
                                    <dd>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="person_none" name="person_none" value="1" @if($person_none != '') checked @endif>
                                            <label class="custom-control-label @if($person_none != '') active @endif" for="person_none">担当なし</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="person_meken" name="person_meken" value="1" @if($person_meken != '') checked @endif>
                                            <label class="custom-control-label @if($person_meken != '') active @endif" for="person_meken">目検</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="person_nt" name="person_nt" value="1" @if($person_nt != '') checked @endif>
                                            <label class="custom-control-label @if($person_nt != '') active @endif" for="person_nt">NT</label>
                                        </div>
                                    </dd>
                                </dl>
                                <input type="submit" name="re_select_btn" class="btn btn-primary re_select_btn" value="ポイント未付与から検索">
                                <input type="submit" name="re_select_btn" class="btn btn-primary re_select_btn" value="ポイント付与待ちから検索">
                                <input type="submit" name="re_select_btn" class="btn btn-primary re_select_btn" value="ポイント付与済みから検索">
                                <a class="btn btn-warning select_reset_btn">リセット</a>
                                <p class="mt-2">※ステータスと担当の条件検索は「ポイント未付与から検索」のみ有効です。</p>
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
                                            <th>店舗名</th>
                                            <th>数量</th>
                                            <th>ポイント</th>
                                            <th>読み取り</th>
                                            <th>ステータス</th>
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
                                                                    {{ $receipt_status->value2 }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="status">{{ $receipt->admin_display_name }}</td>
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