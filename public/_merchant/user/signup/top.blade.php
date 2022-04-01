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
                            <h3>アカウントの新規作成</h3>
                            <div class="p-4">
                                <p class="mb-3">以下のいずれかの方法でアカウントを作成できます。<br>キャンペーンに参加するには応募要項および個人情報の取り扱いにご同意のうえ、アカウントを作成いただく必要がございます。</p>
                                <div class="kiyaku mb-3">
                                    <h4>応募要項</h4>
                                    <p>{!! nl2br(e($campaign->application_requirements)) !!}</p>
                                    <h4 class="mt-3">個人情報の取り扱いについて</h4>
                                    <p>{!! nl2br(e($campaign->privacy_policy)) !!}</p>
                                </div>
                                <div class="accept">
                                    <input type="checkbox" id="accept" name="subscribe" value="newsletter">
                                    <label for="accept">応募要項と個人情報の取り扱いに同意</label>
                                </div>
                                <div class="btns">
                                    <a href="{{ route('campaign.register', $campaign_id) }}" class="blue_btn basic_login mb-3 noactive">メールアドレスで新規作成</a>
                                    <a href="{{ route('campaign.login.provider', [$campaign_id, 'line']) }}" class="line_login noactive">LINEアカウントで新規作成</a>
                                </div>
                            </div>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection