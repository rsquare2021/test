@extends('layouts.user')

@section('content')
    <div class="overlay"><span>読み込み中...</span></div>
    <h2 class="mypage_tit"><i class="fas fa-exclamation-triangle"></i>レシート撮影時の注意事項</h2>
    <div class="user_wrap">
        <input type="hidden" id="cam_id" value="{{$campaign->id}}">
        <input type="hidden" id="user_id" value="{{$user->id}}">
        <input type="hidden" id="campaign_shop_tree" value="{{$campaign_shop_tree}}">
        <input type="hidden" id="com" value="">
        <input type="hidden" id="DDDstart_time" value="{{ $campaign->start_datetime_to_convert_receipts_to_points->format('Ymd') }}">
        <input type="hidden" id="DDDend_time" value="{{ $campaign->end_datetime_to_convert_receipts_to_points->format('Ymd') }}">
        <input type="hidden" id="start_time" value="20211001">
        <input type="hidden" id="end_time" value="20220304">
        <div id="snap_caution">
        <h3 class="text-left">対象のレシート</h3>
        <p class="text-left">有効レシート発行日時：2022年4月1日〜2023年3月31日<br>ポイント付与条件：軽油25Lにつき1ポイント<br>対象店舗：株式会社ENEOSウイングの直営店および特約店</p>

        <!-- <a id="shops_btn" class="mb-2">対象店舗はこちら</a>
        <div id="shops" class="p-3">
            <dl>
                @foreach ($parents as $parent)
                    @php
                        $chs = $children->where("parent_id", $parent->id);
                    @endphp
                    <dt class="mb-2" id="shop_{{ $parent->id }}"><a href="#shop_{{ $parent->id }}">{{ $parent->name}} 支社</a></dt>
                    <dd>
                        <ul class="mb-2">
                            @foreach ($chs as $child)
                                <li>{{ $child->name }}</li>
                            @endforeach
                        </ul>
                    </dd>
                @endforeach
            </dl>
            <div class="cf"></div>
        </div> -->

        <h3 class="mt-3 text-left">○ 良い例</h3>
        <div>
            <img src="/assets/img/snap-example-ok.jpg" class="mb-3 w100">
            <ul class="mb-3 text-left">
                <li>以下の条件をすべて満たしてください。</li>
                <li>・しわ、破れ、汚れ、丸まり、影などがない</li>
                <li>・手書きの文字がない</li>
                <li>・手で持たず、暗い色の物の上にレシートを置く</li>
                <li>・真上からレシート全体を写す</li>
            </ul>
        </div>

        <h3 class="mt-3 text-left">× 悪い例</h3>
        <div>
            <img src="/assets/img/snap-example-ng.jpg" class="mb-3 w100">
            <ul class="mb-3 text-left">
                <li>・以下の条件に1つでも当てはまるとエラーになります。</li>
                <li>・しわ、破れ、汚れ、丸まり、影がある</li>
                <li>・手書きの文字が書かれている</li>
                <li>・レシート以外の不要な文字が写っている</li>
                <li>・レシートが著しく傾いている、歪んでいる、または一部が写っていない</li>
            </ul>
        </div>

            <div class="extention mt-4">
                <p class="tit"><i class="fas fa-exclamation-triangle mr-1"></i>注意事項</p>
                <p>レシートの複製、数字の偽装などの悪質な不正があった場合はアカウント削除などの措置を取らせていただきますのでご了承ください。</p>
            </div>

            <div class="snap_btn">
                <label class="mt-4">
                    <i class="fas fa-camera"></i>
                    <input id="fileInput" type="file" accept="image/*" capture="camera"/>撮影(カメラを起動)
                </label>
            </div>
        </div>

        <div id="snap_result" class="mt-3">
            <div id="image_area">
		        <p><img id="camImage"/></p>
	        </div>

            <!-- <div id="snap_error">
                <p>読み取りエラー</p>
                <div id="error_reason"></div>
                <div class="snap_btn">
                    <label>
                        <i class="fas fa-camera"></i>
                        <input id="error_fileInput" type="file" accept="image/*" capture="camera" style="display:none;"/>撮り直す(カメラを起動)
                    </label>
                </div>
            </div> -->

            <div id="snap_ok">
                <p class="snap_midashi mt-3">給油量</p>
                <input id="res_input" type="textarea" class="mb-2"><span class="bold">L</span>
                <p>＊システムが読み取った数量に誤りがある場合は、お手数ですが修正をお願いいたします。正しい数量を送信いただくとポイント付与の時間が短縮できる場合がございます。</p>

                <p class="snap_midashi mt-3">獲得ポイント数(暫定)</p>
                <p id="get_point"></p>
                <p>*ポイントの付与には時間が掛かる場合がございますので、予めご了承ください。</p>

                <div id="snap_error">
                    <p>読み取りエラー</p>
                    <div id="error_reason"></div>
                    <!-- <div class="snap_btn">
                        <label>
                            <i class="fas fa-camera"></i>
                            <input id="error_fileInput" type="file" accept="image/*" capture="camera" style="display:none;"/>撮り直す(カメラを起動)
                        </label>
                    </div> -->
                </div>
                <div class="snap_btn">
                    <label class="mt-4">
                        <i class="fas fa-camera"></i>
                        <input id="re_fileInput" type="file" accept="image/*" capture="camera"/>撮り直す(カメラを起動)
                    </label>
                </div>

                <div class="snap_btn">
                    <label id="sendBtn">送信</label>
                </div>
            </div>
        </div>
        <canvas id="resize_canvas" style="display:none;"></canvas>
    </div>

    <div class="modal fade" id="cautionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border:none;">
                    <p class="snap_midashi">注意事項</p>
                </div>
                <div class="modal-body">
                    <p>レシートの複製、数字の偽造などの悪質な不正があった場合はアカウント削除などの措置を取らせていただきますのでご了承ください。</p>
                </div>
                <div class="modal-footer" style="display:block;text-align:center;border:none;">
                    <div class="modal_check">
                        <input type="checkbox">次回から表示しない
                    </div>
                    <div class="snap_btn">
                        <a onclick="$('#cautionModal').css('display','none');"><label id="sendBtn" class="close">閉じる</label></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cautionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border:none;">
                    <p class="snap_midashi">注意事項</p>
                </div>
                <div class="modal-body">
                    <p>レシートの複製、数字の偽造などの悪質な不正があった場合はアカウント削除などの措置を取らせていただきますのでご了承ください。</p>
                </div>
                <div class="modal-footer" style="display:block;text-align:center;border:none;">
                    <div class="modal_check">
                        <input type="checkbox">次回から表示しない
                    </div>
                    <div class="snap_btn">
                        <a onclick="$('#cautionModal').css('display','none');"><label id="sendBtn" class="close">閉じる</label></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection