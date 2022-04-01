@extends('layouts.user')

@section('content')
    <h2 class="mypage_tit">
        @if ( Request::routeIs('campaign.top.catalog.gift.show') )
        @else
            アカウント情報
        @endif
    </h2>
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <script>
                            console.log($.cookie("_token"));
                        </script>


                        <div class="user_wrap">
                            <h3 class="center_blue">メールアドレスの変更</h3>
                            <div class="caution">
                                <p class="title">受信拒否設定の解除のお願い</p>
                                <p>メールの受信拒否設定をされている方は「next-cp.com」からのメールを許可してからお手続きください。</p>
                            </div>
                            <form class="text-left" action="{{ route('campaign.email.update', $campaign_id) }}" method="post">
                                @csrf
                                @method("put")
                                <div class="form">
                                    <div id="username-field" class="field-wrapper input">
                                        <label for="username">新しいメールアドレス</label>
                                        <div class="relative">
                                            <input id="username" name="email" type="text" class="form-control required" placeholder="新しいメールアドレス">
                                            <check class="mail_check_mark"></check>
                                        </div>
                                    </div>
                                    <div id="username-field" class="field-wrapper input mt-3">
                                        <label for="username_confirm">新しいメールアドレス（確認用）</label>
                                        <div class="relative">
                                            <input id="username_confirm" name="email_confirmation" type="text" class="form-control required" placeholder="新しいメールアドレス（確認用）">
                                            <check class="mail_check_mark"></check>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex justify-content-between mt-4">
                                        <div class="field-wrapper flex_btns">
                                            <a class="back" onclick="history.back()">戻る</a>
                                            <button type="submit" class="blue_btn submit noevent" value="">送信</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection