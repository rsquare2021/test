@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover shop_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>店舗名</th>
                                            <th>所属会社名</th>
                                            <th>支社名</th>
                                            <th>店舗エリア</th>
                                            <th>営業フラグ</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="shop_id">1</td>
                                            <td class="shop_name">ENEOS豊橋</td>
                                            <td class="shop_company">ENEOS WING</td>
                                            <td class="shop_sub_company">東海支社</td>
                                            <td class="shop_area">東海</td>
                                            <td class="shop_flag">営業中</td>
                                            <td><a href="/test/admin/shop/edit/?id=1" class="btn btn-outline-primary mb-2 shop_edit_button">編集</a></td>
                                        </tr>
                                        <tr>
                                            <td class="shop_id">2</td>
                                            <td class="shop_name">ENEOS名古屋</td>
                                            <td class="shop_company">ENEOS WING</td>
                                            <td class="shop_sub_company">東海支社</td>
                                            <td class="shop_area">東海</td>
                                            <td class="shop_flag">営業中</td>
                                            <td><a href="/test/admin/shop/edit/?id=2" class="btn btn-outline-primary mb-2 shop_edit_button">編集</a></td>
                                        </tr>
                                        <tr>
                                            <td class="shop_id">2</td>
                                            <td class="shop_name">ENEOS東海</td>
                                            <td class="shop_company">ENEOS WING</td>
                                            <td class="shop_sub_company">東海支社</td>
                                            <td class="shop_area">東海</td>
                                            <td class="shop_flag">休業中</td>
                                            <td><a href="/test/admin/shop/edit/?id=3" class="btn btn-outline-primary mb-2 shop_edit_button">編集</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection