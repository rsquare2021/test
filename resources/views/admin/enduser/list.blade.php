@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">

                            <form action="{{ route('admin.enduser.list') }}" method="get" class="select_form" id="re_select">
                                <div class="flex">
                                    <div class="bloc">
                                        <p class="mb-0">応募者ID</p>
                                        <input class="form-control" type="text" name="user_id" value="{{ $user_id }}">
                                    </div>
                                    <div class="bloc">
                                    <p class="mb-0">メールアドレス</p>
                                    <input class="form-control" type="text" name="mail" value="{{ $mail }}">
                                    </div>
                                    <div class="bloc">
                                    <p class="mb-0">作成日時</p>
                                    <input class="form-control datepicker" type="text" name="start_date" value="{{ $start_date }}">〜<input class="form-control datepicker" type="text" name="end_date" value="{{ $end_date }}">
                                    </div>
                                </div>
                                <dl class="mb-4 mt-4">
                                    <div class="bloc">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_count_none" name="select_user_option" value="select_count_none" class="custom-control-input default" @if($select_user_option == 'select_count_none') checked @endif>
                                            <label class="custom-control-label" for="select_count_none">詳細検索なし</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_send_count" name="select_user_option" value="select_send_count" class="custom-control-input" @if($select_user_option == 'select_send_count') checked @endif>
                                            <label class="custom-control-label" for="select_send_count">レシート送信枚数</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_total_point" name="select_user_option" value="select_total_point" class="custom-control-input" @if($select_user_option == 'select_total_point') checked @endif>
                                            <label class="custom-control-label" for="select_total_point">累計ポイント数</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_total_apply" name="select_user_option" value="select_total_apply" class="custom-control-input" @if($select_user_option == 'select_total_apply') checked @endif>
                                            <label class="custom-control-label" for="select_total_apply">累計交換回数</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_illegal_count" name="select_user_option" value="select_illegal_count" class="custom-control-input" @if($select_user_option == 'select_illegal_count') checked @endif>
                                            <label class="custom-control-label" for="select_illegal_count">不正回数</label>
                                        </div>
                                    </div>
                                    <div class="bloc">
                                        <input class="form-control" type="text" name="start_value" value="{{ $start_value }}">〜<input class="form-control" type="text" name="end_value" value="{{ $end_value }}">
                                    </div>
                                </dl>
                                <input type="submit" name="user_select_btn" class="btn btn-primary user_select_btn" value="検索">
                                <a class="btn btn-warning select_reset_btn">リセット</a>
                            </form>

                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover user_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>応募者ID</th>
                                            <th>メールアドレス</th>
                                            <th>レシート送信枚数</th>
                                            <th>レシート承認枚数</th>
                                            <th>平均獲得ポイント</th>
                                            <th>累計ポイント</th>
                                            <th>累計交換回数</th>
                                            <th>不正回数</th>
                                            <th>作成日時</th>
                                            <th>退会</th>
                                        </tr>
                                    </thead>
                                    <tbody class="receipt_body">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->send_count }}</td>
                                            <td>{{ $user->accept_count }}</td>
                                            <td>
                                                @php
                                                    $ava = $user->ava;
                                                    echo floor($ava);
                                                @endphp
                                            </td>
                                            <td>
                                                @if($user->total_point == null || $user->total_point == '')
                                                    0
                                                @else
                                                    {{ $user->total_point }}
                                                @endif
                                            </td>
                                            <td>{{ $user->select_total_apply }}</td>
                                            <td>{{ $user->illegal_count }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div id="pager">
                                    {{$users->appends(request()->query())->links()}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection