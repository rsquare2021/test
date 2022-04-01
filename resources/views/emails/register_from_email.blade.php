――――――――――――――――――――――――――――――
このメールは{{ $campaign->name }}のシステムから自動送信しています。
このメールに心当たりがない場合は他のお客様が間違えて登録されている可能性がございますので、
お手数ですがメール下部に記載のメールアドレスへご連絡ください。
――――――――――――――――――――――――――――――

この度は{{ $campaign->name }}にご参加いただきありがとうございます。
@if ($method == "register")
このメールは本キャンペーンのアカウント登録手続きをされた方にお送りしています。

お客様のアカウントは仮登録の状態です。
@else
このメールは本キャンペーンのアカウントにご登録のメールアドレスを変更される方にお送りしています。

お客様のメールアドレスは仮登録の状態です。
@endif
下記URLをクリックし、本登録を完了してください。
確認用URLの有効期限は24時間です。

{!! $verification_url !!}
※このメールに心当たりがない場合は上記URLをクリックせず、メール下部に記載のメールアドレスへご連絡ください。

@include('emails.signature', ["campaign" => $campaign])