@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <p>チェックを有効にすると、発送先情報に切り替わります。</p>
                            <label class="switch s-icons s-outline s-outline-primary mr-2">
                                <input type="checkbox" id="check">
                                <span class="slider round"></span>
                            </label>
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="all">ID</th>
                                            <th class="all">景品ID</th>
                                            <th>ユーザー名</th>
                                            <th>応募日時</th>
                                            <th>応募コース</th>
                                            <th>消費ポイント</th>
                                            <th>当落判定</th>
                                            <th>処理ステータス</th>
                                            <th class="deli">発送先名</th>
                                            <th class="deli">発送先郵便番号</th>
                                            <th class="deli">発送先住所1</th>
                                            <th class="deli">発送先住所2</th>
                                            <th class="deli">発送先住所3</th>
                                            <th class="deli">発送先電話番号</th>
                                            <th class="deli">配達希望時間帯</th>
                                            <th class="no-content all"></th>
                                            <th class="no-content all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="pro_id all">1</td>
                                            <td class="pro_name all">1234 掃除機</td>
                                            <td class="pro_open">5678</td>
                                            <td class="pro_start">2021-09-25 00:00:00</td>
                                            <td class="pro_end">2</td>
                                            <td class="pro_end">20</td>
                                            <td class="pro_start">2021-09-25 00:00:00</td>
                                            <td class="pro_end">配送済み</td>
                                            <td class="deli">発送先名</td>
                                            <td class="deli">発送先郵便番号</td>
                                            <td class="deli">発送先住所1</td>
                                            <td class="deli">発送先住所2</td>
                                            <td class="deli">発送先住所3</td>
                                            <td class="deli">発送先電話番号</td>
                                            <td class="deli">配達希望時間帯</td>
                                            <td class="all"><a href="/test/admin/project/edit?id=1" class="btn btn-outline-primary mb-2 pro_edit_btn">編集</a></td>
                                            <td class="all">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection