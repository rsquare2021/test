@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">景品交換履歴 発送先変更</h2>
<div class="white mt-3">
        <div id="input_view">
            <!-- <h3 class="text-center mt-3 mb-3 fz_16">発送先の変更</h3> -->
            <form action="{{ route('campaign.apply.address.update', [$campaign_id, $apply->id]) }}" method="post" id="order_form">
                @csrf
                @method("put")
                @include('kano.show_error_all')
                <!-- 入力画面 -->
                <div class="flex around mt-3 mb-2">
                    <div class="input_group">
                        <p>会社名・フリガナ</p>
                        <input type="text" name="last_name" id="name01" class="required" value="{{ old('last_name', $address->last_name) }}">
                        <p class="require_error">※必須項目です</p>
                        @error('last_name')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- <div class="input_group">
                        <p>名</p>
                        <input type="text" name="first_name" id="name02" class="required" value="{{ old('first_name', $address->first_name) }}">
                        <p class="require_error">※必須項目です</p>
                        @error('first_name')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div> -->
                </div>
                <div class="flex around mb-2">
                    <div class="input_group">
                        <p>フリガナ</p>
                        <input type="text" name="last_name_kana" id="kana01" class="required kana" value="{{ old('last_name_kana', $address->last_name_kana) }}">
                        <p class="require_error">※必須項目です</p>
                        <p class="kana_error">※全角カナで入力してください</p>
                        @error('last_name_kana')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- <div class="input_group">
                        <p>メイ</p>
                        <input type="text" name="first_name_kana" id="kana02" class="required kana" value="{{ old('first_name_kana', $address->first_name_kana) }}">
                        <p class="require_error">※必須項目です</p>
                        <p class="kana_error">※全角カナで入力してください</p>
                        @error('first_name_kana')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div> -->
                </div>
                <div class="bloc mb-2">
                    <p>郵便番号</p>
                    <input type="text" name="post_code" id="zip" class="required half" value="{{ old('post_code', $address->post_code) }}">
                    <a class="ajaxzip3">検索</a>
                    <p class="require_error">※必須項目です</p>
                    <p class="half_error">※半角英数字で入力してください</p>
                    @error('post_code')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>都道府県</p>
                    <input type="text" name="prefectures" id="pref" class="required" value="{{ old('prefectures', $address->prefectures) }}">
                    <p class="require_error">※必須項目です</p>
                    @error('prefectures')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>市区町村</p>
                    <input type="text" name="municipalities" id="add01" class="required" value="{{ old('municipalities', $address->municipalities) }}">
                    <p class="require_error">※必須項目です</p>
                    @error('municipalities')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>町名・番地</p>
                    <input type="text" name="address_code" id="add02" class="required" value="{{ old('address_code', $address->address_code) }}">
                    <p class="require_error">※必須項目です</p>
                    @error('address_code')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>建物名・号</p>
                    <input type="text" name="building" id="add03" value="{{ old('building', $address->building) }}">
                    @error('building')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>電話番号</p>
                    <input type="text" name="tel" id="tel" class="required half" value="{{ old('tel', $address->tel) }}">
                    <p class="require_error">※必須項目です</p>
                    <p class="half_error">※半角英数字で入力してください</p>
                    @error('tel')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2" style="display:none;">
                    <p>配送希望時間</p>
                    <select name="delivery_time_id" id="delivery_time">
                        @foreach($deliveries as $delivery)
                            @if ($delivery->id === $address->delivery_time_id)
                                <option value="{{ $delivery->id }}" selected="selected">{{ $delivery->name }}</option>
                            @else
                                <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('delivery_time_id')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <a  class="blue_btn mt-3 mb-3 confirm_btn">確認画面へ</a>
                <a href="javascript:history.back();" class="gray_btn mb-3">戻る</a>
            </div>

            <!-- 確認画面 -->
            <div id="confirm_view">
                <h3 class="text-center mt-3 mb-3 fz_16">景品の確認</h3>
                <p c>以下の申し込み内容をご確認のうえ、よろしければお手続きを確定してください。</p>
                <div class="table_wrap">
                    <table class="blue_table">
                        <tr>
                            <th>景品名</th>
                            <td>
                                <span class="pro_name_disp" name="">{{ $apply->product->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>数量</th>
                            <td>
                                <span class="pro_amount_disp" name="">{{ $apply->quantity }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>種類</th>
                            <td>
                                <span class="pro_valiation_disp" name="">{{ $apply->product->variation_name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>消費ポイント数</th>
                            <td><span class="total_use_point_disp">{{ $apply->getTotalPoint() }}</span>pts</td>
                        </tr>
                    </table>
                </div>
                <h3 class="text-center mt-3 mb-3 fz_16">発送先の確認</h3>
                <div class="flex around mt-3 mb-2">
                    <div class="input_group">
                        <p>会社名・名前</p>
                        <span class="confirm_text conf_name01"></span>
                    </div>
                    <!-- <div class="input_group">
                        <p>名</p>
                        <span class="confirm_text conf_name02"></span>
                    </div> -->
                </div>
                <div class="flex around mb-2">
                    <div class="input_group">
                        <p>フリガナ</p>
                        <span class="confirm_text conf_kana01"></span>
                    </div>
                    <!-- <div class="input_group">
                        <p>メイ</p>
                        <span class="confirm_text conf_kana02"></span>
                    </div> -->
                </div>
                <div class="bloc mb-2">
                    <p>郵便番号</p>
                    <span class="confirm_text conf_zip"></span>
                </div>
                <div class="bloc mb-2">
                    <p>都道府県</p>
                    <span class="confirm_text conf_pref"></span>
                </div>
                <div class="bloc mb-2">
                    <p>市区町村</p>
                    <span class="confirm_text conf_add01"></span>
                </div>
                <div class="bloc mb-2">
                    <p>町名・番地</p>
                    <span class="confirm_text conf_add02"></span>
                </div>
                <div class="bloc mb-2">
                    <p>建物名・号</p>
                    <span class="confirm_text conf_add03"></span>
                </div>
                <div class="bloc mb-2">
                    <p>電話番号</p>
                    <span class="confirm_text conf_tel"></span>
                </div>
                <div class="bloc mb-2" style="display:none;">
                    <p>配送希望時間</p>
                    <span class="confirm_text conf_delivery_time"></span>
                </div>  
                <p class="mt-3">※デジタルギフトの有効期限は発行元によって異なります。詳しくは各社の公式ウェブサイトでご確認ください。</p>
                <input type="submit" class="yellow order_confirm_btn input_reset mb-3 mt-3" value="変更する">
                <a class="gray_btn back_btn mb-3">戻る</a>
            </div>
        </form>
    </div>

@endsection