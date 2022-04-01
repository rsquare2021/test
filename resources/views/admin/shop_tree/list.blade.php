@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ツリー名</th>
                                            <th>支社</th>
                                            <th>エリア</th>
                                            <th>店舗</th>
                                            <th class="no-content"></th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roots as $root)
                                            <tr>
                                                <td class="">{{ $root->id }}</td>
                                                <td class="">{{ $root->name }}</td>
                                                <td class="">{{ $element_count_list->where("id", $root->id)->where("depth", 1)->first()->count }}</td>
                                                <td class="">{{ $element_count_list->where("id", $root->id)->where("depth", 2)->first()->count }}</td>
                                                <td class="">{{ $element_count_list->where("id", $root->id)->where("depth", 3)->first()->count }}</td>
                                                <td>
                                                    <form action="{{ route('admin.shop_tree.destroy', $root->id) }}" method="post">
                                                        @csrf
                                                        @method("delete")
                                                        <button class="btn btn-outline-danger mb-2">削除</button>
                                                    </form>
                                                </td>
                                                <td><a href="{{ route('admin.shop_tree.edit', $root->id) }}" class="btn btn-outline-primary mb-2 shop_tree_edit_btn">編集</a></td>
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
    <a class="bs-tooltip" title="ツリー追加" href="{{ route('admin.shop_tree.create') }}">+</a>
</div>

@endsection