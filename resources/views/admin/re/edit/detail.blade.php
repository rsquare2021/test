@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    
                    <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">   
                                <div class="img_wrap">
                                    @if($receipt->status_count !== 0)<div class="duplicate_text">強制送信</div>@endif
                                    <img id="zoom" src="https://re-nt-upload.s3.ap-northeast-1.amazonaws.com/{{ $receipt->receipt_path }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <form action="{{ route('admin.meken.edit', $re_id) }}" method="post">
                                @csrf
                                <div class="table-responsive mb-4 mt-4">
                                    @include('merchant.content')
                                    <input type="hidden" name="user_id" value="{{ $receipt->user_id }}">
                                    <input type="hidden" name="status" value="{{ $receipt->status }}">
                                    @if(30 <= $receipt->status && $receipt->status <= 39)
                                        <div class="widget-content widget-content-area text-center split-buttons meken_btns">
                                            <button class="btn btn-success mb-2" name="action" value="accept">承認</button>
                                            <button class="btn btn-info mb-2" name="action" value="reject">否認</button>
                                            <button class="btn btn-warning mb-2" name="action" value="illegal">不正</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

@endsection

















































































