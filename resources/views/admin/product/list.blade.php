@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>景品名</th>
                                            <th>景品カテゴリー</th>
                                            <th>必要ポイント</th>
                                            <th>当選本数</th>
                                            <th>サプライヤ</th>
                                            <th>管理番号</th>
                                            <th class="no-content"></th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="pro_id">{{ $product->id }}</td>
                                                <td class="pro_name">{{ $product->name }}</td>
                                                <td>{{ $product->product_category ? $product->product_category->name : '' }}</td>
                                                <td>{{ $product->catalog_basic_point }}</td>
                                                <td>{{ $product->basic_win_limit }}</td>
                                                <td>{{ $product->supplier->name }}</td>
                                                <td>{{ $product->operation_id }}</td>
                                                <td><a href="{{ route('admin.product.destroy', $product->id) }}" class="btn btn-outline-danger mb-2 pro_delete_btn">削除</a></td>
                                                <td><a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-outline-primary mb-2 pro_edit_btn">編集</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection