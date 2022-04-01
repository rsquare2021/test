<form action="{{ route('kano.admin.campaign.store') }}" method="post">
    @csrf
    <ul>
        <li>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
        </li>
        <li>
            <label>期間</label>
            <input type="text" name="begin_datetime" value="{{ old('begin_datetime') }}">
            <input type="text" name="end_datetime" value="{{ old('end_datetime') }}">
        </li>
        <li>
            <label>店舗</label>
            <div>
                @foreach ($shops as $shop)
                    <label><input type="checkbox" name="shops[]" value="{{ $shop->id }}" @if(in_array($shop->id, old('shops') ?? [])) checked @endif>{{ $shop->name }}</label>
                @endforeach
            </div>
        </li>
        <li>
            <div>
                <label for="product">景品</label>
                <select name="product" id="product">
                    <option value=""></option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if($product->id == old('product')) selected @endif>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exchange_rule">交換ルールのタイプ</label>
                <select name="exchange_rule" id="exchange_rule">
                    <option value=""></option>
                    <option value="1">応募者全員</option>
                    <option value="2">先着</option>
                    <option value="3">一括抽選</option>
                    <option value="4">定期抽選</option>
                    <option value="5">インスタントWIN</option>
                </select>
            </div>
            <div>
                <label for="required_point">必要ポイント</label>
                <input type="number" name="required_point" id="required_point">
            </div>
        </li>
    </ul>
    <button>登録</button>
</form>