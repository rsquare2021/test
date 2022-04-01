@extends('layouts.merchant')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            @if (session('flash_message'))
                                <p>{{ session('flash_message') }}</p>
                            @endif
                                <form action="{{ route('merchant.user.edit.update',$mk_user_id) }}" method="post">
                                    @csrf
                                    <h6>ID（半角英数字のみ）</h6>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" name="mail" placeholder="ID（半角英数字のみ）" value="{{ $user->mail }}">
                                            @error('mail')
                                                <p class="text-danger">半角英数字で入力してください。</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <h6>パスワード（半角英数字のみ）</h6>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" name="pass" placeholder="パスワード（半角英数字のみ）" value="{{ $user->pass }}">
                                            @error('pass')
                                                <p class="text-danger">半角英数字で入力してください。</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <h6>名前</h6>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input type="text" class="form-control" name="name" placeholder="名前" value="{{ $user->name }}">
                                            @error('name')
                                                <p class="text-danger">必須項目です。</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="submit" name="time" class="btn btn-primary mk_user_update_btn" value="更新">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection

















































































