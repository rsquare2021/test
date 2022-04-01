@extends('layouts.user')

@section('content')

    @if(Request::routeIs('campaign.top.catalog.gift.show'))
    @else
        <h2 class="mypage_tit">{{ $gift->product->name }}</h2>
    @endif
    <div class="user_wrap">
        @auth
            <span class="has_point" style="display:none;">{{ $point->remaining_point }}</span>
        @endauth
        <div class="category mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg><span>{{ $gift->product->product_category->name }}</span> &gt; <span>{{ $gift->product->product_category->parent->name }}</span></div>
        <div class="product_detail swiper-container">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <img src="https://re-nt-upload.s3.ap-northeast-1.amazonaws.com/products/{{$campaign->id}}/{{ $image->path }}">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <input type="hidden" class="is_giftee_box" value="{{ $gift->product->isGifteeBox() ? true : false }}">
        <p style="display:none;" class="used_point">{{ $gift->getPoint() }}</p>
        <p class="blue">必要ポイント数：
            <span class="used_point_disp">
                @if($gift->product->is_giftee_box == 0)
                    {{ $gift->getPoint() }}
                @elseif($gift->product->is_giftee_box == 1)
                    @php
                        $point = $gift->getPoint()*2;
                        echo $point;
                    @endphp
                @endif
            </span>pts</p>
        <div id="nodelivered_text"></div>

        @if(Request::routeIs('campaign.catalog.gift.show'))
        <dl class="flex_left nodelivered">
            @if ($gift->product->isGifteeBox())
                <dt>giftee Box</dt>
                <dd>
                    <select name="quantity" id="quantity" class="quantity_gifteebox">
                        <option value="2">200</option>
                        <option value="5">500</option>
                        <option value="10">1000</option>
                        <option value="20">2000</option>
                        <option value="30">3000</option>
                        <option value="70">7000</option>
                        <option value="100">10000</option>
                        <option value="150">15000</option>
                        <option value="200">20000</option>
                        <option value="300">30000</option>
                    </select>
                    <span>円分</span>
                </dd>
            @else
                <dt>個数</dt>
                <dd>
                    <select name="quantity" id="quantity">
                    </select>
                </dd>
            @endif
        </dl>
        @endif
        @if(Request::routeIs('campaign.catalog.gift.show'))
            @if ($gift->product->variations->isEmpty())
                <select name="product_id" id="valiation" style="display:none;">
                    <option value="{{ $gift->product->id }}"></option>
                </select>
            @else
            <dl class="flex_left">
                <dt>種類</dt>
                <dd>
                    <select name="product_id" id="valiation">
                        @foreach ($gift->product->variations as $variation)
                            <option value="{{ $variation->id }}">{{ $variation->variation_name }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            @endif
        @endif
        @if(Request::routeIs('campaign.catalog.gift.show'))
            @if(Request::routeIs('campaign.catalog.gift.show'))
                <a class="yellow order_confirm_btn">交換する</a>
            @endif
        @endif
        
        <h4>景品詳細</h4>
        <div class="product_table mb-3">
            <table>
                <tr>
                    <td>メーカー・ブランド</td>
                    <td>{{ $gift->product->maker_name }}</td>
                </tr>
                <tr>
                    <td>関連URL</td>
                    <td><a href="{{ $gift->product->maker_url }}" target="_blank">{{ $gift->product->maker_url }}</a></td>
                </tr>
                @if (!$gift->product->hasVariation() and !$gift->product->isGifteeBox())
                    <tr>
                        <td>商品コード</td>
                        <td>{{ $gift->product->operation_id }}</td>
                    </tr>
                @endif
            </table>
        </div>
        @if (isset( $gift->product->description_1 ))
            <p class="detail_text">{!! nl2br(e($gift->product->description_1)) !!}</p>
        @endif
        @if (isset( $gift->product->description_2 ))
            <p class="detail_text">{!! nl2br(e($gift->product->description_2)) !!}</p>
        @endif
        @if (isset( $gift->product->notice ))
            <p class="detail_text">{!! nl2br(e($gift->product->notice)) !!}</p>
        @endif
    </div>
    @if(Request::routeIs('campaign.catalog.gift.show'))
        <a class="yellow order_confirm_btn">交換する</a>
    @endif

<!-- モーダル -->
@if(Request::routeIs('campaign.catalog.gift.show'))
    @if(isset( $user_setmail ))
    @else
        <div class="modal fade noset_mail" id="mail_modal" tabindex="-1" role="dialog" aria-labelledby="mail_modal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mail_modal_tit">メールアドレスご登録のお願い</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <p>お客様はまだメールアドレスをご登録いただいておりません。景品の交換などのお手続きの際はメールアドレスのご登録が必要です。</p>
                            <a href="/{{ $campaign->id }}/mail/change" class="basic_login blue_btn mt-2 totop">メールアドレスの登録</a>
                            <button type="button" class="gray_btn mb-3 mt-3" data-dismiss="modal">あとで登録する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

<!-- モーダル -->
<div class="modal fade" id="order_confirm" tabindex="-1" role="dialog" aria-labelledby="order_confirm" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="order_confirm_tit">景品の確認</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('campaign.catalog.gift.apply.set_product', [$campaign_id, $gift->id]) }}" method="post">
                    @csrf
                    <p>以下のお申し込み内容をご確認のうえ、発送先の入力へお進みください。</p>
                    <div class="table_wrap">
                        <table class="blue_table">
                            <tr>
                                <th>景品名</th>
                                <td>
                                    <span class="pro_name_disp" name="">{{ $gift->product->name }}</span>
                                </td>
                            </tr>
                            <tr>
                                @if ($gift->product->isGifteeBox())
                                    <th>金額</th>
                                    <td>
                                        <span class="quantity_disp" name=""></span> <span>円分</span>
                                    </td>
                                @else
                                    <th>数量</th>
                                    <td>
                                        <span class="quantity_disp" name=""></span>
                                    </td>
                                @endif
                            </tr>
                            <tr class="valiation_conf">
                                <th>種類</th>
                                <td>
                                    <span class="valiation_disp" name=""></span>
                                </td>
                            </tr>
                            <tr>
                                <th>必要ポイント数</th>
                                <td><span class="total_use_point_disp"></span>pts</td>
                            </tr>
                            <tr>
                                <th>保有ポイント数</th>
                                <td><span class="total_has_point_disp"></span>pts</td>
                            </tr>
                            <tr>
                                <th>残りポイント数</th>
                                <td><span class="after_point_disp"></span>pts</td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" name="" class="pro_name" value="">
                    <input type="hidden" name="" class="total_use_point" value="">
                    <input type="hidden" name="" class="total_has_point" value="">
                    <input type="hidden" name="" class="after_point" value="">
                    <input type="hidden" name="" class="quantity" value="">
                    <input type="hidden" name="" class="valiation" value="">
                    <input type="hidden" name="quantity" class="quantity" value="">
                    <input type="hidden" name="product_id" class="product_id" value="">
                    <!--<p class="mt-3">※デジタルギフトの有効期限は発行元によって異なります。詳しくは各社の公式ウェブサイトでご確認ください。</p>-->
                    <input type="submit" class="yellow order_confirm_btn input_reset mb-3 mt-3" value="交換する">
                    <button type="button" class="gray_btn mb-3" data-dismiss="modal">前の画面に戻る</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection