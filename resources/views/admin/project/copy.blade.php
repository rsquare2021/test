@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="åtable-responsive mb-4 mt-4">
                            <form action="{{ route('admin.project.copy.store', $campaign->id) }}" method="post">
                                @csrf
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
                                        <input type="text" class="form-control pro_start datetimepicker" name="publish_datetime" placeholder="" value="{{ old('publish_datetime') }}">
                                    </div>
                                </div>
                                <h6>キャンペーンサイト終了日</h6>
                                @error('close_datetime')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_end datetimepicker" name="close_datetime" placeholder="" value="{{ old('close_datetime') }}">
                                    </div>
                                </div>
                                <h6>レシート応募　開始日</h6>
                                @error('start_datetime_to_convert_receipts_to_points')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_start datetimepicker" name="start_datetime_to_convert_receipts_to_points" placeholder="" value="{{ old('start_datetime_to_convert_receipts_to_points') }}">
                                    </div>
                                </div>
                                <h6>レシート応募　終了日</h6>
                                @error('end_datetime_to_convert_receipts_to_points')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control pro_end datetimepicker" name="end_datetime_to_convert_receipts_to_points" placeholder="" value="{{ old('end_datetime_to_convert_receipts_to_points') }}">
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
                                <input type="submit" name="pro_create_btn" class="btn btn-primary">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection