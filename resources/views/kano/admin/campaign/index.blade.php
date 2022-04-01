<h1>キャンペーン一覧</h1>

<a href="{{ route('kano.admin.campaign.create') }}">新規作成</a>

<ul>
@forelse ($campaigns as $campaign)
    <li>{{ $campaign->title }}</li>
@empty
    <li>データがありません。</li>
@endforelse
</ul>