@extends('layouts.app')

@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
                    <p>編集モード</p>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input type="checkbox" id="edit_mode" checked="">
                        <span class="slider round"></span>
                    </label>
                    <form action="{{ route('admin.shop_tree.update', $root->id) }}" method="post">
                        @csrf
                        @method("put")
                        <div>
                            <p>ツリー名</p>
                            @error('top_name')
                                <p>{{ $message }}</p>
                            @enderror
                            <input type="text" name="top_name" class="form-control mb-4" value="{{ old('top_name', $root->name) }}">
                        </div>
                        <div id="myUL">
                            <span class="caret">ツリー構造<a class="shop_add_btn cmd_add_office">+ 支社追加</a></span>
                            @error('children')
                                <p>{{ $message }}</p>
                            @enderror
                            <ul>
                                @foreach (old('children', $root["children"]) as $child)
                                    <li data-office={{ $loop->index }}>
                                        @php
                                            $depth_crumbs[$loop->depth] = $loop->index;
                                        @endphp
                                        @include('admin.shop_tree.edit_sub', ["element" => $child, "name" => "children[$loop->index]", "dot" => "children.$loop->index.", "depth_crumbs" => $depth_crumbs])
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <button class="btn btn-primary">登録</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- モーダル -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">削除</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p>削除文言</p>
                <input type="hidden" id="delete_target" value="">
                <input type="hidden" id="delete_target_area" value="">
                <input type="hidden" id="delete_target_shop" value="">
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 閉じる</button>
                <button class="btn btn-danger shop_delete_btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 削除</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script>
$(document).on("click", ".cmd_add_office", function(e) {
    e.preventDefault();
    let $ul = $(this).parent().siblings("ul");
    let index = $ul.children().length;
    $ul.prepend(`
        <li data-office="${index}">
            <span class="caret"><input type="text" name="children[${index}][name]"><a class="shop_add_btn cmd_add_area">+ エリア追加</a><a class="shisha_delete delete_btn">- 削除</a></span>
            <input type="hidden" name="children[${index}][id]">
            <ul>
            </ul>
        </li>
    `);
});
$(document).on("click", ".cmd_add_area", function(e) {
    e.preventDefault();
    let $ul = $(this).parent().siblings("ul");
    let index = $ul.children().length;
    let office = $(this).parents("li").data("office");
    $ul.prepend(`
        <li data-office="${office}" data-area="${index}">
            <span class="caret"><input type="text" name="children[${office}][children][${index}][name]"><a href="#" class="cmd_add_shop">+ 店舗追加</a><a class="area_delete delete_btn">- 削除</a></span>
            <input type="hidden" name="children[${office}][children][${index}][id]">
            <ul>
            </ul>
        </li>
    `);
});
$(document).on("click", ".cmd_add_shop", function(e) {
    e.preventDefault();
    let $ul = $(this).parent().siblings("ul");
    let index = $ul.children().length;
    let office = $(this).parents("li").data("office");
    let area = $(this).parents("li").data("area");
    $ul.prepend(`
        <li>
            <span class="caret"><input type="text" name="children[${office}][children][${area}][children][${index}][name]"><a class="shop_delete delete_btn">- 削除</a></span>
            <input type="hidden" name="children[${office}][children][${area}][children][${index}][id]">
        </li>
    `);
});
</script>