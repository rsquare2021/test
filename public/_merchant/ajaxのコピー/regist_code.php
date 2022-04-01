<?php
try {
	$dsn = 'mysql:dbname=laravel_local;host=db;charset=utf8;';
	$user = 'phper';
	$password = 'secret';
    $PDO = new PDO($dsn, $user, $password); //MySQLのデータベースに接続
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示
} catch (PDOException $e) {
	exit('接続できませんでした。' . $e->getMessage());
}

$code = filter_input( INPUT_POST, "code" );
$mail = filter_input( INPUT_POST, "mail" );

// メールアドレス認証
$sql = "SELECT email, code FROM mk_fcm_tokens_web WHERE email = :mail AND code = :code";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':code', $code, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();

if($count >= 1) {
	// 仮会員登録完了ステータスへアップデート
	$sql = "UPDATE  mk_fcm_tokens_web SET 
			status = '1'
			WHERE email = :mail
			";
	$stmt = $PDO -> prepare($sql);
	$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
	//一旦実行
	$stmt->execute();
	
	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'true',
		'mail'=>$mail
	]);
} else {
	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'false'
	]);
}
?>

