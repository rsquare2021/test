@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form>
                                <h6>ユーザー名</h6>
                                <div class="row mb-4">
                                    <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing user_shop_target">
                                        <h6>店舗一覧</h6>
                                        <select class="form-control" id="shop_preset">
                                            <option>プリセット選択</option>
                                            <option>東海</option>
                                            <option>東北</option>
                                        </select>
                                        <div class="table-responsive mb-4 mt-4">
                                            <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>店舗名</th>
                                                        <th>店舗エリア</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="customCheck4">
                                                        <td>4</td>
                                                        <td>店舗4</td>
                                                        <td>東海</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input user_shop_target_check" id="customCheck4">
                                                                <label class="custom-control-label" for="customCheck4"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="customCheck5">
                                                        <td>5</td>
                                                        <td>店舗5</td>
                                                        <td>東海</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input user_shop_target_check" id="customCheck5">
                                                                <label class="custom-control-label" for="customCheck5"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="customCheck6">
                                                        <td>6</td>
                                                        <td>店舗6</td>
                                                        <td>東北</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input user_shop_target_check" id="customCheck6">
                                                                <label class="custom-control-label" for="customCheck6"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="user_shop_add_btn mb-4 mt-4">
                                            <div class="btn btn-outline-primary mb-2 user_shop_add">追加</div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing user_shop_list">
                                        <h6>登録店舗</h6>
                                        <div class="table-responsive mb-4 mt-4">
                                            <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>店舗名</th>
                                                        <th>店舗エリア</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="customCheck1">
                                                        <td>1</td>
                                                        <td>店舗1</td>
                                                        <td>東海</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                <label class="custom-control-label" for="customCheck1"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="customCheck2">
                                                        <td>2</td>
                                                        <td>店舗2</td>
                                                        <td>東海</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                                <label class="custom-control-label" for="customCheck2"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="customCheck3">
                                                        <td>3</td>
                                                        <td>店舗3</td>
                                                        <td>東北</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                                <label class="custom-control-label" for="customCheck3"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="user_shop_remove_btn mb-4 mt-4">
                                            <div class="btn btn-outline-warning mb-2 user_shop_remove">取消</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="shop_create_btn" class="btn btn-primary shop_preset_create_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
@endsection