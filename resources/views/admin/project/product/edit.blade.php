@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>景品名</th>
                                            <th>景品カテゴリー</th>
                                            <th>ポイントカテゴリー</th>
                                            <th>必要ポイント</th>
                                            <th>当選本数</th>
                                            <th>当選確率</th>
                                            <th>店頭交換</th>
                                            <th>Wチャンス</th>
                                            <th class="no-content"></th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="pro_id">1</td>
                                            <td class="pro_name"><input type="text" class="form-control" name=""></td>
                                            <td class="pro_open">
                                                <select class="form-control" name="">
                                                    <option>選択してください</option>
                                                    <option>カテゴリー1</option>
                                                    <option>カテゴリー2</option>
                                                </select>
                                            </td>
                                            <td class="pro_open">
                                                <select class="form-control user_company" name="">
                                                    <option>選択してください</option>
                                                    <option>カテゴリー1</option>
                                                    <option>カテゴリー2</option>
                                                </select>
                                            </td>
                                            <td class="pro_open"><input type="text" class="form-control" name=""></td>
                                            <td class="pro_open"><input type="text" class="form-control" name=""></td>
                                            <td class="pro_open"><input type="text" class="form-control" name=""></td>
                                            <td class="pro_open">
                                                <select class="form-control user_company">
                                                    <option>選択してください</option>
                                                    <option>可</option>
                                                    <option>不可</option>
                                                </select>
                                            </td>
                                            <td class="pro_open">
                                                <select class="form-control user_company">
                                                    <option>選択してください</option>
                                                    <option>あり</option>
                                                    <option>なし</option>
                                                </select>
                                            </td>
                                            <td><a href="/test/admin/product/edit?id=1" class="btn btn-outline-danger mb-2 pro_delete_btn">削除</a></td>
                                            <td><a href="/test/admin/product/edit?id=1" class="btn btn-outline-primary mb-2 pro_edit_btn">編集</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="submit" name="product_create_btn" class="btn btn-primary product_create_btn">
                        </div>
                    </div>

                </div>

            </div>

@endsection