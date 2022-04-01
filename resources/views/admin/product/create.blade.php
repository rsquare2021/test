@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="åtable-responsive mb-4 mt-4">
                            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h6>景品名</h6>
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control product_name" name="name" placeholder="景品名" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <h6>景品カテゴリー</h6>
                                @error('product_category_id')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <select class="form-control user_company" name="product_category_id">
                                            <option value="">選択してください</option>
                                            @foreach ($product_categories as $category)
                                                <optgroup label="{{ $category->name }}">
                                                    @forelse ($category->children as $child)
                                                        <option value="{{ $child->id }}" @if($child->id == old('product_category_id')) selected @endif>{{ $child->name }}</option>
                                                    @empty
                                                        <option value="{{ $category->id }}" @if($category->id == old('product_category_id')) selected @endif>{{ $category->name }}</option>
                                                    @endforelse
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <h6>必要ポイント数</h6>
                                @error('catalog_basic_point')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="catalog_basic_point" placeholder="半角数字" value="{{ old('catalog_basic_point') }}">
                                    </div>
                                </div>
                                <h6>当選本数</h6>
                                @error('basic_win_limit')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="basic_win_limit" placeholder="半角数字" value="{{ old('basic_win_limit') }}">
                                    </div>
                                </div>
                                <h6>メーカー・ブランド</h6>
                                @error('maker_name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="maker_name" placeholder="半角数字" value="{{ old('maker_name') }}">
                                    </div>
                                </div>
                                <h6>メーカーURL</h6>
                                @error('maker_url')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control" rows="2" name="maker_url">{{ old('maker_url') }}</textarea>
                                    </div>
                                </div>
                                <h6>詳細１</h6>
                                @error('description_1')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control" rows="5" name="description_1">{{ old('description_1') }}</textarea>
                                    </div>
                                </div>
                                <h6>詳細２</h6>
                                @error('description_2')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control" rows="5" name="description_2">{{ old('description_2') }}</textarea>
                                    </div>
                                </div>
                                <h6>注釈</h6>
                                @error('notice')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control" rows="4" name="notice">{{ old('notice') }}</textarea>
                                    </div>
                                </div>
                                <h6>サプライヤー</h6>
                                @error('supplier_id')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <select class="form-control" name="supplier_id">
                                            <option value="">選択してください</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}" @if($supplier->id == old('supplier_id')) selected @endif>{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <h6>管理番号</h6>
                                @error('operation_id')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col company_wrap">
                                        <input type="text" class="form-control" name="operation_id" placeholder="半角英数字と-" value="{{ old('operation_id') }}">
                                    </div>
                                </div>
                                <h6>バリエーション設定</h6>
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="zero-config" class="table table-hover variation_list" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>バリエーション名</th>
                                                <th>管理番号</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('variations', []) as $i => $variation)
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        @error("variations.$i.variation_name")
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                        <input type="text" name="variations[{{ $i }}][variation_name]" value="{{ $variation['variation_name'] }}" placeholder="バリエーション名">
                                                    </td>
                                                    <td>
                                                        @error("variations.$i.operation_id")
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                        <input type="text" name="variations[{{ $i }}][operation_id]" value="{{ $variation['operation_id'] }}" placeholder="管理番号">
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-primary mb-2 delete_variation">削除</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <a href="#" class="btn btn-secondaly add_variation">追加</a>
                                </div>
                                <h6>画像設定</h6>
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="zero-config" class="table table-hover image_list" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ファイル名</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('images', []) as $i => $image)
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        @error("images.$i.image_file")
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                        <input type="file" name="images[{{ $i }}][image_file]">
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-primary mb-2 delete_image">削除</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <a href="#" class="btn btn-secondaly add_image">追加</a>
                                </div>
                                <input type="submit" name="product_create_btn" class="btn btn-primary product_create_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection


@section('local_script')
<script>
$(function() {
    $variation_list = $(".variation_list tbody");
    variation_item_index = $variation_list.children().length;
    $image_list = $(".image_list tbody");
    image_item_index = $image_list.children().length;
});
$(".add_variation").on("click", function(e) {
    e.preventDefault();
    const index = variation_item_index++;
    $variation_list.append(`
        <tr>
            <td></td>
            <td><input type="text" name="variations[${index}][variation_name]" value="" placeholder="バリエーション名"></td>
            <td><input type="text" name="variations[${index}][operation_id]" value="" placeholder="管理番号"></td>
            <td>
                <a href="#" class="btn btn-outline-primary mb-2 delete_variation">削除</a>
            </td>
        </tr>
    `);
});
$(".add_image").on("click", function(e) {
    e.preventDefault();
    const index = image_item_index++;
    $image_list.append(`
        <tr>
            <td></td>
            <td><input type="file" name="images[${index}][image_file]"></td>
            <td>
                <a href="#" class="btn btn-outline-primary mb-2 delete_image">削除</a>
            </td>
        </tr>
    `);
});
$(document).on("click", ".delete_variation, .delete_image", function(e) {
    e.preventDefault();
    $(this).parents("tr").remove();
});
</script>
@endsection