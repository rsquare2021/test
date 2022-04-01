@extends('layouts.merchant')

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
                                            <th>ユーザー名</th>
                                            <th>稼働</th>
                                            <th>更新日時</th>
                                            <th>最新稼働状況切り替え日時</th>
                                            <th>稼働状況切り替え</th>
                                            <th>編集</th>
                                        </tr>
                                    </thead>

                                    <tbody class="receipt_body">
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @if($user->active == 0)
                                                        停止中
                                                    @elseif($user->active == 1)
                                                        稼働中
                                                    @endif
                                                </td>
                                                <td>{{ $user->updated_at }}</td>
                                                <td>{{ $user->active_date }}</td>
                                                <td>
                                                    <form action="{{ route('merchant.user.active') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="mk_user_id" value="{{ $user->id }}">
                                                        @if($user->active == 0)
                                                            <input type="submit" name="active" class="btn fz12" value="稼働する">
                                                        @elseif($user->active == 1)
                                                            <input type="submit" name="active" class="btn fz12" value="停止する">
                                                        @endif
                                                    </form>
                                                </td>
                                                <td><a href="/merchant/user/{{ $user->id }}" class="btn fz12 normal">編集</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p><a href="{{ route('merchant.user.create') }}" class="btn btn-primary">スタッフ追加</a></p>
                            <p>※スタッフの削除は手動ではできませんので、注意して追加してください。</p>
                        </div>
                    </div>
                </div>

            </div>

@endsection

















































































