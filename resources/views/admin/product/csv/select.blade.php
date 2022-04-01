@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="åtable-responsive mb-4 mt-4">
                            <form action="{{ route('admin.project.download_select_shipping_csv') }}" method="get">
                                @csrf
                                @if (session('flash_message'))
                                    <div class="flash_message">
                                        <p>{{ session('flash_message') }}</p>
                                    </div>
                                @endif
                                <div class="flex">
                                    <input type="text" class="form-control datepicker" id="csv_startdate" name="csv_startdate" value="" placeholder="開始日">〜
                                    <input type="text" class="form-control datepicker" id="csv_enddate" name="csv_enddate" value="" placeholder="終了日">
                                    <input type="submit" name="product_create_btn" class="btn btn-primary product_create_btn" value="ダウンロード">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection


