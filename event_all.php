<?php
session_start();
include("functions.php");
// check_session_id();

// ユーザid取得
$user_id = $_SESSION['id'];

// include('functions.php');
// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
// $sql = 'SELECT * FROM event_reg';
// 参加カウント
$sql = 'SELECT * FROM event_reg 
          LEFT OUTER JOIN (SELECT event_id, COUNT(id) AS cnt 
          FROM event_join GROUP BY event_id) AS joins 
          ON event_reg.id = joins.event_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["name"]}</td>";
    $output .= "<td>{$record["detail"]}</td>";
    $output .= "<td>{$record["daytime"]}</td>";
    $output .= "<td>{$record["place"]}</td>";
    $output .= "<td>{$record["latitude"]}</td>";
    $output .= "<td>{$record["longitude"]}</td>";
     // 画像出力を追加しよう
    $output .= "<td><img src='{$record["picture"]}' height=150px></td>";
    // 参加するボタン
    $output .= "<td><a href='join.php?user_id={$user_id}&event_id={$record["id"]}'>参加者{$record["cnt"]}　人</a></td>";
    // $output .= "<td><a href=''>参加する{$record["cnt"]}</a></td>";
    // 詳細ボタン
     $output .= "<td><a href='detail.php?id={$record["id"]}'>詳細</a></td>";
    //削除ボタン
    $output .= "<td><a href='delete.php?id={$record["id"]}'>削除</a></td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>イベントリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>イベントリスト（一覧画面）</legend>
    <a href="event_input.php">入力画面</a>
    <a href="top.php">トップへ</a>
    <table>
      <thead>
        <tr>
          <th>name</th>
          <th>detail</th>
          <th>daytime</th>
          <th>place</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>
