@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <form action="{{ route('admin.preset.store') }}" method="post">
                                    @csrf
                                    <h6>プリセット名</h6>
                                    @error('name')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input id="preset_name" type="text" name="name" class="form-control" value="{{ old('name') }}">
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