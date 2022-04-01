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

$company_id = $_SESSION['company_id'];
$id = filter_input(INPUT_POST, "id");
$is_active = filter_input(INPUT_POST, "active");

$sql = 'UPDATE mk_users SET active = :active WHERE id = :id AND company_id = :company_id';
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':active', $is_active, PDO::PARAM_INT);
$stmt->execute();

header('content-type: application/json; charset=utf-8');
echo json_encode(array(
    "result" => true
));

?>