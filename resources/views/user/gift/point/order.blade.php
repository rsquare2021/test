@extends('layouts.user')

@section('content')
<h2 class="mypage_tit">景品交換 発送先の入力</h2>
    <div class="white mt-3">
        <div id="input_view">
            <attention><i class="fas fa-exclamation-triangle" style="margin-right:0.2rem;"></i>申し込みはまだ完了しておりません。</attention>
            <form action="{{ route('campaign.catalog.gift.apply.set_address', [$campaign_id, $gift->id]) }}" method="post" id="order_form">
                @csrf
                <!-- 入力画面 -->
                @if ($address_histories->isNotEmpty())
                    <div class="mt-3 mb-2">
                        <p>過去に使用した発送先（初回はこのブロックは表示しない）</p>
                        <select name="" id="used_address">
                            @foreach ($address_histories as $address)
                                <option value="" data-company_name="{{ $address->company_name }}" data-personal_name="{{ $address->personal_name }}" data-personal_name_kana="{{ $address->personal_name_kana }}" data-zip="{{ $address->post_code }}" data-pref="{{ $address->prefectures }}" data-add01="{{ $address->municipalities }}" data-add02="{{ $address->address_code }}" data-add03="{{ $address->building }}" data-tel="{{ $address->tel }}" data-delivery_time_id="{{ $address->delivery_time_id }}">{{ $address->getAddress() }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="flex around mt-3 mb-2">
                    <div class="input_group">
                        <p>会社名</p>
                        <input type="text" name="company_name" id="company_name" class="" value="{{ old('company_name', $default_address->company_name) }}" placeholder="会社名">
                        @error('company_name')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex around mb-2">
                    <div class="input_group">
                        <p>名前</p>
                        <input type="text" name="personal_name" id="personal_name" class="required" value="{{ old('personal_name', $default_address->personal_name) }}" placeholder="名前">
                        <p class="require_error">※必須項目です</p>
                        @error('personal_name')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex around mb-2">
                    <div class="input_group">
                        <p>フリガナ</p>
                        <input type="text" name="personal_name_kana" id="personal_name_kana" class="required kana" value="{{ old('personal_name_kana', $default_address->personal_name_kana) }}" placeholder="フリガナ">
                        <p class="require_error">※必須項目です</p>
                        <p class="kana_error">※全角カナで入力してください</p>
                        @error('personal_name_kana')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="bloc mb-2">
                    <p>郵便番号 (ハイフンあり)</p>
                    <input type="text" name="post_code" id="zip" class="required half" value="{{ old('post_code', $default_address->post_code) }}" placeholder="郵便番号 (ハイフンあり)">
                    <a class="ajaxzip3">検索</a>
                    <p class="require_error">※必須項目です</p>
                    <p class="half_error">※半角英数字で入力してください</p>
                    @error('post_code')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>都道府県</p>
                    <input type="text" name="prefectures" id="pref" class="required" value="{{ old('prefectures', $default_address->prefectures) }}" placeholder="都道府県">
                    <p class="require_error">※必須項目です</p>
                    @error('prefectures')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>市区町村</p>
                    <input type="text" name="municipalities" id="add01" class="required" value="{{ old('municipalities', $default_address->municipalities) }}" placeholder="市区町村">
                    <p class="require_error">※必須項目です</p>
                    @error('municipalities')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>町名・番地</p>
                    <input type="text" name="address_code" id="add02" class="required" value="{{ old('address_code', $default_address->address_code) }}" placeholder="町名・番地">
                    <p class="require_error">※必須項目です</p>
                    @error('address_code')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>建物名・号</p>
                    <input type="text" name="building" id="add03" value="{{ old('building', $default_address->building) }}" placeholder="建物名・号">
                    @error('building')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <p>電話番号 (ハイフンあり)</p>
                    <input type="text" name="tel" id="tel" class="required half" value="{{ old('tel', $default_address->tel) }}" placeholder="電話番号 (ハイフンあり)">
                    <p class="require_error">※必須項目です</p>
                    <p class="half_error">※半角英数字で入力してください</p>
                    @error('tel')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="bloc mb-2">
                    <fieldset class="question">
                        <p>普段よくご利用のお支払い方法をお選びください。</p>
                        <div>
                            <input type="checkbox" id="a1" name="a1" value="現金">
                            <label for="a1">現金</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a2" name="a2" value="ENEOSウイングカード">
                            <label for="a2">ENEOSウイングカード</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a3" name="a3" value="FCカード">
                            <label for="a3">FCカード</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a4" name="a4" value="ENEOSビジネスカード">
                            <label for="a4">ENEOSビジネスカード</label>
                        </div>
                        <div>
                            <input type="checkbox" id="a5" name="a5" value="その他">
                            <label for="a5">その他</label>
                        </div>
                        <div class="cf"></div>
                    </fieldset>
                    <p class="require_error check_require">※必須項目です</p>
                </div>
                <a  class="blue_btn mt-3 mb-3 confirm_btn">確認画面へ</a>
                <a href="javascript:history.back();" class="gray_btn mb-3">戻る</a>
            </div>

            <!-- 確認画面 -->
            <div id="confirm_view">
                <h3 class="text-center mt-3 mb-3 fz_16">景品の確認</h3>
                <!-- <attention>申し込みはまだ完了しておりません</attention> -->
                <p>以下の申し込み内容をご確認のうえ、よろしければお手続きを確定してください。</p>
                <div class="table_wrap">
                    <table class="blue_table">
                        <tr>
                            <th>景品名</th>
                            <td>
                                <span class="pro_name_disp" name="">{{ $product->name }}</span>
                            </td>
                        </tr>
                        <tr>
                        @if (!$gift->product->isGifteeBox())
                            <th>数量</th>
                            <td>
                                <span class="pro_amount_disp" name="">{{ $quantity }}</span>
                            </td>
                        @else
                            <th>金額</th>
                            <td>
                                <span class="pro_amount_disp" name="">{{ $gift->getGifteeBoxPrice($quantity) }}</span> <span>円分</span>
                            </td>
                        @endif
                        </tr>
                        <tr>
                            <th>種類</th>
                            <td>
                                <span class="pro_valiation_disp" name="">{{ $product->variation_name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>必要ポイント数</th>
                            <td><span class="total_use_point_disp">{{ $gift->point * $quantity }}</span>pts</td>
                        </tr>
                        <tr>
                            <th>保有ポイント数</th>
                            <td><span class="total_has_point_disp">{{ $point->remaining_point }}</span>pts</td>
                        </tr>
                        <tr>
                            <th>残りポイント数</th>
                            <td><span class="after_point_disp">{{ $point->remaining_point - $gift->point * $quantity }}</span>pts</td>
                        </tr>
                    </table>
                </div>
                <h3 class="text-center mt-3 mb-3 fz_16">発送先の確認</h3>
                <div class="flex around mt-3 mb-2">
                    <div class="input_group">
                        <p>会社名</p>
                        <span class="confirm_text conf_company_name"></span>
                    </div>
                </div>
                <div class="flex around mb-2">
                    <div class="input_group">
                        <p>名前</p>
                        <span class="confirm_text conf_personal_name"></span>
                    </div>
                </div>
                <div class="flex around mb-2">
                    <div class="input_group">
                        <p>フリガナ</p>
                        <span class="confirm_text conf_personal_name_kana"></span>
                    </div>
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
                <p class="mt-3">※デジタルギフトの有効期限は発行元によって異なります。詳しくは各社の公式ウェブサイトでご確認ください。</p>
                <input type="submit" class="yellow order_confirm_btn input_reset mb-3 mt-3" value="交換する">
                <a class="gray_btn back_btn mb-3">戻る</a>
            </div>
        </form>
    </div>

@endsection