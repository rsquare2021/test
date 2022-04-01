@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <p>{{ Auth::user()->name }}</p>
            <p>{{ Auth::user()->admin_role->name }}</p>
            <p>{{ Auth::user() instanceof Admin ? "y" : "n" }}</p>
            @foreach(Auth::user()->companies as $company)
                <p>{{ $company->name }}</p>
            @endforeach
            <div>
                <div>
                    <h4>管理ユーザ</h4>
                    <ul>
                        <li>新規作成</li>
                        <li>プロフィール編集</li>
                        <li>削除</li>
                    </ul>
                </div>
                <div>
                    <h4>店舗</h4>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div>
                    <h4>店舗プリセット</h4>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div>
                    <h4>所属会社</h4>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div>
                    <h4>店舗エリア</h4>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection