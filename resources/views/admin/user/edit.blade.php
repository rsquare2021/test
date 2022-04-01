@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form action="{{ route('admin.user.update', $admin->id) }}" method="post">
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
                                <h6>勤務地・部署</h6>
                                @error('office_name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="office_name" placeholder="支社名　部署名" value="{{ old('office_name', $admin->office_name) }}">
                                    </div>
                                </div>
                                <h6>権限</h6>
                                @error('admin_role_id')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <select class="form-control user_role" id="user_role" name="admin_role_id">
                                            @foreach ($admin_roles as $role)
                                                <option value="{{ $role->id }}" @if($role->id == old('admin_role_id', $admin->admin_role_id)) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('super_admin_count')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                @error('cant_delete_own')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <input type="submit" name="user_create_btn" class="btn btn-primary user_create_btn">
                            </form>
                            <form action="{{ route('admin.user.destroy', $admin->id) }}" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger mt-4">削除</button>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection