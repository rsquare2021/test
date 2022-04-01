この度は{{ $campaign->name }}にご参加いただきありがとうございます。

下記の内容で景品の発送先を変更いたしました。

・交換ID
{{ $apply->id }}

・交換申請日時
{{ $apply->created_at }}

・景品名
{{ $apply->product->name }}

@if ($apply->product->variation_name)
・種類
{{ $apply->product->variation_name }}
@endif

・個数
{{ $apply->quantity }}

・発送先 (変更後)
{{ $apply->shipping_address->getAddress() }}
{{ $apply->shipping_address->last_name }} {{ $apply->shipping_address->first_name }}
{{ $apply->shipping_address->tel }}
{{ $apply->delivery_time_id }}


景品の発送先変更およびキャンセルは「交換申請日当日のみ」可能です。
お手続きが必要な場合は下記URLでお手続きください。
{!! route('campaign.apply.index', $campaign->id) !!}

@include('emails.signature', ["campaign" => $campaign])