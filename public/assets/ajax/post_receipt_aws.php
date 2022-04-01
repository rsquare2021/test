<?php
//////////////////////////////////////////////////////////
// DB
//////////////////////////////////////////////////////////
//setlocale(LC_ALL, 'ja_JP.UTF-8');
try {
  $dsn = 'mysql:dbname=laravel_local;host=db;charset=utf8;';
  $user = 'phper';
  $password = 'secret';
  $dsn = 'mysql:dbname=re_db;host=re-db.cfey8zsw9kkj.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
  $user = 'admin';
  $password = 're_secret';
  $PDO = new PDO($dsn, $user, $password);
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
  exit('接続できませんでした。' . $e->getMessage());
}


//////////////////////////////////////////////////////////
// 変数セット
//////////////////////////////////////////////////////////
/*
  str = レシートで読み取った文字
  tel = 電話番号
  no = レシートナンバー
  pay_date = レシートに記載された日付php
  point = 数量に対するポイント
  user_id = レシート送信者ID
  campaign_id = レシート送信したキャンペーンID
  val = 入力した給油量
  products = 商品名 & 給油量の組み合わせ
  isChange = 
  isNg = NGリストの文字が含まれる
  receipt_path = レシート画像パス
  fileName & temp_path & target_path & directory_path = 画像保存用
  start_time = レシート受け付け開始年月日
  end_time = レシート受け付け終了年月日
  term = 対象期間外の場合true
  isShopNg = 対象期間外の場合true
  double = 重複していた場合true
  re_point = レシートに記載されている給油量から計算したポイント
  re_oil = レシートに記載されている給油量
  productNg = 対象商品がない場合はtrue
  campaign_shop_tree = キャンペーン参加店舗ツリー
  company = レシートに記載されている会社名
  tel_blank = 電話番号ではない
*/
$str = filter_input(INPUT_POST,"str");
$tel = filter_input(INPUT_POST,"tel");
$no = filter_input(INPUT_POST,"no");
$pay_date = filter_input(INPUT_POST,"pay_date");
$point = filter_input(INPUT_POST,"point");
$user_id = filter_input(INPUT_POST,"user_id");
$campaign_id = filter_input(INPUT_POST,"campaign_id");
$val = filter_input(INPUT_POST,"val");
$products = filter_input(INPUT_POST,"products");
$isChange = filter_input(INPUT_POST,"isChange");
$isNg = filter_input(INPUT_POST,"isNg");
$isLightNg = filter_input(INPUT_POST,"isLightNg");
$receipt_path = "/receipt/".$campaign_id."/".$user_id."_".date("YmdHis").".jpg";
$fileName = $_FILES['image']['name'];
$tmp_path = $_FILES['image']['tmp_name'];//mb_convert_encoding($_FILES['file']['tmp_name'], "cp932", "utf8");
$directory_path = dirname(__FILE__)."/receipt/".$campaign_id."/";
$target_path = dirname(__FILE__).$receipt_path;
$start_time = filter_input(INPUT_POST,"start_time");
$end_time = filter_input(INPUT_POST,"end_time");
$term = filter_input(INPUT_POST,"term");
$re_point = filter_input(INPUT_POST,"re_point");
$re_oil = filter_input(INPUT_POST,"re_oil");
$productNg = filter_input(INPUT_POST,"productNg");
$campaign_shop_tree = filter_input(INPUT_POST,"campaign_shop_tree");
$com = filter_input(INPUT_POST,"com");
$isAccept = filter_input(INPUT_POST,"accept");
$tel_blank = filter_input(INPUT_POST,"telBlank");
//$str = mb_convert_encoding($str, "UTF-8", "auto");
//$tel = mb_convert_encoding($tel, "UTF-8", "auto");
//$pay_date = mb_convert_encoding($pay_date, "UTF-8", "auto");


//////////////////////////////////////////////////////////
// 登録処理中断
//////////////////////////////////////////////////////////
// 画像が取得できない
if(!is_uploaded_file($_FILES["image"]["tmp_name"])) {
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "reason" => "受け付けできませんでした。<br>レシート撮影時の注意事項を確認の上、再度送信してください。"
  ));
  exit();
}

// レシートが重複している（no tel pay_date）
//$isAccept エラー後の再撮影は許可?
if($isAccept == 0){
  if(!empty($no) && !empty($tel) && !empty($pay_date)) {
    $sql = "SELECT * FROM receipts WHERE no = :no AND tel = :tel AND pay_date = :pay_date";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindValue(':no', $no, PDO::PARAM_STR);
    $stmt->bindValue(':pay_date', $pay_date, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt -> rowCount() > 0){
      header('content-type: application/json; charset=utf-8');
      echo json_encode(array(
        "result" => false,
        "double" => true,
        "reason" => "既に登録されているレシートです。"
      ));
      exit();
    }
  }
  if(!empty($tel)) {
    $sql = "SELECT * FROM flat_shop_tree_elements WHERE root_id = 1 AND depth = 3 AND tel = :tel";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt -> rowCount();
    if($stmt -> rowCount() == 0){
      header('content-type: application/json; charset=utf-8');
      echo json_encode(array(
        "result" => false,
        "isShopNg" => true,
        "reason" => "対象外の店舗の可能性があります。"
      ));
      exit();
    }
  } elseif(empty($tel) || $tel_blank == 1) {
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
      "result" => false,
      "reason" => "店舗が読み取れません。"
    ));
    exit();
  }
}

// 再送信の重複確認
$isDouble = 0;
if($isAccept == 1){
  if(!empty($no) && !empty($tel) && !empty($pay_date)) {
    $sql = "SELECT * FROM receipts WHERE no = :no AND tel = :tel AND pay_date = :pay_date";
    $stmt = $PDO -> prepare($sql);
    $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindValue(':no', $no, PDO::PARAM_STR);
    $stmt->bindValue(':pay_date', $pay_date, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt -> rowCount() > 0){
      $isDouble = 1;
    }
  }
}

// 店舗特定
$isShopNg = 0;
$sql = "SELECT * FROM flat_shop_tree_elements WHERE root_id = 1 AND depth = 3 AND tel = :tel";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt -> rowCount();
if($stmt -> rowCount() == 0){
  $isShopNg = 1;
}

// 明らかに対象期間のレシートではない 0532-45-8185
// 店舗が特定できない
// if($isAccept == 0){
//   $sql = "SELECT * FROM flat_shop_tree_elements WHERE root_id = 1 AND depth = 3 AND tel = :tel";
//   $stmt = $PDO -> prepare($sql);
//   $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
//   $stmt->execute();
//   $count = $stmt -> rowCount();
//   if($stmt -> rowCount() == 0){
//     header('content-type: application/json; charset=utf-8');
//     echo json_encode(array(
//       "result" => false,
//       "isShopNg" => true,
//       "reason" => "受け付けできませんでした。<br>レシート撮影時の注意事項を確認の上、再度送信してください。"
//     ));
//     exit();
//   }
// }

//フロント側で判定済み
// 獲得ポイントが0
/*
if($point == '0') {
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "reason" => "獲得できるポイントがありません。"
  ));
  exit();
}
// 対象商品のレシートではない
if(!$products) {
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false,
    "reason" => "受け付けできませんでした。<br>レシート撮影時の注意事項を確認の上、再度送信してください。"
  ));
  exit();
}
*/



//////////////////////////////////////////////////////////
// ステータス分岐
//////////////////////////////////////////////////////////
// 初期ステータス = 000000000
// ステータス初期セット
$status_product = "0"; //1_対象商品
$status_oil = "0"; //2_給油量
$status_input = "0"; //3_自己申告
$status_diff = "0"; //4_自己申告と実際の給油量の差
$status_term = "0"; //5_対象期間
$status_shop = "0"; //6_対象店舗
$status_double = "0"; //7_重複
$status_ngword = "0"; //8_NGワード
$status_count = "0"; //9_強制送信
// 1_対象商品のレシートではない 100000000
if($productNg == "1") {
  $status_product = "1";
}
// 2_レシートに記載されている給油量が不明 010000000
if($re_oil == '' || is_null($re_oil)) {
  $status_oil = "2";
}
// 2_レシートに記載されている給油量から計算したポイントが0以下 020000000
if($re_point <= '0') {
  $status_oil = "1";
}
// 3_給油量をユーザーが変更 001000000
if((int)$isChange == 1){
  $status_input = "1";
}
// 4_レシートの給油量とユーザー入力の給油量に差がある 000100000
$floor_val = floor($val);
if($re_oil) {
  $floor_re_oil = floor($re_oil);
} else {
  $floor_re_oil = 0;
}
if($floor_val != $floor_re_oil) {
  $status_diff = "1";
}
// 5_レシート日時が不明 000010000
if($pay_date == '' || is_null($pay_date)) {
  $status_term = "2";
  // $status_term = "0";
}
// 5_キャンペーン期間 000020000
if((int)$term == 1) {
  $status_term = "1";
  // $status_term = "0";
}
// 6_対象店舗 000001000
if($tel == '') {
  $status_shop = 2;
} elseif($isShopNg == 1) {
  $status_shop = 1;
}
// 7_重複 000000100
if($isDouble == 1) {
  $status_double = 1;
}
// 8_NGリストの単語が見つかった 000000010
if((int)$isNg == 1){
  $status_ngword = "1";
}elseif($isLightNg == 1) {
  $status_ngword = "2";
}
// 9_撮り直し 000000001
if($isAccept) {
  $status_count = "1";
}

// $status = "0";
// // NGリストに含まれているかを確認
// if((int)$isNg == 1){
//   $status = "4";
// } else {
//   // 給油量をユーザーが変更しているか
//   if((int)$isChange == 1){
//     if($status != "0")$status .= ",";
//     $status .= "1";
//   }
//   // 200Lを超えるの給油か
//   if((float)$val > 200){
//     if($status != "0")$status .= ",";
//     $status .= "3";
//   }
//   /*$items = preg_split("/&I/",$products);
//   foreach($items as $item){
//     $co = preg_split("/&C/",$item);
//     var_dump($co);
//     if((float)$co[1] > 200 ){
//       $status = 3;
//     }
//   }*/
// }
// 最終ステータス
$status = $status_product.$status_oil.$status_input.$status_diff.$status_term.$status_shop.$status_double.$status_ngword.$status_count;
// $status = serialize(
// 	array(
// 		'product' => $status_product,
//     'oil' => $status_oil,
//     'self' => $status_input,
//     'diff' => $status_diff,
//     'term' => $status_term,
//     'shop' => $status_shop,
//     'double' => $status_double,
//     'ng' => $status_ngword,
//     'forced' => $status_count,
// 	)
// );

//////////////////////////////////////////////////////////
// レシート画像処理
//////////////////////////////////////////////////////////
if(file_exists($directory_path)){
}
else{
	if(mkdir($directory_path, 0777)){
		chmod($directory_path, 0777);
  }else{
  }
}
if(is_uploaded_file($tmp_path) ) {
	if(move_uploaded_file($tmp_path, $target_path)){
	}
  else{
    header('content-type: application/json; charset=utf-8');
    echo json_encode(array(
      "result" => false
    ));
    exit();
  }
}
else{
  header('content-type: application/json; charset=utf-8');
  echo json_encode(array(
    "result" => false
  ));
  exit();
}


//////////////////////////////////////////////////////////
// receiptsテーブル
//////////////////////////////////////////////////////////
$sql = "INSERT INTO receipts (
  campaign_id,
  user_id,
  point,
  products,
  tel,
  no,
  status,
  pay_date,
  receipt_path,
  mk_status,
  company,
  receipt_value,
  receipt_str,
  receipt_memo,
  created_at,
  updated_at) 
  VALUES (
  :campaign_id,
  :user_id,
  :point,
  :products,
  :tel,
  :no,
  0,
  :pay_date,
  :receipt_path,
  :status,
  :com,
  :val,
  :receipt_str,
  '',
  CURRENT_TIMESTAMP,
  CURRENT_TIMESTAMP)";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':campaign_id', $campaign_id, PDO::PARAM_INT);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':point', $point, PDO::PARAM_INT);
$stmt->bindValue(':products', $products, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':no', $no, PDO::PARAM_STR);
$stmt->bindValue(':pay_date', $pay_date, PDO::PARAM_STR);
$stmt->bindValue(':receipt_path', $receipt_path, PDO::PARAM_STR);
$stmt->bindValue(':receipt_str', $str, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->bindValue(':com', $com, PDO::PARAM_STR);
$stmt->bindValue(':val', $val, PDO::PARAM_STR);
$stmt->execute();
//echo $campaign_id.",".$user_id.",".$tel.",".$pay_date.",".$receipt_path.",".$val.",".$str;


//////////////////////////////////////////////////////////
// users_pre_pointsテーブル
//////////////////////////////////////////////////////////
// 送信したレシートをチェック
$sql = "SELECT id,mk_status FROM receipts WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
$stmt = $PDO -> prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$po_id = null;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  if($row["mk_status"] == "0") {
    $po_id = $row["id"];
  }
}
// 送信したレシートが目検ステータス0だった場合
if($po_id) {
  $sql = "INSERT INTO users_pre_points (
    receipt_id,
    point,
    created_at,
    updated_at)
    VALUES(
    :point_id,
    :point,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP)";
    
  $stmt = $PDO -> prepare($sql);
  $stmt->bindValue(':point_id', (int)$po_id, PDO::PARAM_INT);
  $stmt->bindValue(':point', (int)$point, PDO::PARAM_INT);
  $stmt->execute();
}


header('content-type: application/json; charset=utf-8');
echo json_encode(array(
  "result" => true,
));
?>
