この度は{{ $campaign->name }}にご参加いただきありがとうございます。

下記ページでパスワードを変更いただけます。

{!! url(config('url').route('campaign.password.reset', [$campaign->id, $token], false)) !!}
※パスワードを変更しない場合はこのメールを破棄してください。

@include('emails.signature', ["campaign" => $campaign])