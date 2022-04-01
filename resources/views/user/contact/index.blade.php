@extends('layouts.user')

@section('content')
    <h2 class="mypage_tit">

        @if ( Request::routeIs('campaign.top.catalog.gift.show') )
        @else
            お問い合わせ
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
                                        <a href="{{ route('campaign.contact.confirm') }}"></a>
                                        <div id="username-field" class="field-wrapper input mb-3">
                                            <label for="username">電話番号（ハイフンあり）</label>
                                            <div>
                                                <input class="form-control @error('contact_tel') is-invalid @enderror" type="text" name="contact_tel" value="{{ old('contact_tel') }}" placeholder="電話番号 (ハイフンあり)">
                                                @error('contact_tel')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>電話番号をハイフンありで入力してください。</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="username-field" class="field-wrapper input mb-3">
                                            <label for="username">お問い合わせの種類</label>
                                            <div>
                                                <select name="contact_type" id="contact_type">
                                                    <option value="キャンペーン内容">キャンペーン内容</option>
                                                    <option value="アカウント登録・情報変更">アカウント登録・情報変更</option>
                                                    <option value="レシート読み取り・ポイント付与">レシート読み取り・ポイント付与</option>
                                                    <option value="ポイントの交換・景品">ポイントの交換・景品</option>
                                                    <option value="その他">その他</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="username-field" class="field-wrapper input mb-5">
                                            <label for="username">お問い合わせの内容</label>
                                            <textarea id="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" cols="30" rows="10">{{ old('contact') }}</textarea>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>お問い合わせ内容を入力してください。</strong>
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