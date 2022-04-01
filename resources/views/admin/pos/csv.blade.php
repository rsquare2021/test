@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="åtable-responsive mb-4 mt-4">
                        <form action="{{ route('admin.pos.csv.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="csv">
                            <button>アップロード</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

