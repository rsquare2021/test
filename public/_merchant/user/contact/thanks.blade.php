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
                            <div class="">
                                <p class="mb-3">お問い合わせを受け付けいたしました。<br>事務局で内容を確認のうえご連絡させていただきますので、しばらくお待ちいただきますようよろしくお願いいたします。</p>
                            </div>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection