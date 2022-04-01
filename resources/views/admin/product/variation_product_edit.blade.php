@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">

                                <form action="{{ route('admin.variation.update', $parent->id) }}" method="post">
                                    @csrf
                                    @method("put")
                                    <input type="text" name="name" value="{{ old('name', $parent->name) }}" class="form-control mb-4" placeholder="バリエーション名">
                                    <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>景品名</th>
                                                <th>景品カテゴリー</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td class="pro_id">{{ $product->id }}</td>
                                                    <td class="pro_name">{{ $product->name }}</td>
                                                    <td class="pro_open">{{ $product->product_category ? $product->product_category->name : "" }}</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck{{ $loop->index }}" name="variations[]" value="{{ $product->id }}" @if(in_array($product->id, old('products', $parent->variations->pluck('id')->toArray()))) checked @endif>
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