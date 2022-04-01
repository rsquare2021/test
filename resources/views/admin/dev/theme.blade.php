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
                                            <th>テーマカラー名</th>
                                            <th>カラーコード</th>
                                            <th class="no-content"></th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="theme_id">1</td>
                                            <td class="theme_color">テーマカラー1</td>
                                            <td class="color_code">カラーコード</td>
                                            <td><button class="btn btn-outline-primary mb-2 theme_edit_button" data-toggle="modal" data-target="#editModal">編集</button></td>
                                        </tr>
                                        <tr>
                                            <td class="theme_id">2</td>
                                            <td class="theme_color">テーマカラー2</td>
                                            <td class="color_code">カラーコード</td>
                                            <td><button class="btn btn-outline-primary mb-2 theme_edit_button" data-toggle="modal" data-target="#editModal">編集</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
<!-- モーダル -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p>注意して編集してください。</p>
                <table class="table">
                    <tr>
                        <td>テーマカラー名</td>
                        <td><input type="text" class="form-control theme_name" name="theme_name" placeholder="テーマカラー名"></td>
                    </tr>
                    <tr>
                        <td>カラーコード</td>
                        <td><input type="text" class="form-control color_code" name="color_code" placeholder="カラーコード"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger theme_delete_btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 削除</button>
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 閉じる</button>
                <button type="button" class="btn btn-primary theme_edit_btn" id="">保存</button>
            </div>
        </div>
    </div>
</div>

@endsection