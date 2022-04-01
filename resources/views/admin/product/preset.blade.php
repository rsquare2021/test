@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
            
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover preset_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>プリセット名</th>
                                            <th>登録景品数</th>
                                            <th>景品確認・修正</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presets as $preset)
                                            <tr>
                                                <td class="area_id">{{ $preset->id }}</td>
                                                <td class="area_name">{{ $preset->name }}</td>
                                                <td class="area_count">{{ $preset->products_count }}</td>
                                                <td><a href="{{ route('admin.preset.edit', $preset->id) }}" class="btn btn-outline-primary mb-2 preset_edit_button">確認・編集</a></td>
                                                <td><button class="btn btn-outline-danger mb-2 preset_delete_button">削除</button></td>
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
    <a class="bs-tooltip" title="景品プリセット追加" href="{{ route('admin.preset.create') }}">+</a>
</div>

@endsection