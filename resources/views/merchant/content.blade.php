@if (session('flash_message'))
    <div class="flash_message">
        <p class="text-danger text-center font-weight-bold">{{ session('flash_message') }}</p>
    </div>
@endif

<div class="value_bloc meken_bloc">
    @if($receipt->status_shop == 1)
        <dl class="st_input">
            <dt class="lightgreen">特定店舗</dt>
            <dd>読み取りのできない店舗のレシートです。レシート発行日時と対象商品の数量をそれぞれ入力してください。</dd>
        </dl>
    @endif
    @if($receipt->status_multi == 1)
        <dl class="st_input">
            <dt class="lightgreen">複数商品</dt>
            <dd>商品が複数あります。対象商品の数量をそれぞれ入力してください。</dd>
        </dl>
    @endif
    @if($receipt->status_count == 1)
        <dl>
            <dt class="navy">重複</dt>
            <dd>重複するレシートを検出しました。判断方法が複雑なためマニュアルをご確認ください。</dd>
        </dl>
    @endif
    @if($receipt->status_nodata == 1)
        <dl class="st_input">
            <dt class="green">実在なし</dt>
            <dd>売上データと照合できませんでした。判断フローが複雑なためマニュアルをご確認ください。</dd>
        </dl>
    @endif
    <table class="table value_table mk_table mt-4">
        <tr>
            <th>読み取り</th>
            <th>確認後</th>
            <th></th>
        </tr>
        <tr>
            <td>{{ $receipt->receipt_value }} L</td>
            <td class="value_td">
                @if($multi_values)
                    @foreach($multi_values as $multi_value)
                        @if($loop->first)
                            <div class="set_value mb-2">
                                <div class="inputs"><input class="form-control multi_value" type="text" name="multi_value[]" value="{{ $multi_value }}"> L</div>
                            </div>
                        @else
                            @if($multi_value !== '0.00')
                                <div class="set_value mb-2">
                                    <div class="inputs"><input class="form-control multi_value" type="text" name="multi_value[]" value="{{ $multi_value }}"> L</div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @else
                    <div class="set_value mb-2">
                        <div class="inputs"><input class="form-control multi_value" type="text" name="multi_value[]" value="{{ $receipt->mk_value }}"> L</div>
                    </div>
                @endif
            </td>
            <td><a class="btn btn-primary set_value_plus mt-1">商品追加</a></td>
        </tr>
    </table>
    <table class="table date_table mk_table">
        <tr>
            <td>発行日時</td>
            <td>
                @if($back_data)
                    @php
                        $time1 = $back_data['mk_time1'];
                        $time2 = $back_data['mk_time2'];
                    @endphp
                @else
                    @php
                        $time = $receipt->mk_time;
                        $time1 = substr($time, 0, 2);
                        $time2 = substr($time, -2, 2);
                    @endphp
                @endif
                <input class="form-control datepicker" type="text" name="mk_date" value="@if($back_data) {{ $back_data['mk_date'] }} @else {{ $receipt->mk_date }} @endif" size="10">　
                <input class="form-control" type="text" name="mk_time1" value="@php echo $time1; @endphp" size="2" maxlength="2">：
                <input class="form-control" type="text" name="mk_time2" value="@php echo $time2; @endphp" size="2" maxlength="2">
            </td>
        </tr>
    </table>
    <table class="table tel_table mk_table">
        <tr>
            <td>電話番号</td>
            <td>{{ $receipt->mk_tel }}</td>
        </tr>
    </table>
    @if($receipt->status_input == 1 || $receipt->status_diff == 1 || $receipt->status_count == 1 || $receipt->status_multi == 1 || $receipt->status_shop == 1 || $receipt->status_nodata == 1)
        <center><a class="confirm_product @if($kengen !== 0) active @endif" data-conf="product">確認済み</a></center>
    @endif
</div>
@if($kengen !== 0 && $kengen !== 1)
    <div class="ng_bloc meken_bloc">
        @if($receipt->status_ngword == 2)
        <dl>
            <dt class="lightblue">NGワード2</dt>
            <dd>「再」を検出しました。判断フローが複雑なためマニュアルをご確認ください。</dd>
        </dl>
        @endif
        @if($receipt->status_ngword == 1 || $receipt->status_ngword == 2 || $receipt->status_nodata == 1)
            <center><a class="confirm_ngword @if($kengen !== 0) active @endif" data-conf="ngword">確認済み</a></center>
        @endif
    </div>
@endif
<div class="memo">
    <textarea class="form-control" id="mk_memo" name="mk_memo" rows="3">@if($back_data){{ $back_data['mk_memo'] }}@else{{ $receipt->receipt_memo }}@endif</textarea>
</div>

<div class="user_info mt-4">
    このユーザーの再発行レシート数：<big>{{ $ng_count }}</big> 件
</div>