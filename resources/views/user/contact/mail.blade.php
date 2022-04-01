キャンペーン参加者様からの以下の内容のお問い合わせを受け付けました。<br>
内容を確認のうえ、応対してください。<br>
<br>
メールアドレス<br>
{!! $email !!}<br>
<br>
電話番号<br>
{!! $contact_tel !!}<br>
<br>
お問い合わせの種類<br>
{!! $contact_type !!}<br>
<br>
◆お問い合わせの内容<br>
{!! nl2br($contact) !!}<br>
<br>
@include('emails.signature', ["campaign" => $campaign])