@extends('layouts.user')

@section('content')
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <script>
                            console.log($.cookie("_token"));
                        </script>

                        <div class="base_window">
                            <form class="text-left" action="{{ route('campaign.register', $campaign_id) }}" method="post">
                                @csrf
                                @include('kano.show_error_all')
                                <!-- 入力画面 -->
                                <div id="register_input">
                                    <h3>メールアドレスで新規作成</h3>
                                    <div class="form p-3">
                                        <p>以下の項目をご入力のうえ、よろしければ [確認] を押してください。</p>
                                        <div class="caution">
                                            <p class="title">受信拒否設定の解除のお願い</p>
                                            <p>メールの受信拒否設定をされている方は「next-cp.com」からのメールを許可してからお手続きください。</p>
                                        </div>
                                        <div id="username-field" class="field-wrapper input">
                                            <label for="username">メールアドレス</label>
                                            <div class="relative">
                                                <input id="username" name="email" type="text" class="form-control required" placeholder="メールアドレス">
                                                <check class="mail_check_mark"></check>
                                            </div>
                                        </div>
                                        <div id="username-field" class="field-wrapper input mt-3">
                                            <label for="username">メールアドレス（確認用）</label>
                                            <div class="relative">
                                                <input id="username_confirm" name="email_confirmation" type="text" class="form-control required" placeholder="メールアドレス">
                                                <check class="mail_check_mark"></check>
                                            </div>
                                        </div>
                                        <div id="password-field" class="field-wrapper input mb-2 mt-3">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">パスワード <small>※大文字を含む半角英数字の組み合わせで8桁以上</small></label>
                                            </div>
                                            <div class="relative">
                                                <input id="password" name="password" type="password" class="form-control required" placeholder="パスワード" value="">
                                                <check class="pass_check_mark"></check>
                                            </div>
                                        </div>
                                        <div id="password-field" class="field-wrapper input mb-2 mt-3">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">パスワード（確認用）</label>
                                            </div>
                                            <div class="relative">
                                                <input id="password_confirm" name="password_confirmation" type="password" class="form-control required" placeholder="パスワード（確認用）" value="">
                                                <check class="pass_check_mark"></check>
                                            </div>
                                        </div>
                                        <div class="d-sm-flex justify-content-between mt-4">
                                            <div class="field-wrapper flex_btns">
                                                <a class="back" onclick="history.back()">戻る</a>
                                                <a class="blue_btn register_confirm_btn noevent">確認</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 確認画面 -->
                                <div id="register_confirm">
                                    <h3>入力内容の確認</h3>
                                    <div class="form p-3">
                                        <p>以下の内容をご確認のうえ、[確認用URLの送信] を押してください。</p>
                                        <p class="mt-3">メールアドレス</p>
                                        <b class="mail_confirm_text">yourname@next-cp.com</b>
                                        <div class="d-sm-flex justify-content-between mt-4">
                                            <div class="field-wrapper flex_btns">
                                                <a class="register_confirm_back_btn">戻る</a>
                                                <button type="submit" class="blue_btn submit" value="">確認用URLの送信</button>
                                            </div>
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