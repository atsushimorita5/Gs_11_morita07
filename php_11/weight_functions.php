<?php

function connect_to_db()
{
  $dbn = 'mysql:dbname=morita-atushi_kadai_test;charset=utf8;port=3306;host=morita-atushi.sakura.ne.jp';
  $user = 'morita-atushi';
  $pwd = 'Moritago5';

try {
    // ここでDB接続処理を実行する
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}
//これ鉄板↓
function check_session_id () {
// 失敗時はログイン画面に戻る
if (!isset($_SESSION['session_id']) || // session_idがない
$_SESSION['session_id'] != session_id()// idが一致しない
){header('Location: weight_login.php'); // ログイン画面へ移動 
} else {
session_regenerate_id(true); // セッションidの再生成
$_SESSION['session_id'] = session_id(); // セッション変数上書き 
}
}


