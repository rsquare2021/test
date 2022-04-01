@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">
        
        <div class="row layout-top-spacing">
        
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <form action="{{ route('admin.project.apply', $campaign) }}" method="get" id="re_select">
                        <div class="flex">
                            <div class="bloc">
                                <p class="mb-0">交換ID</p>
                                <input class="form-control" type="text" name="apply_id" value="{{ $apply_id }}">
                            </div>
                            <div class="bloc">
                                <p class="mb-0">応募者ID</p>
                                <input class="form-control" type="text" name="apply_user_id" value="{{ $apply_user_id }}">
                            </div>
                            <div class="bloc">
                                <p class="mb-0">会社名</p>
                                <input class="form-control" type="text" name="apply_user_company" value="{{ $apply_user_company }}">
                            </div>
                            <div class="bloc">
                                <p class="mb-0">名前</p>
                                <input class="form-control" type="text" name="apply_user_name" value="{{ $apply_user_name }}">
                            </div>
                        </div>
                        <div class="flex mt-4 mb-4">
                            <div class="bloc">
                                <p class="mb-0">景品管理番号</p>
                                <input class="form-control" type="text" name="operation_id" value="{{ $operation_id }}">
                            </div>
                            <div class="bloc">
                                <p class="mb-0">申し込み日</p>
                                <input class="form-control datepicker" type="text" name="start_date" value="{{ $start_date }}">〜<input class="form-control datepicker" type="text" name="end_date" value="{{ $end_date }}">
                            </div>
                        </div>
                        <dl class="mb-4 mt-4">
                            <div class="bloc">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="apply_status_none" name="apply_status" value="apply_status_none" class="custom-control-input default" @if($apply_status == 'apply_status_none') checked @endif>
                                    <label class="custom-control-label" for="apply_status_none">ステータス指定なし</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="apply_status_13" name="apply_status" value="apply_status_13" class="custom-control-input" @if($apply_status == 'apply_status_13') checked @endif>
                                    <label class="custom-control-label" for="apply_status_13">応募済み</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="apply_status_33" name="apply_status" value="apply_status_33" class="custom-control-input" @if($apply_status == 'apply_status_33') checked @endif>
                                    <label class="custom-control-label" for="apply_status_33">発送準備中</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="apply_status_31" name="apply_status" value="apply_status_31" class="custom-control-input" @if($apply_status == 'apply_status_31') checked @endif>
                                    <label class="custom-control-label" for="apply_status_31">発送済み</label>
                                </div>
                            </div>
                        </dl>
                        <input type="submit" name="user_select_btn" class="btn btn-primary user_select_btn" value="検索">
                        <a class="btn btn-warning select_reset_btn">リセット</a>
                    </form>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover user_list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>日時</th>
                                    <th>サプライヤー</th>
                                    <th>管理番号</th>
                                    <th>景品名</th>
                                    <th>バリエーション</th>
                                    <th>数量</th>
                                    <th>応募者ID</th>
                                    <th>ステータス</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applies as $apply)
                                    <tr>
                                        <td rowspan="2">{{ $apply->id }}</td>
                                        <td>{{ $apply->created_at }}</td>
                                        <td>{{ $apply->product->supplier_id }}</td>
                                        <td>{{ $apply->product->operation_id }}</td>
                                        <td>{{ $apply->product->name }}</td>
                                        <td>{{ $apply->product->variation_name }}</td>
                                        <td>{{ $apply->quantity }}</td>
                                        <td>{{ $apply->user_id }}</td>
                                        <td rowspan="2" class="apply_admin_status">
                                            <p class="status_name">{{ $apply->status->name }}</p>
                                            @if ($apply->shipping_address && App\Models\ApplyStatus::canEditAdminApply($apply->status->id))
                                                <div class="flex" data-id="{{ $apply->id }}">
                                                    <div class="status_applied status_content {{ $apply->apply_status_id == App\Models\ApplyStatus::WAITING_ADDRESS ? 'active' : '' }}" data-new_status_id="{{ App\Models\ApplyStatus::WAITING_ADDRESS }}">応募</div>
                                                    <div class="status_applied status_content {{ $apply->apply_status_id == App\Models\ApplyStatus::PREPARING_SEND  ? 'active' : '' }}" data-new_status_id="{{ App\Models\ApplyStatus::PREPARING_SEND }}">準備</div>
                                                    <div class="status_applied status_content {{ $apply->apply_status_id == App\Models\ApplyStatus::SENT_PRODUCT    ? 'active' : '' }}" data-new_status_id="{{ App\Models\ApplyStatus::SENT_PRODUCT }}">発送</div>
                                                </div>
                                            @else
                                                <div></div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            @if ($apply->shipping_address)
                                                <div>{{ $apply->shipping_address->company_name }}</div>
                                                <div>{{ $apply->shipping_address->personal_name }}</div>
                                            @endif
                                            {{ $apply->shipping_address ? $apply->shipping_address->getAddress() : "" }}
                                        </td>
                                        <td colspan="3">{{ $apply->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="pager">
                            {{$applies->appends(request()->query())->links()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection