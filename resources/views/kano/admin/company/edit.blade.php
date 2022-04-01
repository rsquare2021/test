@if($action == "create")
<form action="{{ route('kano.admin.company.store') }}" method="POST">
    @csrf
@else
<form action="{{ route('kano.admin.company.update', $company->id) }}" method="POST">
    @csrf
    @method("PUT")
@endif
    <ul>
        <li>
            <label for="name">会社名</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}">
        </li>
        <li>
            <label>支部</label>
            @foreach ($company->offices as $office)
                <div>
                    <input type="hidden" name="offices[{{ $loop->iteration }}][id]" value="{{ $office->id }}">
                    <input type="text" name="offices[{{ $loop->iteration }}][name]" value="{{ $office->name }}">
                    <input type="text" name="offices[{{ $loop->iteration }}][department]" value="{{ $office->department }}">
                </div>
            @endforeach
            <div>
                <input type="hidden" name="offices[100][id]">
                <input type="text" name="offices[100][name]">
                <input type="text" name="offices[100][department]">
            </div>
        </li>
    </ul>
    <button>登録</button>
</form>