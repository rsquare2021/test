この度は{{ $campaign->name }}にご参加いただきありがとうございます。

下記の内容で景品交換を受け付けいたしました。

・交換ID
{{ $apply->id }}

・交換申請日時
{{ $apply->created_at }}

・景品名
{{ $apply->product->name }} {{ $apply->campaign_product->getGifteeBoxPrice($apply->quantity) }}円分

・景品の受け取り方法
下記URLへアクセスし、表示された画面に従い、ご利用ください。
{!! $apply->giftee_box_url !!}

【{{ $apply->product->name }}について】
※ラインナップの中から好きな商品と交換できる、{{ $apply->product->name }} {{ $apply->campaign_product->getGifteeBoxPrice($apply->quantity) }}ポイントを付与します。
※ラインナップおよび交換に必要なポイントは付与された{{ $apply->product->name }}により異なり、変更になる場合がございます。
※また{{ $apply->product->name }}内のポイント交換レートは商品により異なります。記載された必要ポイント数をよくご確認の上、商品と交換ください。

【注意事項等】
※ギフトのご利用は、期限がございます。また期限の延長は致しかねますので、ご了承ください。
※スマートフォンでご利用ください。
※スクリーンショットではご利用いただけません。
※交換権利の換金・他人への譲渡はできませんのでご注意ください。
※いかなる理由があっても再発行は致しかねます。
※転売することはできません。
※本キャンペーンに関して応募者が被った損害または損失などについては、当社の故意または重過失に起因する場合を除き、当社は一切の責任を負わないものとします。

@include('emails.signature', ["campaign" => $campaign])