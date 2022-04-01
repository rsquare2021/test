@extends('layouts.app')

@section('content')
<input type="hidden" id="tab_count" value="0">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <ul class="nav nav-tabs mb-3 mt-3" id="simpletab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="c1-tab" data-toggle="tab" href="#c1">Aコース</a><a class="course_delete bs-tooltip" title="コース削除"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="course_add">＋</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="simpletabContent">
                                <div class="tab-pane fade show active" id="c1">
                                    <div class="dup_bloc">
                                        <table class="table">
                                            <tr>
                                                <td>コース名</td>
                                                <td><input type="text" class="form-control course_name" data-name_id="c1" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>交換ルール</td>
                                                <td>
                                                    <select class="form-control user_company">
                                                        <option>選択してください</option>
                                                        <option>交換ルール1</option>
                                                        <option>交換ルール2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>必要ポイント</td>
                                                <td><input type="text" class="form-control" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>当選確率</td>
                                                <td><input type="text" class="form-control" name=""></td>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a id="course_submit" class="btn btn-primary">送信</a>
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
                        <tr id="pro1">
                            <td class="pro_name">景品1</td>
                            <td class="pro_cat" data-cat="2">カテゴリー</td>
                            <td class="pro_zaiko">1000</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="pro_check1" class="custom-control-input yet" data-id="1">
                                    <label class="custom-control-label" for="pro_check1"></label>
                                </div>
                            </td>
                        </tr>
                        <tr id="pro2">
                            <td class="pro_name">景品2</td>
                            <td class="pro_cat" data-cat="2">カテゴリー</td>
                            <td class="pro_zaiko">1000</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="pro_check2" class="custom-control-input yet" data-id="2">
                                    <label class="custom-control-label" for="pro_check2"></label>
                                </div>
                            </td>
                        </tr>
                        <tr id="pro3">
                            <td class="pro_name">景品3</td>
                            <td class="pro_cat" data-cat="2">カテゴリー</td>
                            <td class="pro_zaiko">1000</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="pro_check3" class="custom-control-input yet" data-id="3">
                                    <label class="custom-control-label" for="pro_check3"></label>
                                </div>
                            </td>
                        </tr>
                        <tr id="pro4">
                            <td class="pro_name">景品4</td>
                            <td class="pro_cat" data-cat="2">カテゴリー</td>
                            <td class="pro_zaiko">1000</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="pro_check4" class="custom-control-input yet" data-id="4">
                                    <label class="custom-control-label" for="pro_check4"></label>
                                </div>
                            </td>
                        </tr>
                        <tr id="pro5">
                            <td class="pro_name">景品5</td>
                            <td class="pro_cat" data-cat="2">カテゴリー</td>
                            <td class="pro_zaiko">1000</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="pro_check5" class="custom-control-input yet" data-id="5">
                                    <label class="custom-control-label" for="pro_check5"></label>
                                </div>
                            </td>
                        </tr>
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