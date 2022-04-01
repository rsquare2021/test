@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">

                                <form action="{{ route('admin.preset.update', $preset->id) }}" method="post">
                                    @csrf
                                    @method("put")
                                    @error('name')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="text" name="name" value="{{ old('name', $preset->name) }}" class="form-control mb-4" placeholder="プリセット名">
                                    <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>景品名</th>
                                                <th>景品カテゴリー</th>
                                                <th>必要ポイント</th>
                                                <th>当選本数</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td class="pro_id">{{ $product->id }}</td>
                                                    <td class="pro_name">{{ $product->name }}</td>
                                                    <td class="pro_open">{{ $product->product_category ? $product->product_category->name : "" }}</td>
                                                    <td class="pro_open">{{ $product->catalog_basic_point }}</td>
                                                    <td class="pro_open">{{ $product->basic_win_limit }}</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck{{ $loop->index }}" name="products[]" value="{{ $product->id }}" @if(in_array($product->id, old('products', $preset->products->pluck('id')->toArray()))) checked @endif>
                                                            <label class="custom-control-label" for="customCheck{{ $loop->index }}"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="submit" name="preset_product_edit_btn" class="btn btn-primary preset_product_edit_btn">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection