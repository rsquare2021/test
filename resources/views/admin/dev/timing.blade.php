@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover timing" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>抽選タイミング名</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="timing_id">1</td>
                                            <td class="timing_name">抽選タイミング1</td>
                                            <td><button class="btn btn-outline-danger mb-2 timing_delete_btn">削除</button></td>
                                        </tr>
                                        <tr>
                                            <td class="timing_id">2</td>
                                            <td class="timing_name">抽選タイミング2</td>
                                            <td><button class="btn btn-outline-danger mb-2 timing_delete_btn">削除</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection