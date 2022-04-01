@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
            
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover preset_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>プリセット名</th>
                                            <th>登録店舗数</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="area_id">1</td>
                                            <td class="area_name">東海グループ</td>
                                            <td class="area_count">20</td>
                                            <td><a href="/test/admin/shop/preset/edit/?id=1" class="btn btn-outline-primary mb-2 preset_edit_button">編集</a></td>
                                        </tr>
                                        <tr>
                                            <td class="area_id">2</td>
                                            <td class="area_name">東北グループ</td>
                                            <td class="area_count">30</td>
                                            <td><a href="/test/admin/shop/preset/edit/?id=1" class="btn btn-outline-primary mb-2 preset_edit_button">編集</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection