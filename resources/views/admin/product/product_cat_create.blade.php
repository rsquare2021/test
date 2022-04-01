@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <form action="{{ route('admin.product_cat.store') }}" method="post">
                                    @csrf
                                    <h6>親カテゴリー</h6>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <select class="form-control product_parent_cat" name="parent_id">
                                                <option value="">選択してください</option>
                                                @foreach ($parent_list as $v)
                                                    <option value="{{ $v->id }}" @if($v->id == old('parent_id')) selected @endif>{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @csrf
                                    <h6>カテゴリー名</h6>
                                    @error('name')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input id="product_cat" type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <input type="submit" name="product_cat_create_btn" class="btn btn-primary product_cat_create_btn">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
@endsection