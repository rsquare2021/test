<?php
//////////////////////////////////////////////////////////
// DB
//////////////////////////////////////////////////////////
//setlocale(LC_ALL, 'ja_JP.UTF-8');
try {
  $dsn = 'mysql:dbname=laravel_local;host=db;charset=utf8;';
  $user = 'phper';
  $password = 'secret';
  $PDO = new PDO($dsn, $user, $password);
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
  exit('接続できませんでした。' . $e->getMessage());
}

//////////////////////////////////////////////////////////
// 変数セット
//////////////////////////////////////////////////////////
$campaign_id = filter_input(INPUT_POST,"campaign_id");
$user_id = filter_input(INPUT_POST,"user_id");
$pay_date = filter_input(INPUT_POST,"pay_date");
$time = filter_input(INPUT_POST,"time");
$tel = filter_input(INPUT_POST,"tel");
$re_value = filter_input(INPUT_POST,"re_value");
$isNg = filter_input(INPUT_POST,"isNg");

//////////////////////////////////////////////////////////
// 自分のレシートをチェック
//////////////////////////////////////////////////////////
if(!$tel) {
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "shop" => 'none',
  ));
  exit();
}

$sql = "SELECT * FROM receipts 
        WHERE campaign_id = :campaign_id AND user_id = :user_id AND mk_date = :pay_date AND mk_time = :time AND mk_tel = :tel AND receipt_value = :re_value";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':campaign_id', $campaign_id, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':pay_date', $pay_date, PDO::PARAM_STR);
$stmt->bindValue(':time', $time, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':re_value', $re_value, PDO::PARAM_STR);
$stmt->execute();
if($stmt -> rowCount() > 0){
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "double" => 'self',
  ));
  exit();
}

//////////////////////////////////////////////////////////
// 他の応募者のレシートをチェック
//////////////////////////////////////////////////////////
$sql = "SELECT * FROM receipts 
        WHERE campaign_id = :campaign_id AND mk_date = :pay_date AND mk_time = :time AND mk_tel = :tel AND receipt_value = :re_value";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':campaign_id', $campaign_id, PDO::PARAM_STR);
$stmt->bindValue(':pay_date', $pay_date, PDO::PARAM_STR);
$stmt->bindValue(':time', $time, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':re_value', $re_value, PDO::PARAM_STR);
$stmt->execute();
if($stmt -> rowCount() > 0){
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "double" => 'other',
  ));
  exit();
}

//////////////////////////////////////////////////////////
// 店舗情報確認
//////////////////////////////////////////////////////////
$sql = "SELECT * FROM flat_shop_tree_elements WHERE root_id = 1 AND depth = 3 AND tel = :tel";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->execute();
if($stmt -> rowCount() == 0){
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "shop" => 'ng',
  ));
  exit();
}

  

header('content-type: application/json; charset=utf-8');
echo json_encode(array(
  "result" => true,
));
?>
