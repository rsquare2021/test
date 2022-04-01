<?php
try {
    $dsn = 'mysql:dbname=laravel_local;host=db;charset=utf8;';
	$user = 'phper';
	$password = 'secret';
    $PDO = new PDO($dsn, $user, $password);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('接続できませんでした。' . $e->getMessage());
}
$id = filter_input( INPUT_POST, "id" );
$action = filter_input( INPUT_POST, "action" );
$status = filter_input( INPUT_POST, "status" );
$date = filter_input( INPUT_POST, "date" );
$time = filter_input( INPUT_POST, "time" );
$value = filter_input( INPUT_POST, "value" );
$point = filter_input( INPUT_POST, "point" );

//承認
if($action == 'meken_regist') {
    $sql = "UPDATE receipts SET
            status = '95',
            mk_date = :date,
            mk_time = :time,
            mk_value = :value,
            point = :point,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :id";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':time', $time, PDO::PARAM_STR);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->bindValue(':point', $point, PDO::PARAM_STR);
    $stmt->execute();
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
        "result" => true,
        "status" => '承認',
        "id" => $id,
    ));
}

//否認
if($action == 'meken_reject') {
    $sql = "UPDATE receipts SET
            status = '96',
            mk_date = :date,
            mk_time = :time,
            mk_value = :value,
            point = :point,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :id";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':time', $time, PDO::PARAM_STR);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->bindValue(':point', $point, PDO::PARAM_STR);
    $stmt->execute();
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
        "result" => true,
        "status" => '否認',
        "id" => $id,
    ));
}

//不正
if($action == 'meken_illegal') {
    $sql = "UPDATE receipts SET
            status = '98',
            mk_date = :date,
            mk_time = :time,
            mk_value = :value,
            point = :point,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :id";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':time', $time, PDO::PARAM_STR);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->bindValue(':point', $point, PDO::PARAM_STR);
    $stmt->execute();
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
        "result" => true,
        "status" => '不正',
        "id" => $id,
    ));
}
?>

