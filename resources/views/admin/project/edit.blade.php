@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form action="{{ route('admin.project.update', $campaign->id) }}" method="post">
                                @csrf
                                @method("put")
                                <h6>キャンペーン名</h6>
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_name" name="name" placeholder="キャンペーン名" value="{{ old('name', $campaign->name) }}">
                                    </div>
                                </div>
                                <h6>キャンペーンサイト公開日</h6>
                                @error('publish_datetime')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_start datetimepicker" name="publish_datetime" placeholder="" value="{{ old('publish_datetime', $campaign->publish_datetime) }}">
                                    </div>
                                </div>
                                <h6>キャンペーンサイト終了日</h6>
                                @error('close_datetime')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_end datetimepicker" name="close_datetime" placeholder="" value="{{ old('close_datetime', $campaign->close_datetime) }}">
                                    </div>
                                </div>
                                <h6>レシート応募　開始日</h6>
                                @error('start_datetime_to_convert_receipts_to_points')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_start datetimepicker" name="start_datetime_to_convert_receipts_to_points" placeholder="" value="{{ old('start_datetime_to_convert_receipts_to_points', $campaign->start_datetime_to_convert_receipts_to_points) }}">
                                    </div>
                                </div>
                                <h6>レシート応募　終了日</h6>
                                @error('end_datetime_to_convert_receipts_to_points')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_end datetimepicker" name="end_datetime_to_convert_receipts_to_points" placeholder="" value="{{ old('end_datetime_to_convert_receipts_to_points', $campaign->end_datetime_to_convert_receipts_to_points) }}">
                                    </div>
                                </div>
                                <h6>ポイント付与率</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_point_per" name="pro_point_per" placeholder="半角数字">
                                    </div>
                                </div>
                                <h6>ポイント特別期間</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_point_ex_term" name="pro_point_ex_term" placeholder="">
                                    </div>
                                </div>
                                <h6>ポイント特別期間付与率</h6>
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_point_ex_per" name="pro_point_per" placeholder="半角数字">
                                    </div>
                                </div>
                                <h6>応募要項</h6>
                                @error('application_requirements')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control pro_detail" id="" rows="10" name="application_requirements">{{ old('application_requirements', $campaign->application_requirements) }}</textarea>
                                    </div>
                                </div>
                                <h6>利用規約</h6>
                                @error('terms_of_service')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control pro_rule" id="" rows="10" name="terms_of_service">{{ old('terms_of_service', $campaign->terms_of_service) }}</textarea>
                                    </div>
                                </div>
                                <h6>プライバシーポリシー</h6>
                                @error('privacy_policy')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <textarea class="form-control pro_privacy" id="" rows="10" name="privacy_policy">{{ old('privacy_policy', $campaign->privacy_policy) }}</textarea>
                                    </div>
                                </div>
                                <h6>検索クロール可否</h6>
                                @error('is_crawlable')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-2">
                                    <div class="col company_wrap">
                                        <select class="form-control pro_crawl" name="is_crawlable">
                                            <option value="">選択してください</option>
                                            <option value="1" @if(old('is_crawlable', $campaign->is_crawlable) == '1') selected @endif>検索可能</option>
                                            <option value="0" @if(old('is_crawlable', $campaign->is_crawlable) == '0') selected @endif>検索不可</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" name="pro_edit_btn" class="btn btn-primary pro_edit_btn">
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