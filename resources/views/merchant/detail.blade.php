@extends('layouts.merchant')

@section('content')

    <div class="layout-px-spacing">
                
        <div class="row layout-top-spacing">
            
            <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing height_base">
                <div class="widget-content widget-content-area br-6 height100">
                    <div class="table-responsive height100">   
                        <div class="img_wrap height100">
                            <div class="absolute_img">
                                <a onclick="windowOpen()" class="btn-primary">拡大表示</a>
                            </div>
                            <script>
                                function windowOpen(){
                                    window.open('https://re-nt-upload.s3.ap-northeast-1.amazonaws.com/{{ $receipt->receipt_path }}', null ,'top=100,left=100,width=1000,height=1000');
                                }
                            </script>
                            <img src="https://re-nt-upload.s3.ap-northeast-1.amazonaws.com/{{ $receipt->receipt_path }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <form action="{{ route('merchant.meken.edit', $re_id) }}" method="post">
                        @csrf
                        <div id="kengen{{ $kengen }}" class="table-responsive mb-4 mt-4">
                            @include('merchant.content')
                            <input type="hidden" name="user_id" value="{{ $receipt->user_id }}">
                            <input type="hidden" name="status" value="{{ $receipt->status }}">
                            @if($kengen == 0)
                                @if(10 <= $receipt->status && $receipt->status <= 19)
                                    <div class="widget-content widget-content-area text-center split-buttons meken_btns">
                                        <button class="btn btn-primary mb-2" name="action" value="accept" disabled>承認</button>
                                        <button class="btn btn-warning mb-2" name="action" value="nojudge" disabled>判断不可</button>
                                        <button class="btn btn-danger mb-2" name="action" value="reject" disabled>否認</button>
                                        <button class="btn btn-dark mb-2" name="action" value="illegal" disabled>不正</button>
                                    </div>
                                @endif
                            @elseif($kengen == 1)
                                @if(20 <= $receipt->status && $receipt->status <= 29)
                                    <div class="widget-content widget-content-area text-center split-buttons meken_btns">
                                        <button class="btn btn-primary mb-2" name="action" value="accept">承認</button>
                                        <button class="btn btn-warning mb-2" name="action" value="nojudge">判断不可</button>
                                        <button class="btn btn-danger mb-2" name="action" value="reject">否認</button>
                                        <button class="btn btn-dark mb-2" name="action" value="illegal">不正</button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

@endsection

















































































