@extends('layouts.user')

@section('content')
    <h2 class="mypage_tit">
        @if ( Request::routeIs('campaign.top.catalog.gift.show') )
        @else
            問い合わせ
        @endif
    </h2>
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <div class="">
                            <form class="text-left" action="{{ route('campaign.contact.confirm',[$campaign_id]) }}" method="post">
                                @csrf
                                <div id="register_input">
                                    <div class="form">
                                        <div id="username-field" class="field-wrapper input">
                                            <label for="username">問い合わせの種類</label>
                                            <div>
                                                <select name="contact_type" id="contact_type">
                                                    <option value="ユーザーアカウントについて">ユーザーアカウントについて</option>
                                                    <option value="レシート撮影・ポイントについて">レシート撮影・ポイントについて</option>
                                                    <option value="景品について">景品について</option>
                                                    <option value="その他">その他</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="username-field" class="field-wrapper input mt-3">
                                            <label for="username">お問い合わせの内容</label>
                                            <textarea id="contact" class="form-control  @error('contact') is-invalid @enderror" name="contact" cols="30" rows="10"></textarea>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}">
                                        <div class="d-sm-flex justify-content-between mt-4">
                                            <div class="field-wrapper flex_btns">
                                                <a class="back" onclick="history.back()">戻る</a>
                                                <button type="submit" class="btn blue_btn">確認</button>
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