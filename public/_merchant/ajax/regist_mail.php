<?php
session_start();
try {
	$dsn = 'mysql:dbname=laravel_local;host=db;charset=utf8;';
	$user = 'phper';
	$password = 'secret';
    $PDO = new PDO($dsn, $user, $password); //MySQLのデータベースに接続
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示
} catch (PDOException $e) {
	exit('接続できませんでした。' . $e->getMessage());
}

$digits = 4;
$code = str_pad(Rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$mail = filter_input( INPUT_POST, "mail" );


// ログイン・会員登録チェック
$sql = "SELECT mail FROM mk_users WHERE mail = :mail";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();

if($count >= 1) {
	// 本会員にメアドが登録されていたらログイン画面へ
	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'login',
		'mail'=>$mail
	]);
} else {
	// 重複しないようにレコード削除
	$sql = "SELECT email FROM mk_fcm_tokens_web WHERE email = :mail";
	$stmt = $PDO -> prepare($sql);
	$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
	$stmt->execute();
	$mail_count = $stmt->rowCount();
	if($mail_count >= 1) {
		$sql = "DELETE FROM mk_fcm_tokens_web WHERE email = :mail";
		$stmt = $PDO -> prepare($sql);
		$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
		$stmt->execute();
	}
	// レコード追加
	$sql = "INSERT INTO mk_fcm_tokens_web (
			email,
			code,
			status) 
			VALUES (
			:mail,
			:code,
			'0')";
	$stmt = $PDO -> prepare($sql);
	$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
	$stmt->bindValue(':code', $code, PDO::PARAM_STR);
	$stmt->execute();

	$_SESSION['mail'] = $mail;
	
	// メール送信
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	$to = $mail;
	$title = 'パスコード：'.$code.' 「MEKEN」への仮登録';
	$content = 'パスコード：'.$code;
	$mailfrom="From:" .mb_encode_mimeheader("MEKEN") ."<pakara.keiba@gmail.com>";
	$pfrom = "-f pakara.keiba@gmail.com";
	if(mb_send_mail($to, $title, $content,$mailfrom,$pfrom)){
	} else {
		/*echo "not mail";
		exit();*/
	};
	
	header('content-type: application/json; charset=utf-8');
	echo json_encode(array(
		'result'=>'regist',
		'mail'=>$mail,
		'code'=>$code,
	));
}
?>

