<?php
//var_dump($_POST);
//exit();
session_start(); 
include('atsumori_functions.php'); 

//var_dump($_SESSION);
$user_id = $_SESSION['user_id'];
//$cnt=$_SESSION['cnt'];


// DB接続情報
$dbn = 'mysql:dbname=morita-atushi_kadai_test;charset=utf8;port=3306;host=morita-atushi.sakura.ne.jp';
$user = 'morita-atushi';
$pwd = 'Moritago5';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

$sql = 'SELECT * FROM kadai_07
          LEFT OUTER JOIN (SELECT todo_id, COUNT(id) AS cnt
          FROM like_table GROUP BY todo_id) AS likes
          ON kadai_07.id = likes.todo_id';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    //var_dump($record); 中身が見える
    $output .= "<tr>";
    $output .= "<td>{$record["kg"]}</td>";
    $output .= "<td>{$record["mezame"]}</td>";
    $output .= "<td>{$record["time"]}</td>";
    $output .= "<td>{$record["level"]}</td>";
    $output .= "<td>{$record["conditontext"]}</td>";
    //$cnt = ;
    //$output .= "<td><a href='weight_like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>
    //like{$record["cnt"]}</a></td>";
    if($record["cnt"] == null){
    $output .= '<td><a class="like" href="weight_like_create.php?user_id='.
      $user_id.'&todo_id='.$record["id"].'"><i class="far fa-heart fa-fw"></i> </a></td>';
    }else{
    $output .= '<td><a class="like" href="weight_like_create.php?user_id='.
    $user_id.'&todo_id='.$record["id"].'"><i class="fas fa-heart"></i>'.$record["cnt"].'</a></td>';
    }
    $output .= "<td><a href='weight_edit.php?id={$record["id"]}'>戻る</a></td>";
    $output .= "<td><a href='weight_delete.php?id={$record["id"]}'>削除</a></td>";
    $output .= "<td><img src='{$record["image"]}' height=150px></td>";
    $output .= "</tr>";
} 
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Font Awesome -->
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<style>
  .like{
  text-decoration: none;
  color: #e00;
  display: flex;
  justify-content: center;
  }
</style>

<title>コンディショニングリスト</title>
</head>

<body>
<fieldset>
<legend>入力データリスト　こんにちは　</legend>
    <a href="weight_input.php">入力データ</a>
    <a href="weight_logout.php">ログアウト</a>
    <table>
    <thead>
    <tr>
    <th>集計データ集</th>
    </tr>
    </thead>
    <tbody>
    <?=$output?>
    </tbody>
    </table>
</fieldset>
</body>

</html>