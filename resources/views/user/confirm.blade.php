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
                            <h3>キャンペーン参加同意の確認</h3>
                            <div class="p-4">
                                <p class="mb-3">お客様は「{{ $campaign->name }}」への参加同意が確認できておりません。<br>キャンペーンに参加するには応募要項および個人情報の取り扱いにご同意いただく必要がございます。</p>
                                <div class="kiyaku mb-3">
                                    <h4>応募要項</h4>
                                    <p>{!! nl2br(e($campaign->application_requirements)) !!}</p>
                                    <h4 class="mt-3">個人情報の取り扱いについて</h4>
                                    <p>{!! nl2br(e($campaign->privacy_policy)) !!}</p>
                                </div>
                                <div class="btns">
                                    <form action="{{ route('campaign.entry', $campaign->id) }}" method="post">
                                        @csrf
                                        <button class="blue_btn w100">同意して参加する</button>
                                    </form>
                                    <a href="" class="mt-3 gray_btn w100">同意しない</a>
                                </div>
                            </div>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

@endsection