@extends('layouts.app')

@section('content')
<input type="hidden" id="tab_count" value="0">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <form action="{{ route('admin.project.product.update.catalog', $campaign_id) }}" method="post" id="gift_form">
                                @csrf
                                @method("put")
                                <p>商品ソート用パーツが入ります</p>
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>景品名</th>
                                            <th>景品カテゴリー</th>
                                            <th>交換ポイント数</th>
                                            <th>受取方法</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        @php
                                            // $index = $loop->index;
                                            // $gift = $gifts->firstWhere("product_id", $product->id);
                                            $gift = $gifts_saved_session->get($product->id);
                                            if(!$gift) {
                                                $gift = $product->campaign_products->first();
                                                if($gift) $gift["is_checked"] = "on";
                                            }
                                            $index = $product->id;
                                            $name_dot = "gifts.$index.";
                                            $name_arr = "gifts[$index]";
                                        @endphp
                                            <tr id="pro{{ $index }}">
                                                <td class="pro_name">{{ $product->name }}</td>
                                                <td class="pro_cat" data-cat="{{ $product->product_category->id }}">{{ $product->product_category->name }}</td>
                                                <td class="pro_zaiko">
                                                    @error($name_dot."point")
                                                        <p class="alert alert-danger">{{ $message }}</p>
                                                    @enderror
                                                    <input type="text" class="form-control" name="{{ $name_arr }}[point]" value="{{ old($name_dot.'point', $gift ? $gift["point"] : $product->catalog_basic_point) }}">
                                                </td>
                                                <td>
                                                    @error($name_dot."gift_delivery_method_id")
                                                        <p class="alert alert-danger">{{ $message }}</p>
                                                    @enderror
                                                    <select name="{{ $name_arr }}[gift_delivery_method_id]">
                                                        @foreach ($delivery_methods as $method)
                                                            @php
                                                                $is_selected = (old($name_dot."gift_delivery_method_id", $gift ? $gift["gift_delivery_method_id"] : null) ?? 2) == $method->id;
                                                            @endphp
                                                            <option value="{{ $method->id }}" @if($is_selected) selected @endif>{{ $method->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="hidden" name="{{ $name_arr }}[product_id]" value="{{ $product->id }}">
                                                        <input type="hidden" name="{{ $name_arr }}[id]" value="{{ $gift ? $gift["id"] : '' }}">
                                                        <input type="checkbox" id="pro_check{{ $index }}" class="custom-control-input yet" data-id="{{ $index }}" name="{{ $name_arr }}[is_checked]" @if(old($name_dot.'is_checked', $gift ? $gift["is_checked"] : false)) checked @endif>
                                                        <label class="custom-control-label" for="pro_check{{ $index }}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links("vendor.pagination.save_content", ["form_id" => "gift_form"]) }}
                                <button id="course_submit" class="btn btn-primary">送信</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

@endsection