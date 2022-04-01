@extends('layouts.user')

@section('content')

    <h2 class="mypage_tit">ダッシュボード<a href="" class="absolute01">ログアウト</a></h2>
        <div class="user_wrap">
            
            <p class="blue">実施期間：2022-04-01〜2023-03-31</p>
            <div class="white">
                <h3>保有ポイント数</h3>
                <count class="now_point">230</count>
                <div class="total_point">（累計ポイント数：<span>2080</span>）</div>
            </div>
            <div class="flex around mt-3 mb-3">
                <div class="white">
                    <h3>累計交換回数</h3>
                    <count class="total_exchange">2</count>
                    <a href="">交換履歴 ></a>
                </div>
                <div class="white">
                    <h3>承認待ちレシート数</h3>
                    <count class="stay_receipt">1</count>
                    <a href="">送信履歴 ></a>
                </div>
            </div>
            <a class="camera_link mt-3">レシート撮影</a>
            <a href="" class="product_list_link mt-3">景品一覧</a>
        </div>

<!-- モーダル -->
<div class="modal fade" id="extention" tabindex="-1" role="dialog" aria-labelledby="extention" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="extention_tit">注意事項</h5>
            </div>
            <div class="modal-body">
                <p>レシートの複製、数字の偽装などの悪質な不正があった場合はアカウント削除などの措置を取らせていただきますのでご了承ください。</p>
                <a href="" class="close">閉じる</a>
            </div>
        </div>
    </div>
</div>

@endsection