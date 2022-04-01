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
                        <p>以下のお問い合わせの内容をご確認のうえ、よろしければ [送信] ボタンを押してください。</p>
                        <div class="mt-5">
                            <form class="text-left" action="{{ route('campaign.contact.send',[$campaign_id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                                <input type="hidden" name="contact" value="{{ $contact['contact'] }}">
                                <input type="hidden" name="contact_type" value="{{ $contact['contact_type'] }}">
                                <input type="hidden" name="contact_tel" value="{{ $contact['contact_tel'] }}">
                                <div id="register_input">
                                    <div class="form">
                                        <div id="username-field" class="field-wrapper input mb-3">
                                            <label for="username">電話番号</label>
                                            <p>{{ $contact['contact_tel'] }}</p>
                                        </div>
                                        <div id="username-field" class="field-wrapper input mb-3">
                                            <label for="username">お問い合わせの種類</label>
                                            <p>{{ $contact['contact_type'] }}</p>
                                        </div>
                                        <div id="username-field" class="field-wrapper input mb-5">
                                            <label for="username">お問い合わせの内容</label>
                                            <p>{{ $contact['contact'] }}</p>
                                        </div>
                                        <div class="d-sm-flex justify-content-between">
                                            <div class="field-wrapper flex_btns">
                                                <a class="back" onclick="history.back()">戻る</a>
                                                <button type="submit" class="btn blue_btn">送信</button>
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