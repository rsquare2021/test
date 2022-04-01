@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover company_list" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>会社名</th>
                                            <th>ツリー</th>
                                            <th class="no-content"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td class="company_id">{{ $company->id }}</td>
                                                <td class="company_name">{{ $company->name }}</td>
                                                <td class="company_sub_name">
                                                    @if ($company->isAdministration())
                                                        <span>すべて</span><br>
                                                    @else
                                                        @foreach ($company->shopTrees as $tree)
                                                            <span>{{ $tree->name }}</span><br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td><a class="btn btn-outline-primary mb-2 company_edit_button" href="{{ route('admin.company.edit', $company->id) }}">編集</a></td>
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
    <a class="bs-tooltip" title="会社追加" href="{{ route('admin.company.create') }}">+</a>
</div>

@endsection