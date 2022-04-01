@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form>
                                <h6>ベース会社</h6>
                                <select class="form-control shop_name mb-4" id="shop_name">
                                    <option>ENEOS WING</option>
                                    <option>会社名</option>
                                </select>
                                <h6>エリア名</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                        <input id="shop_area" type="text" name="shop_area" class="form-control">
                                    </div>
                                </div>
                                <input type="submit" name="shop_create_btn" class="btn btn-primary shop_area_create_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
@endsection