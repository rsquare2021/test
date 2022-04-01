<ul>
    @foreach ($courses as $course)
        <li>
            <p>{{ $course->name }} <span>（当選確率：{{ $course->win_rate }}%）</span></p>
            <form action="{{ route('campaign.gift.apply', $campaign_id) }}" method="post">
                @csrf
                <input type="hidden" name="campaign_product_id" value="{{ $course->id }}">
                <input type="text" name="amount" value="{{ old('amount') }}">
                <button>応募する</button>
            </form>
            <ul>
                @foreach ($course->children as $gift)
                    <li>{{ $gift->product->name }}</li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>