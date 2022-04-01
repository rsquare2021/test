@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <form action="{{ route('admin.project.shop.update', $campaign->id) }}" method="post">
                                @csrf
                                @method("put")
                                @error('element_ids')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4 mt-3">
                                    <div class="col-sm-3 col-12">
                                        <ul>
                                            @foreach ($roots as $element)
                                                @include('admin.user.charge_sub', ["element" => $element, "depth_clumbs" => []])
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-sm-9 col-12">
                                        <table id="multi-column-ordering" class="table table-hover charge_list" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>店舗名</th>
                                                    <th>所属会社名</th>
                                                    <th>支社名</th>
                                                    <th>店舗エリア</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($shops as $shop)
                                                    @php
                                                        $company = $shop->parent->parent->parent;
                                                        $office = $shop->parent->parent;
                                                        $area = $shop->parent;
                                                    @endphp
                                                    <tr class="shop_ul {{ "s_company-$company->id s_sub-$office->id s_area-$area->id" }} shop_send">
                                                        <td>{{ $shop->id }}</td>
                                                        <td>{{ $shop->name }}</td>
                                                        <td>{{ $company->name }}</td>
                                                        <td>{{ $office->name }}</td>
                                                        <td>{{ $area->name }}</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                    class="custom-control-input {{ "shop_company-$company->id shop_sub-$office->id shop_area-$area->id" }} shop"
                                                                    id="sub_check{{ $shop->id }}"
                                                                    data-company="{{ $company->id }}"
                                                                    data-shop_sub="{{ $office->id }}"
                                                                    data-shop_area="{{ $area->id }}"
                                                                    data-shop="{{ $shop->id }}"
                                                                    name="element_ids[]"
                                                                    value="{{ $shop->id }}"
                                                                >
                                                                <label class="custom-control-label" for="sub_check{{ $shop->id }}"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-primary">登録</button>
                            </form>
                        </div>
                        

                </div>

            </div>

@endsection

@section('local_script')
@php
    if($errors->any())
        $charged_ids = collect(old('element_ids', []))->implode("id", ",");
    else {
        $charged_ids = $campaign->shop_tree_elements->implode("id", ",");
    }
@endphp
<script>
$(function() {
    let charged_ids = [{{ $charged_ids }}];
    charged_ids.forEach(id => {
        $("input[name='element_ids[]'][value='"+id+"']").click();
    })
});
</script>
@endsection