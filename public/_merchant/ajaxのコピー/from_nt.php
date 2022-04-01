<?php
session_start();
try {
    $dsn = 'mysql:dbname=re_db;host=re-db.cfey8zsw9kkj.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
    $user = 'admin';
    $password = 're_secret';
    $PDO = new PDO($dsn, $user, $password);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('接続できませんでした。' . $e->getMessage());
}
$kengen = $_SESSION['kengen'];
$mk_id = $_SESSION['id'];
$modal_data_no = filter_input( INPUT_POST, "modal_data_no" );
$user_id = filter_input( INPUT_POST, "user_id" );
$modal_receipt_no = filter_input( INPUT_POST, "modal_receipt_no" );
$modal_tel = filter_input( INPUT_POST, "modal_tel" );
$modal_create = filter_input( INPUT_POST, "modal_create" );
$modal_h = filter_input( INPUT_POST, "modal_h" );
$modal_m = filter_input( INPUT_POST, "modal_m" );
$receipt_oil = filter_input( INPUT_POST, "receipt_oil" );
$check_oil = filter_input( INPUT_POST, "check_oil" );
$memo = filter_input( INPUT_POST, "memo" );
$action = filter_input( INPUT_POST, "action" );
$st_product = filter_input( INPUT_POST, "st_product" );
$st_oil = filter_input( INPUT_POST, "st_oil" );
$st_input = filter_input( INPUT_POST, "st_input" );
$st_diff = filter_input( INPUT_POST, "st_diff" );
$st_term = filter_input( INPUT_POST, "st_term" );
$st_shop = filter_input( INPUT_POST, "st_shop" );
$st_duplicate = filter_input( INPUT_POST, "st_duplicate" );
$st_ngword = filter_input( INPUT_POST, "st_ngword" );
$st_count = filter_input( INPUT_POST, "st_count" );
$modal_time = $modal_h.':'.$modal_m;
$now_status = $st_product.$st_oil.$st_input.$st_diff.$st_term.$st_shop.$st_duplicate.$st_ngword.$st_count;

//承認
if($action == 'nt_accept') {
    if(!empty($modal_receipt_no) && !empty($modal_tel) && !empty($modal_create)) {
        $sql = "SELECT * FROM receipts WHERE NOT (id = :modal_data_no) AND mk_no = :modal_receipt_no AND mk_tel = :modal_tel AND mk_date = :modal_create AND mk_time = :modal_time";
        $stmt = $PDO -> prepare($sql);
        $stmt->bindValue(':modal_tel', $modal_tel, PDO::PARAM_STR);
        $stmt->bindValue(':modal_receipt_no', $modal_receipt_no, PDO::PARAM_STR);
        $stmt->bindValue(':modal_create', $modal_create, PDO::PARAM_STR);
        $stmt->bindValue(':modal_time', $modal_time, PDO::PARAM_STR);
        $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt -> rowCount() > 0){
            header('content-type: application/json; charset=utf-8');
            echo json_encode(array(
                "result" => false,
                "double" => true,
                "reason" => "重複したレシートです。"
            ));
            exit();
        }
    }
    $sql = "UPDATE receipts SET
            status = '95',
            receipt_memo = :memo,
            mk_no = :modal_receipt_no,
            mk_tel = :modal_tel,
            mk_date = :modal_create,
            mk_time = :modal_time,
            mk_value = :check_oil,
            meken_value = '$now_status',
            updated_at = CURRENT_TIMESTAMP
            WHERE id = :modal_data_no";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
    $stmt->bindValue(':modal_receipt_no', $modal_receipt_no, PDO::PARAM_STR);
    $stmt->bindValue(':modal_tel', $modal_tel, PDO::PARAM_STR);
    $stmt->bindValue(':modal_create', $modal_create, PDO::PARAM_STR);
    $stmt->bindValue(':modal_time', $modal_time, PDO::PARAM_STR);
    $stmt->bindValue(':check_oil', $check_oil, PDO::PARAM_STR);
    $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
    $stmt->execute();

    if($check_oil) {
        $oil = $check_oil;
    } else {
        $oil = $receipt_oil;
    }
    $oil = intval($oil);
    $oil = floor($oil / 2);
    $sql = "INSERT INTO users_pre_points (
            receipt_id,
            point,
            created_at,
            updated_at
            ) VALUES (
            :modal_data_no,
            :oil,
            CURRENT_TIMESTAMP,
            CURRENT_TIMESTAMP
            );";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
    $stmt->bindValue(':oil', $oil, PDO::PARAM_STR);
    $stmt->execute();
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
        "result" => 'nt_accept',
        "back_id" => $modal_data_no,
        "reason" => "承認しました。"
    ));
}

//否認
if($action == 'nt_reject') {
    if(!empty($modal_receipt_no) && !empty($modal_tel) && !empty($modal_create)) {
        $sql = "SELECT * FROM receipts WHERE NOT (id = :modal_data_no) AND mk_no = :modal_receipt_no AND mk_tel = :modal_tel AND mk_date = :modal_create AND mk_time = :modal_time";
        $stmt = $PDO -> prepare($sql);
        $stmt->bindValue(':modal_tel', $modal_tel, PDO::PARAM_STR);
        $stmt->bindValue(':modal_receipt_no', $modal_receipt_no, PDO::PARAM_STR);
        $stmt->bindValue(':modal_create', $modal_create, PDO::PARAM_STR);
        $stmt->bindValue(':modal_time', $modal_time, PDO::PARAM_STR);
        $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt -> rowCount() > 0){
            $sql = "UPDATE receipts SET
                    status = '97',
                    receipt_memo = :memo,
                    mk_no = :modal_receipt_no,
                    mk_tel = :modal_tel,
                    mk_date = :modal_create,
                    mk_time = :modal_time,
                    mk_value = :check_oil,
                    meken_value = '$now_status'
                    WHERE id = :modal_data_no";
            $stmt = $PDO -> prepare($sql);
            $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
            $stmt->bindValue(':modal_receipt_no', $modal_receipt_no, PDO::PARAM_STR);
            $stmt->bindValue(':modal_tel', $modal_tel, PDO::PARAM_STR);
            $stmt->bindValue(':modal_create', $modal_create, PDO::PARAM_STR);
            $stmt->bindValue(':modal_time', $modal_time, PDO::PARAM_STR);
            $stmt->bindValue(':check_oil', $check_oil, PDO::PARAM_STR);
            $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
            $stmt->execute();
            header('content-type: application/json; charset=utf-8');
            echo json_encode(array(
                "result" => 'nt_reject_duplicate',
                "back_id" => $modal_data_no,
                "reason" => "否認したレシートは重複したレシートでした。"
            ));
            exit();
        }
    }
    $sql = "UPDATE receipts SET
            status = '96',
            receipt_memo = :memo,
            mk_no = :modal_receipt_no,
            mk_tel = :modal_tel,
            mk_date = :modal_create,
            mk_time = :modal_time,
            mk_value = :check_oil,
            meken_value = '$now_status'
            WHERE id = :modal_data_no";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
    $stmt->bindValue(':modal_receipt_no', $modal_receipt_no, PDO::PARAM_STR);
    $stmt->bindValue(':modal_tel', $modal_tel, PDO::PARAM_STR);
    $stmt->bindValue(':modal_create', $modal_create, PDO::PARAM_STR);
    $stmt->bindValue(':modal_time', $modal_time, PDO::PARAM_STR);
    $stmt->bindValue(':check_oil', $check_oil, PDO::PARAM_STR);
    $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
    $stmt->execute();
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
        "result" => 'nt_reject',
        "back_id" => $modal_data_no,
        "reason" => "否認しました。"
    ));
}

//不正
if($action == 'nt_illegal') {
    $sql = "UPDATE receipts SET
            status = '98',
            receipt_memo = :memo,
            mk_no = :modal_receipt_no,
            mk_tel = :modal_tel,
            mk_date = :modal_create,
            mk_time = :modal_time,
            mk_value = :check_oil,
            meken_value = '$now_status'
            WHERE id = :modal_data_no";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
    $stmt->bindValue(':modal_receipt_no', $modal_receipt_no, PDO::PARAM_STR);
    $stmt->bindValue(':modal_tel', $modal_tel, PDO::PARAM_STR);
    $stmt->bindValue(':modal_create', $modal_create, PDO::PARAM_STR);
    $stmt->bindValue(':modal_time', $modal_time, PDO::PARAM_STR);
    $stmt->bindValue(':check_oil', $check_oil, PDO::PARAM_STR);
    $stmt->bindValue(':modal_data_no', $modal_data_no, PDO::PARAM_STR);
    $stmt->execute();
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
        "result" => 'nt_illegal',
        "back_id" => $modal_data_no,
        "reason" => "不正で処理しました。"
    ));
}
?>

