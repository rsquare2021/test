@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">パスワード設定の完了</h2>
    <div class="user_wrap">
        <p>パスワードの設定を完了しました。<br>引き続きキャンペーンをお楽しみください。</p>
    </div>

    <!-- <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <script>
                            console.log($.cookie("_token"));
                        </script>

                        <div class="base_window">
                            <h3></h3>
                            <form class="text-left" action="{{ route('campaign.login', request()->route()->parameter('campaign_id')) }}" method="post">
                                @csrf
                                <div class="form p-3">
                                    <p>お客様のパスワードを再設定しました。</p>
                                </div>
                            </form>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div> -->

@endsection