@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <select class="form-control shop_name" id="shop_name">
                                    <option>ENEOS WING</option>
                                    <option>会社名</option>
                                </select>
                                <table id="zero-config" class="table table-hover shop_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>エリア名</th>
                                            <th class="no-content"></th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="area_id">1</td>
                                            <td class="area_name">東海</td>
                                            <td><button class="btn btn-outline-primary mb-2 area_edit_button" data-toggle="modal" data-target="#areaEditModal">編集</button></td>
                                        </tr>
                                        <tr>
                                            <td class="area_id">2</td>
                                            <td class="area_name">東北</td>
                                            <td><button class="btn btn-outline-primary mb-2 area_edit_button" data-toggle="modal" data-target="#areaEditModal">編集</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
<!-- モーダル -->
<div class="modal fade" id="areaEditModal" tabindex="-1" role="dialog" aria-labelledby="areaEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="areaEditModalLabel">編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p>注意して編集してください。</p>
                <table class="table">
                    <tr>
                        <td>エリア名</td>
                        <td><input id="shop_area" type="text" name="shop_area" class="form-control"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger shop_area_delete_btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 削除</button>
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 閉じる</button>
                <button type="button" class="btn btn-primary shop_area_edit_btn" id="">保存</button>
            </div>
        </div>
    </div>
</div>

@endsection