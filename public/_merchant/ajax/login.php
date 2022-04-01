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

$mail = filter_input( INPUT_POST, "mail" );
$pass = filter_input( INPUT_POST, "password" );

$sql = 'SELECT * FROM mk_users WHERE mail = :mail AND pass = :pass AND active = 1';
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
$stmt->execute();
//$user = $stmt->fetch(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

// パスワードチェック
if($count == 0){
	header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>'false'
	]);
} else {
	/*$sql = 'SELECT * FROM mk_users WHERE mail = :mail';
	$stmt = $PDO -> prepare($sql);
	$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
	$stmt->execute();*/ 

	$data = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$_SESSION['id'] = $row['id'];
		$_SESSION['kengen'] = $row['kengen'];
		$_SESSION['company_id'] = $row['company_id'];
	}

	header('content-type: application/json; charset=utf-8');
	echo json_encode($data);
}
?>

