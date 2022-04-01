<h1>管理者一覧</h1>

<a href="{{ route('kano.admin.account.create') }}">新規作成</a>

<ul>
@forelse($admins as $admin)
    <li>
        <p><a href="{{ route('kano.admin.account.edit', $admin->id) }}">{{ $admin->name }}</a> {{ $admin->admin_role->name }} </p>
        <form action="{{ route('kano.admin.account.destroy', $admin->id) }}" method="post">
            @csrf
            @method("DELETE")
            <button>削除</button>
        </form>
    </li>
@empty
    <p>データがありません。</p>
@endforelse
</ul>
