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

// idを2種類生成
$id_token = openssl_random_pseudo_bytes(10);
$id = bin2hex($id_token);
$hash = password_hash(filter_input( INPUT_POST, "password" ), PASSWORD_BCRYPT);
$mail = $_SESSION['mail'];

if($mail == '') {
	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'already'
	]);
	exit();
}

// 重複チェック
$sql = "SELECT mail FROM mk_users WHERE mail = :mail";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	if($row) {
		header('content-type: application/json; charset=utf-8');
		echo json_encode([
			'result'=>'already'
		]);
	}
	exit();
}
// メールアドレスのステータスチェック
$sql = "SELECT status FROM mk_fcm_tokens_web WHERE email = :mail";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$status = $row['status'];
}

// ステータスをチェックし処理を分岐
if($status === '1') {
	
	$sql = "INSERT INTO mk_users (
			id,
			pass,
			mail,
			active) 
			VALUES (
			:id,
			:pass,
			:mail,
			'1')";
	$stmt = $PDO -> prepare($sql);
	$stmt->bindValue(':id', $id, PDO::PARAM_STR);
	$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
	$stmt->bindValue(':pass', $hash, PDO::PARAM_STR);
	//一旦実行
	$stmt->execute();

	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'true',           //文字列に by kino 6/21
		'id'=>$id
	]);
} else {
	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'false'       //文字列に by kino 6/21
	]);
}
?>

