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
                                            <th>キャンペーン名</th>
                                            <th>キャンペーンサイト公開</th>
                                            <th>レシート応募</th>
                                            <th>応募数</th>
                                            <th>店舗</th>
                                            <th>景品</th>
                                            <th>応募確認</th>
                                            <th class="no-content"></th>
                                            @if (Auth::user()->isSuperAdmin())
                                                <th class="no-content"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($campaigns as $campaign)
                                            <tr>
                                                <td class="pro_id">{{ $campaign->id }}</td>
                                                <td class="pro_name">{{ $campaign->name }}</td>
                                                <td class="pro_start">
                                                    {{ $campaign->publish_datetime }}<br>
                                                    {{ $campaign->close_datetime }}
                                                </td>
                                                <td class="pro_start">
                                                    {{ $campaign->start_datetime_to_convert_receipts_to_points }}<br>
                                                    {{ $campaign->end_datetime_to_convert_receipts_to_points }}
                                                </td>
                                                <td class="pro_count">{{ $campaign->applies_count }}</td>
                                                <td><a href="{{ route('admin.project.shop.edit', $campaign->id) }}" class="btn btn-outline-primary mb-2 pro_shop_edit_btn">確認・編集</a></td>
                                                <td>
                                                    @if ($campaign->is_catalog_type())
                                                        <a href="{{ route('admin.project.product.edit.catalog', $campaign->id) }}" class="btn btn-outline-primary mb-2 pro_product_edit_btn">確認・編集</a></td>
                                                    @else
                                                        <a href="{{ route('admin.project.product.edit.lottery', $campaign->id) }}" class="btn btn-outline-primary mb-2 pro_product_edit_btn">確認・編集</a></td>
                                                    @endif
                                                <td><a href="{{ route('admin.project.apply', $campaign->id) }}" class="btn btn-outline-primary mb-2 pro_apply_btn">確認</a></td>
                                                <td><a href="{{ route('admin.project.edit', $campaign->id) }}" class="btn btn-outline-primary mb-2 pro_edit_btn">編集</a></td>
                                                @if (Auth::user()->isSuperAdmin())
                                                    <td><a href="{{ route('admin.project.copy.create', $campaign->id) }}" class="btn btn-outline-primary mb-2 pro_edit_btn">コピー</a></td>
                                                @endif
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