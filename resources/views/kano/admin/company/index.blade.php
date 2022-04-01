<h1>所属会社一覧</h1>

<a href="{{ route('kano.admin.company.create') }}">新規作成</a>

@forelse($companies as $company)
    <p><a href="{{ route('kano.admin.company.edit', $company->id) }}">{{ $company->name }}</a></p>
@empty
    <p>データがありません。</p>
@endforelse
