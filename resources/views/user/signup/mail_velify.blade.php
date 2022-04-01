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
                            <form class="text-left" action="{{ route('campaign.verification.resend', UserRoute::campaign()->id) }}" method="post">
                                @csrf
                                <!-- 入力画面 -->
                                <div id="register_input">
                                    <h3>メールアドレスの確認</h3>
                                    <div class="form p-3">
                                        <p>[確認URLの送信] を押してメールアドレスの確認を行ってください。</p>
                                        <div class="caution">
                                            <p class="title">受信拒否設定の解除のお願い</p>
                                            <p>メールの受信拒否設定をされている方は「next-cp.com」からのメールを許可してからお手続きください。</p>
                                        </div>
                                        <div class="d-sm-flex justify-content-between mt-4">
                                            <div class="field-wrapper flex_btns">
                                                <a class="back" onclick="history.back()">戻る</a>
                                                <button class="blue_btn mail_velify_btn">確認URLの送信</button>
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