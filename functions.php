<?php
function connect_to_db(){

  // $dbn = 'mysql:dbname=sotusei;charset=utf8;port=3306;host=localhost';
  // $user = 'root';
  // $pwd = '';

// ロリポップ用　ＤＢネーム、host名、$user名、$pwdを反映
  $dbn = 'mysql:dbname=4cc781db2531b71aaaac6a68d1cc4c49;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
  $user = '4cc781db2531b71aaaac6a68d1cc4c49';
  $pwd = 'Sugiyama@555';
    try {
    // ここでDB接続処理を実行する
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }

}