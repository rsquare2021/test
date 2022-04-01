@extends('layouts.user')
@section('content')
@include('user.snap.snap_load')
    <h2 class="mypage_tit">レシート読み取り</h2>
    <div class="user_wrap">
        <form action="{{ route('campaign.receipt.snap.send',$campaign_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('user.snap.snap_inputs')
            <div id="snap_caution">
                <p class="mt-5 mb-4">送信が完了しました。</p>
                <div class="snap_btn">
                    <label class="mt-4">
                        <i class="fas fa-camera"></i>
                        <input name="fileInput" id="fileInput" type="file" accept="image/*" capture="camera"/>別のレシートを撮影する
                    </label>
                </div>
            </div>
            <div id="snap_result" class="mt-3">
                <div id="image_area">
                    <p><img id="camImage"/></p>
                </div>
                <div id="snap_ok">
                    <input style="display:none !important;" id="res_input" type="textarea" class="mb-2"><span class="bold"></span>
                    <p style="display:none !important;" id="get_point"></p>
                    <div id="snap_error">
                        <div id="error_reason"></div>
                    </div>
                    <div id="debug_status"></div>
                    <div class="snap_btn">
                        <label class="mt-4">
                            <i class="fas fa-camera"></i>
                            <input name="re_fileInput" id="re_fileInput" type="file" accept="image/*" capture="camera"/>別のレシートを読み取る
                        </label>
                    </div>
                    <a class="camera_link font_normal mt-2" id="sendBtn">送信</a>
                </div>
            </div>
            <a class="blue_btn mt-3" href="{{ route('campaign.dashboard', $campaign->id) }}">ダッシュボードに戻る</a>
            <canvas id="resize_canvas" style="display:none;"></canvas>
        </form>
    </div>

@endsection