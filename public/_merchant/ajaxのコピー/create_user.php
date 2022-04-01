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

$kengen = $_SESSION["kengen"];
$company_id = $_SESSION["company_id"];

if($kengen != 1 || $company_id == null){
    header('content-type: application/json; charset=utf-8');
	echo json_encode([
		'result'=>false
	]);
	exit();
}

$user_id = filter_input(INPUT_POST, "user_id");
$id_token = openssl_random_pseudo_bytes(10);
$id = bin2hex($id_token);

$pass_token = openssl_random_pseudo_bytes(4);
$pass = bin2hex($pass_token);

$sql = "INSERT INTO mk_users (
    id,
    pass,
    mail,
    active,
    company_id) 
    VALUES (
    :id,
    :pass,
    :mail,
    '1',
    :company_id)";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':mail', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
$stmt->bindValue(':company_id', $company_id, PDO::PARAM_STR);
//一旦実行
$stmt->execute();

header('content-type: application/json; charset=utf-8');
echo json_encode([
'result'=>'true',           //文字列に by kino 6/21
'id'=>$id
]);

?>