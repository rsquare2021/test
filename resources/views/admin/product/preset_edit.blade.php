@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form>
                                <h6>プリセット名</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                        東海グループ
                                    </div>
                                </div>
                                <h6>店舗一覧</h6>
                                <div class="row mb-4">
                                    <div class="col">
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
                                                    <tr>
                                                        <td>1</td>
                                                        <td>店舗1</td>
                                                        <td>東海</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                                                <label class="custom-control-label" for="customCheck1"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>店舗2</td>
                                                        <td>東海</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck2" checked>
                                                                <label class="custom-control-label" for="customCheck2"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
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