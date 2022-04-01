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

                        <div class="">
                            <h3 class="center_blue">確認用URLメール送信の完了</h3>
                            <form class="text-left" action="{{ route('campaign.login', request()->route()->parameter('campaign_id')) }}" method="post">
                                @csrf
                                <div class="form">
                                    <p>ご入力されたメールアドレスに確認用URLを送信しました。<br>確認用URLにアクセスして本登録を完了してください。<br><em>確認用URLの有効期限は24時間です。</em></p>
                                </div>
                                <div class="caution">
                                    <p class="title">【重要：現在は仮登録の状態です】</p>
                                    <p>確認用URLにアクセスして本登録完了となります。</p>
                                </div>
                            </form>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection