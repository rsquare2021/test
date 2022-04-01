この度は{{ $campaign->name }}にご参加いただきありがとうございます。

下記の内容の景品交換をキャンセルいたしました。

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

・発送先
{{ $apply->shipping_address->getAddress() }}
{{ $apply->shipping_address->last_name }} {{ $apply->shipping_address->first_name }}
{{ $apply->shipping_address->tel }}
{{ $apply->shipping_address->delivery_time_id }}


引き続きキャンペーンをお楽しみください。

@include('emails.signature', ["campaign" => $campaign])