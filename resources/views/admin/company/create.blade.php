@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form action="{{ route('admin.company.store') }}" method="post">
                                @csrf
                                <h6>会社名</h6>
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" placeholder="会社名" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <h6>紐付けツリー</h6>
                                <div class="row mb-4">
                                    <div class="col company_wrap">
                                        <select class="form-control company_relation" name="shopTrees[]">
                                            <option value="">選択してください</option>
                                            @foreach ($trees as $tree)
                                                <option value="{{ $tree->id }}" @if(in_array($tree->id, old('shopTrees', []))) selected @endif>{{ $tree->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <a class="btn btn-primary mb-4 tree_add">紐付けツリー追加</a>
                                <input type="submit" name="time" class="btn btn-primary company_create_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
<!-- モーダル -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p>注意して編集してください。</p>
                <table class="table">
                    <tr>
                        <td>名前</td>
                        <td><input id="user_edit_name" type="text" name="user_edit_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>所属会社</td>
                        <td><input id="user_edit_company" type="text" name="user_edit_pass" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>メールアドレス</td>
                        <td><input id="user_edit_mail" type="text" name="user_edit_mail" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>権限</td>
                        <td>
                            <select class="form-control" id="user_edit_role">
                                <option>スーパー管理者</option>
                                <option>管理者</option>
                                <option>閲覧者</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 削除</button>
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 閉じる</button>
                <button type="button" class="btn btn-primary user_edit_btn" id="">保存</button>
            </div>
        </div>
    </div>
</div>

@endsection