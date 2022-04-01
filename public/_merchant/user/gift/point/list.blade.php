@extends('layouts.user')

@section('content')

    @if ( Request::routeIs('campaign.top.catalog.gift.index') )
    @else
        <h2 class="mypage_tit mb-0">商品一覧</h2>
    @endif
    
    <div class="user_wrap">
        @if($search_word || $search_point || $search_category)
            <p class="mt-2 mb-2">
            @if($search_word !== null)
                「{{ $search_word }}」
            @endif
            @if($search_category)
                「{{ $search_category }}」
            @endif
            @if($search_point !== '')
                「{{ $search_point }}」
            @endif
            の検索結果</p>
        @endif
        <div class="products recommend">
            <h3 class="mt-2 mb-4">おすすめの商品</h3>
            <ul class="swiper-wrapper">
                @foreach ($recommends as $recommend)
                    <li class="swiper-slide">
                        @if ( Request::routeIs('campaign.top.catalog.gift.index') )
                            <a href="{{ route('campaign.top.catalog.gift.show', [$campaign_id, $recommend->id]) }}">
                        @else
                            <a href="{{ route('campaign.catalog.gift.show', [$campaign_id, $recommend->id]) }}">
                        @endif
                            <div class="img"><img src="/uploads/{{$campaign->id}}/{{ $recommend->product->supplier_id }}-{{ $recommend->product->operation_id }}.jpg"></div>
                            <h4>{{ $recommend->getProductName() }}</h4>
                            <div class="use_point">必要ポイント数：<span>{{ $recommend->getPoint() }}</span>pts</div>
                            <div class="category"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg><span>{{ $recommend->getCategoryName() }}</span></div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="swiper-pagination"></div>
        </div>
        <div class="cf"></div>

        <div class="product_search mt-3 mb-4 pt-3">
            @if ( Request::routeIs('campaign.top.catalog.gift.index') )
                <div class="pre_search" >
            @else
                <div class="w100">
            @endif
                <div class="left">
                    <div class="cp_ipselect cp_sl04">
                        <select class="select_cat">
                            <option data-cat_id="" value="">カテゴリを選ぶ</option>
                            @foreach ($category_parents->sortBy("id") as $parent)
                                @php
                                    $children = $category_children->where("parent_id", $parent->id);
                                    $sum = $children->sum("products_count");
                                @endphp
                                <option data-catid="{{ $parent->id }}" data-catname="{{ $parent->name}}" value="{{ $parent->id }}">{{ $parent->name}} ({{ $sum }})</option>
                                @foreach ($children->sortBy("id") as $child)
                                    <option data-catid="{{ $child->id }}" data-catname="{{ $child->name }}" value="{{ $child->id }}">-- {{ $child->name }} ({{ $child->products_count }})</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <!-- <dl class="select_cat">
                        <dt data-select_cat=""><span>カテゴリを選ぶ</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></dt>
                        <dd>
                            <ul>
                                @foreach ($category_parents->sortBy("id") as $parent)
                                    @php
                                        $children = $category_children->where("parent_id", $parent->id);
                                        $sum = $children->sum("products_count");
                                    @endphp
                                    <li data-catid="{{ $parent->id }}"><span>{{ $parent->name}}</span> ({{ $sum }})</a></li>
                                    @foreach ($children->sortBy("id") as $child)
                                        <li data-catid="{{ $child->id }}">-- <span>{{ $child->name }}</span> ({{ $child->products_count }})</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </dd>
                    </dl> -->
                </div>
                <div class="right">
                    <div class="cp_ipselect cp_sl04">
                        <select class="select_point">
                            <option data-min_point="" data-max_point="" data-point_name="">ポイントで選ぶ</option>
                            <option data-min_point="1" data-max_point="1000" data-point_name="1〜1000">1〜1000</option>
                            <option data-min_point="1001" data-max_point="2000" data-point_name="1001〜2000">1001〜2000</option>
                            <option data-min_point="2001" data-max_point="100000" data-point_name="2001〜">2001〜</option>
                        </select>
                    </div>
                    <!-- <dl class="select_point">
                        <dt><span>ポイントで選ぶ</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></dt>
                        <dd>
                            <ul>
                                <li data-min_point="1" data-max_point="1000"><span>1〜1000</span></li>
                                <li data-min_point="1001" data-max_point="2000"><span>1001〜2000</span></li>
                                <li data-min_point="2001" data-max_point="100000"><span>2001〜</span></li>
                            </ul>
                        </dd>
                    </dl> -->
                </div>
            </div>
            @if ( Request::routeIs('campaign.top.catalog.gift.index') )
                <form class="word_search" action="/{{$campaign->id}}/list" method="get">
            @else
                <form class="word_search" action="/{{$campaign->id}}/dashboard/point/gift" method="get">
            @endif
                <input type="hidden" name="category_id" value="">
                <input type="hidden" name="category_name" value="">
                <input type="hidden" name="min_point" value="">
                <input type="hidden" name="max_point" value="">
                <input type="text" name="keyword" placeholder="キーワードで検索">
                <input class="search_btn" type="submit" value="">
            </form>
        </div>
            
        <ul class="lineup products">
            @foreach ($gifts as $gift)
                <li>
                    @if ( Request::routeIs('campaign.top.catalog.gift.index') )
                        <a href="{{ route('campaign.top.catalog.gift.show', [$campaign_id, $gift->id]) }}">
                    @else
                        <a href="{{ route('campaign.catalog.gift.show', [$campaign_id, $gift->id]) }}">
                    @endif
                        <div class="img"><img src="/uploads/{{$campaign->id}}/{{ $gift->product->supplier_id }}-{{ $gift->product->operation_id }}.jpg"></div>
                        <h4>{{ $gift->getProductName() }}</h4>
                        <div class="use_point">必要ポイント数：<span>{{ $gift->getPoint() }}</span>pts</div>
                        <div class="category"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg><span>{{ $gift->getCategoryName() }}</span></div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div id="pager">
            {{$gifts->appends(request()->query())->links()}}
        </div>
    </div>

@endsection