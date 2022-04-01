@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">パスワードの再設定</h2>
    <div class="form-container outer mt-3">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <script>
                            console.log($.cookie("_token"));
                        </script>

                        <div class="base_window">
                            <form class="text-left" action="{{ route('campaign.password.change.update', $campaign->id) }}" method="post">
                                @csrf
                                <div class="form p-3">
                                    <p>新しいパスワードを入力してください。<br>※LINEログインをご利用の方はパスワードの設定は不要です。</p>
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
                                            <input id="password_confirm" name="password_confirmation" type="password" class="form-control required" placeholder="パスワード" value="">
                                            <check class="pass_check_mark"></check>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex justify-content-between mt-4">
                                        <div class="field-wrapper flex_btns">
                                            <a class="back" onclick="history.back()">戻る</a>
                                            <button type="submit" class="blue_btn noevent submit" value="">再設定</button>
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