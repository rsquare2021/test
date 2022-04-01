@extends('layouts.user')

@section('content')
    <div class="mv"><img src="/assets/img/hero-sp.jpg"></div>
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <script>
                            console.log($.cookie("_token"));
                        </script>
                        
                        <div class="bloc p-3 border_blue mb-3">
                            <h3 class="color_blue text-center fz_16 bold"><span class="rotate">／</span>　キャンペーン名　<span class="normal">／</span></h3>
                            <p>{{ $campaign->name }}</p>
                        </div>

                        <div class="bloc p-3 border_blue">
                            <h3 class="color_blue text-center fz_16 bold"><span class="rotate">／</span>　キャンペーン期間　<span class="normal">／</span></h3>
                            <p>有効レシート発行日時：{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}〜{{ $campaign->end_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}</p>
                            <p>景品申請期間：{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}〜{{ $campaign->close_datetime->format("Y年m月d日") }}</p>
                        </div>

                        <div class="bloc otoiawase p-3">
                            <p class="bold">【お問い合わせ先】</p>
                            {!! nl2br(e($campaign->terms_of_service)) !!}
                        </div>

                        <div class="list_btn p-3">
                            <a href="{{ route('campaign.top.catalog.gift.index', $campaign->id) }}">景品一覧</a>
                        </div>

                        <!-- <div class="pl-3 pr-3">
                            <a class="blue_btn" href="{{ route('campaign.entry', $campaign->id) }}">参加する</a>
                        </div> -->

                        <form class="text-left p-3" action="{{ route('campaign.login', $campaign->id) }}" method="post">
                            @csrf
                            <div class="white form p-3">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">メールアドレス</label>
                                    @error('email')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="username" name="email" type="text" class="form-control" placeholder="メールアドレス" value="{{ $email }}">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2 mt-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">パスワード</label>
                                    </div>
                                    @error('password')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="password" name="password" type="password" class="form-control" placeholder="パスワード">
                                </div>
                                <a href="{{ route('campaign.password.request', $campaign->id) }}" class="blue_text mt-2 signin_start_btn">パスワードを忘れた方</a>
                                <div class="remember">
                                    <input type="checkbox" id="remember" name="remember" value="remember" @if($email) checked @endif>
                                    <label for="remember">メールアドレスを記憶する</label>
                                </div>
                                <div class="d-sm-flex justify-content-between mt-4">
                                    <div class="field-wrapper">
                                        <button type="submit" class="basic_login" value="">サインイン</button>
                                        <center class="text-dark mt-2 mb-2">または</center>
                                        <a href="{{ route('campaign.login.provider', [$campaign->id, 'line']) }}" class="line_login">LINEでログイン</a>
                                        <a href="{{ route('campaign.register.method', $campaign->id) }}" class="blue_text mt-3 signin_start_btn">※まだアカウントをお持ちでない方はこちら</a>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection