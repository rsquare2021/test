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

$id = $_SESSION['id'];
$company_id = $_SESSION['company_id'];

$sql = 'SELECT * FROM mk_users WHERE id != :id AND company_id = :company_id';
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->execute();

$json = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $json[] = array(
        "id" => $row["id"],
        "mail" => $row["mail"],
        "pass" => $row["pass"],
        "active" => $row["active"],
    );
}

header('content-type: application/json; charset=utf-8');
	echo json_encode($json);

?>