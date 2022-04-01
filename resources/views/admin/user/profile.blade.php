@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form action="{{ route('admin.profile.update') }}" method="post">
                                @csrf
                                @method("put")
                                <h6>名前</h6>
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" placeholder="氏名" value="{{ old('name', $admin->name) }}">
                                    </div>
                                </div>
                                <h6>メールアドレス</h6>
                                @error('email')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="email" placeholder="sample@gmail.com" value="{{ old('email', $admin->email) }}">
                                    </div>
                                </div>
                                <h6>パスワード</h6>
                                @error('password')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="password" placeholder="半角英数字8桁以上">
                                    </div>
                                </div>
                                <h6>勤務地・部署</h6>
                                @error('office_name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="office_name" placeholder="支社名　部署名" value="{{ old('office_name', $admin->office_name) }}">
                                    </div>
                                </div>
                                <input type="submit" name="user_create_btn" class="btn btn-primary user_create_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection