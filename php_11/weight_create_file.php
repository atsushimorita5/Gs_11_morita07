<?php
session_start();
include("atsumori_functions.php");


if (
  !isset($_POST['kg']) || $_POST['kg']=='' ||
  !isset($_POST['mezame']) || $_POST['mezame']=='' ||
  !isset($_POST['time']) || $_POST['time']=='' ||
  !isset($_POST['level']) || $_POST['level']=='' ||
  !isset($_POST['conditontext']) || $_POST['conditontext']=='' 
){
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$kg = $_POST["kg"];
$mezame = $_POST["mezame"];
$time = $_POST["time"];
$level = $_POST["level"];
$conditontext = $_POST["conditontext"];

if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  // 送信が正常に行われたときの処理(この後記述)
$uploaded_file_name = $_FILES['upfile']['name']; //ファイル名の取得 
$temp_path = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所 
$directory_path = 'upload/';
$extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION); 
$unique_name = date('YmdHis').md5(session_id()) . "." . $extension; 
$filename_to_save = $directory_path . $unique_name;
if (is_uploaded_file($temp_path)) {
  if (move_uploaded_file($temp_path, $filename_to_save)) {
  chmod($filename_to_save, 0644);
// 今回は権限を変更するところまで 
} else {
  exit('アップロードに失敗しました'); 
  } 
  } else {
    exit('ファイルがないです');
  }
  } else {
  exit('送信に失敗しました');
}

$pdo=connect_to_db();

$sql = 'INSERT INTO kadai_07(id, kg, mezame, time, level,conditontext,image)VALUES(NULL, :kg, :mezame, :time, :level, :conditontext,:image)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':kg', $kg, PDO::PARAM_STR); 
$stmt->bindValue(':mezame', $mezame, PDO::PARAM_STR); 
$stmt->bindValue(':time', $time, PDO::PARAM_STR); 
$stmt->bindValue(':level', $level, PDO::PARAM_STR); 
$stmt->bindValue(':conditontext', $conditontext, PDO::PARAM_STR); 
$stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
$status = $stmt->execute(); // SQLを実行

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:weight_input.php");
  exit();
}
