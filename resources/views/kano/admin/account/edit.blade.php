@if (str_ends_with(request()->path(), "create"))
<form action="{{ route('kano.admin.account.store') }}" method="post">
    @csrf
@else
<form action="{{ route('kano.admin.account.update', $admin->id) }}" method="post">
    @csrf
    @method("PUT")
@endif
    <ul>
        <li>
            <label for="name">名前</label>
            @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
            @enderror
            <input type="text" name="name" id="name" value="{{ old('name', $admin->name ?? '') }}">
        </li>
        <li>
            <label for="email">メールアドレス</label>
            @error('email')
                <p class="alert alert-danger">{{ $message }}</p>
            @enderror
            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}">
        </li>
        @if (str_ends_with(request()->path(), "create"))
            <li>
                <label for="password">パスワード</label>
                @error('password')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <input type="password" name="password" id="password" value="{{ old('password', $admin->password) }}">
            </li>
        @endif
        <li>
            <label for="admin_role">権限</label>
            @error('admin_role_id')
                <p class="alert alert-danger">{{ $message }}</p>
            @enderror
            <select name="admin_role_id" id="admin_role">
                <option value=""></option>
                @foreach($admin_roles as $role)
                    <option value="{{ $role->id }}" @if($role->id == old('admin_role_id', $admin->admin_role->id ?? null)) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </li>
        <li>
            <p>所属会社</p>
            @error('companies')
                <p class="alert alert-danger">{{ $message }}</p>
            @enderror
            <div>
                @foreach ($companies as $company)
                    <label><input type="checkbox" name="companies[]" value="{{ $company->id }}" @if(in_array($company->id, old('companies', $admin->companies->pluck('id')->toArray()))) checked @endif>{{ $company->name }}</label>
                @endforeach
            </div>
        </li>
        <li>
            <p>担当店舗</p>
            <div>
                @foreach ($shops as $shop)
                    <label><input type="checkbox" name="shops[]" value="{{ $shop->id }}" @if(in_array($shop->id, old('shops', $admin->shops->pluck("id")->toArray()))) checked @endif>{{ $shop->name }}</label>
                @endforeach
            </div>
        </li>
    </ul>
    <button>登録</button>
</form>