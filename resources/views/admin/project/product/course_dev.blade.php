@extends('layouts.app')

@section('content')
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <ul class="nav nav-tabs mb-3 mt-3" id="simpletab" role="tablist">
                                @foreach (old('courses', $courses) as $course)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif" id="c{{ $loop->index }}-tab" data-toggle="tab" href="#c{{ $loop->index }}">{{ $course['name'] }}</a><a class="course_delete bs-tooltip" title="コース削除"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" id="course_add">＋</a>
                                </li>
                            </ul>
                            <form action="{{ route('admin.project.product.update.lottery', $campaign_id) }}" method="post">
                                @csrf
                                @method("put")
                                <div class="tab-content" id="simpletabContent">
                                    @foreach (old('courses', $courses) as $course)
                                        @php
                                            $name = "courses[$loop->index]";
                                            $dot = "courses.$loop->index.";
                                            $tab_count = $loop->count;
                                        @endphp
                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="c{{ $loop->index }}" data-index="{{ $loop->index }}">
                                            <div class="dup_bloc">
                                                <input type="hidden" name="{{ $name }}[id]" value="{{ $course['id'] }}">
                                                <table class="table">
                                                    <tr>
                                                        <td>コース名</td>
                                                        @error($dot.'name')
                                                            <p>{{ $message }}</p>
                                                        @enderror
                                                        <td><input type="text" class="form-control course_name" data-name_id="c{{ $loop->index }}" name="{{ $name }}[name]" value="{{ $course['name'] }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>交換ルール</td>
                                                        <td>
                                                            <input type="hidden" name="{{ $name }}[lottery_type_id]" value="2">
                                                            <select class="form-control user_company">
                                                                <option>選択してください</option>
                                                                <option>交換ルール1</option>
                                                                <option>交換ルール2</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>必要ポイント</td>
                                                        <td><input type="text" class="form-control" name="{{ $name }}[point]" value="{{ $course['point'] }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>当選確率</td>
                                                        <td><input type="text" class="form-control" name="{{ $name }}[win_rate]" value="{{ $course['win_rate'] }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wアップ</td>
                                                        <td>
                                                            <select class="form-control user_company">
                                                                <option>選択してください</option>
                                                                <option>あり</option>
                                                                <option>なし</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="product_list">
                                                    <a class="btn btn-primary mb-4 product_search">景品追加</a>
                                                    <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>景品名</th>
                                                                <th>景品カテゴリー</th>
                                                                <th>当選本数</th>
                                                                <th class="no-content"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($course["products"] ?? [] as $child)
                                                                @php
                                                                    $product = $child["product"];
                                                                @endphp
                                                                <tr id="pro_list{{ $product['id'] }}" data-id="{{ $product['id'] }}">
                                                                    <td class="pro_name">{{ $product['name'] }}</td>
                                                                    <td class="pro_cat">
                                                                        <select class="form-control" name="">
                                                                            <option value="">選択してください</option>
                                                                            <option value="1">カテゴリー1</option>
                                                                            <option value="2">カテゴリー2</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="pro_zaiko">
                                                                        <input type="text" class="form-control" name="{{ $name }}[products][{{ $product['id'] }}][win_limit]" value="{{ $child['win_limit'] }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="{{ $name }}[products][{{ $product['id'] }}][id]" value="{{ $child['id'] }}">
                                                                        <input type="hidden" name="{{ $name }}[products][{{ $product['id'] }}][product][id]" value="{{ $product['id'] }}">
                                                                        <input type="hidden" name="{{ $name }}[products][{{ $product['id'] }}][product][name]" value="{{ $product['name'] }}">
                                                                        <a class="btn btn-outline-danger mb-2 pro_delete_btn">削除</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-primary">送信</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
<input type="hidden" id="tab_count" value="{{ $tab_count }}">

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
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 閉じる</button>
                <button class="btn btn-danger course_delete_btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 削除</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">景品</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="parent" value="">
                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                    <thead>
                        <tr>
                            <th>景品名</th>
                            <th>景品カテゴリー</th>
                            <th>当選本数</th>
                            <th class="no-content"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr id="pro{{ $product['id'] }}">
                                <td class="pro_name">{{ $product['name'] }}</td>
                                <td class="pro_cat" data-cat="2">カテゴリー</td>
                                <td class="pro_zaiko">9999</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="pro_check{{ $product['id'] }}" class="custom-control-input yet" data-id="{{ $product['id'] }}">
                                        <label class="custom-control-label" for="pro_check{{ $product['id'] }}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 閉じる</button>
                <button class="btn btn-primary pro_listup_btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 編集</button>
            </div>
        </div>
    </div>
</div>

@endsection