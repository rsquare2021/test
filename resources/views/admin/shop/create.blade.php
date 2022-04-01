@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form>
                                <h6>店舗名</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="shop_name" placeholder="店舗名">
                                    </div>
                                </div>
                                <h6>店舗エリア</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                    <select class="form-control" id="shop_area">
                                        <option>選択してください</option>
                                        <option>東海</option>
                                        <option>東北</option>
                                    </select>
                                    </div>
                                </div>
                                <h6>営業フラグ</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                    <select class="form-control" id="shop_edit_flag">
                                        <option>選択してください</option>
                                        <option>営業中</option>
                                        <option>休業中</option>
                                        <option>閉店</option>
                                    </select>
                                    </div>
                                </div>
                                <h6>所属会社</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                    <select class="form-control" id="shop_edit_company">
                                        <option>選択してください</option>
                                        <option>ENEOS WING</option>
                                    </select>
                                    </div>
                                </div>
                                <h6>支社</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                    <select class="form-control" id="shop_edit_company">
                                        <option>選択してください</option>
                                        <option>ENEOS WING</option>
                                    </select>
                                    </div>
                                </div>
                                <input type="submit" name="shop_create_btn" class="btn btn-primary shop_create_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
@endsection