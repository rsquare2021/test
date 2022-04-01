@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                            <form action="{{ route('admin.company.update', $company->id) }}" method="post">
                                @csrf
                                @method("put")
                                <h6 class="company_name">会社名</h6>
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control company_name" name="name" placeholder="会社名" value="{{ old('name', $company->name) }}">
                                    </div>
                                </div>
                                <h6>紐付けツリー</h6>
                                <div class="row mb-4">
                                    <div class="col company_wrap">
                                        <select class="form-control company_relation" name="shopTrees[]">
                                            <option value="">選択してください</option>
                                            @foreach ($trees as $tree)
                                                <option value="{{ $tree->id }}" @if(in_array($tree->id, old('shopTrees', $company->shopTrees->pluck('id')->toArray()))) selected @endif>{{ $tree->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <a class="btn btn-primary mb-4 tree_add">紐付けツリー追加</a>
                                <input type="submit" name="time" class="btn btn-primary company_edit_btn">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection