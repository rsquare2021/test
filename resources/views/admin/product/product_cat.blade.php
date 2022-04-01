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
                                            <th>カテゴリー名</th>
                                            <th>親カテゴリー名</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_categories as $category)
                                            <tr>
                                                <td class="">{{ $category->id }}</td>
                                                <td class="">{{ $category->name }}</td>
                                                <td class="">{{ $category->parent ? $category->parent->name : "" }}</td>
                                                <td><a href="{{ route('admin.product_cat.edit', $category->id) }}" class="btn btn-outline-primary mb-2 product_cat_edit_button">編集</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="add_button">
                <a class="bs-tooltip" title="景品カテゴリー追加" href="{{ route('admin.product_cat.create') }}">+</a>
            </div>

@endsection