@extends('layouts.user')

@section('content')
    <div class="mv pc"><img src="/uploads/{{$campaign->id}}/hero-pc.jpg"></div>
    <div class="mv sp"><img src="/uploads/{{$campaign->id}}/hero-sp.jpg"></div>
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
            
                            <h3 class="color_blue text-center fz_16 bold"><span class="rotate">／</span>　キャンペーン期間　<span class="normal">／</span></h3>
                            <p>有効レシート発行日時：{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}〜{{ $campaign->end_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}<br>※レシート発行日から20日以内に限る。</p>
                            <p>景品申請期間：{{ $campaign->start_datetime_to_convert_receipts_to_points->format("Y年m月d日") }}〜{{ $campaign->close_datetime->format("Y年m月d日") }}</p>

                            <h3 class="color_blue text-center fz_16 bold"><span class="rotate">／</span>　対象店舗　<span class="normal">／</span></h3>
                            <p><a href="https://www.eneos-wing.co.jp/ew-info/wp-content/uploads/2022/03/%E4%BF%AE%E6%AD%A3%E7%89%88202112192_%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BEENEOS%E3%82%A6%E3%82%A4%E3%83%B3%E3%82%AF%E3%82%99%E6%A7%98_%E4%B9%97%E5%8B%99%E5%93%A1%E6%A7%98%E8%AC%9D%E6%81%A9%E7%A5%AD2022%E5%B9%B4_A3%E4%BA%8C%E3%81%A4%E6%8A%98%E3%82%8A%E3%83%AA%E3%83%BC%E3%83%95%E5%BA%97%E8%88%97%E4%B8%80%E8%A6%A7.pdf" target="_blank">こちらのリンク先 (PDF) でご確認ください。</a></p>
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
                                    @error('email')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="username" name="email" type="text" class="form-control" placeholder="メールアドレス" value="{{ $email }}">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2 mt-3">
                                    @error('password')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="form-password-with-eye">
                                        <input id="password" name="password" type="password" class="form-control" placeholder="パスワード">
                                        <i class="fa fa-eye-slash toggle_showing_password no_confirmation"></i>
                                    </div>
                                </div>
                                <div class="remember">
                                    <input type="checkbox" id="remember" name="remember" value="remember" @if($email) checked @endif>
                                    <label for="remember">メールアドレスを記憶する</label>
                                </div>
                                <div class="d-sm-flex justify-content-between mt-4">
                                    <div class="field-wrapper">
                                        <button type="submit" class="basic_login" value="">サインイン</button>
                                    </div>
                                </div>
                                    <div class="field-wrapper">
                                        <p><a href="{{ route('campaign.password.request', $campaign->id) }}" class="signin_start_btn">パスワードをお忘れの方はこちら</a></p>
                                        <p><a href="{{ route('campaign.register.method', $campaign->id) }}" class="signin_start_btn">まだアカウントをお持ちでない方はこちら</a></p>
                                    </div>
                            </div>
                            <center class="text-dark mt-2 mb-2">または</center>
                            <div class="white form p-3">
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                    <a href="{{ route('campaign.login.provider', [$campaign->id, 'line']) }}" class="line_login">LINEでログイン</a>
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