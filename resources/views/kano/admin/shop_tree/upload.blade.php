@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">

                    <form action="{{ route('admin.shop_tree.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h6>CSVファイル</h6>
                        @error('csv')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                        <div class="row mb-4">
                            <div class="col">
                                <input type="file" class="form-control" name="csv">
                            </div>
                        </div>
                        <button class="btn btn-primary mb-4">登録</button>

                        @if ($errors->has('content.*'))
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->get('content.*') as $attributes)
                                        @foreach ($attributes as $attr)
                                            <li>{{ $attr }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection