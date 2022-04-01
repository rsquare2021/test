@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>名前</th>
                                            <th>所属会社</th>
                                            <th>権限</th>
                                            <th>メールアドレス</th>
                                            <th>最終アクセス</th>
                                            <th>担当確認・編集</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td class="user_id">{{ $admin->id }}</td>
                                                <td class="user_name">{{ $admin->name }}</td>
                                                <td class="user_company">{{ $admin->company->name }}</td>
                                                <td class="user_roll">{{ $admin->admin_role->name }}</td>
                                                <td class="user_mail">{{ $admin->email }}</td>
                                                <td class="user_access_date">{{ $admin->latest_login_at }}</td>
                                                <td><a href="{{ route('admin.user.charge.edit', $admin->id) }}" class="btn btn-outline-primary mb-2 user_charge_edit_button">確認・編集</a></td>
                                                {{-- <td><button class="btn btn-outline-primary mb-2 user_edit_button" data-toggle="modal" data-target="#editModal">編集</button></td> --}}
                                                <td><a href="{{ route('admin.user.edit', $admin->id) }}" class="btn btn-outline-primary mb-2">編集</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="add_button">
                <a class="bs-tooltip" title="ユーザー追加" href="{{ route('admin.user.create') }}">+</a>
            </div>

@endsection