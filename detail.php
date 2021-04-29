<?php
session_start();
// 関数ファイルの読み込み
include("functions.php");
// check_session_id();

// // ユーザid取得
$user_id = $_SESSION['id'];

$id = $_GET["id"];

$pdo = connect_to_db();
// データ取得SQL作成
$sql = 'SELECT * FROM event_reg WHERE id=:id';


// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);

}

// // 参加カウント
// $sql = 'SELECT * FROM event_reg 
//           LEFT OUTER JOIN (SELECT event_id, COUNT(id) AS cnt 
//           FROM event_join GROUP BY event_id) AS joins 
//           ON event_reg.id = joins.event_id';

// // SQL準備&実行
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute();
// // データ登録処理後
// if ($status == false) {
//   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
//   $error = $stmt->errorInfo();
//   echo json_encode(["error_msg" => "{$error[2]}"]);
//   exit();
// } else {
//   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
//   // fetchAll()関数でSQLで取得したレコードを配列で取得できる
//   $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
//   $output = "";
// }

//   foreach ($result as $record) {
//     $output .= "<tr>";
//     $output .= "<td>{$record["name"]}</td>";
//     $output .= "<td>{$record["detail"]}</td>";
//     $output .= "<td>{$record["daytime"]}</td>";
//     $output .= "<td>{$record["place"]}</td>";
//     // $output .= "<td>{$record["latitude"]}</td>";
//     // $output .= "<td>{$record["longitude"]}</td>";
//      // 画像出力を追加しよう
//     // $output .= "<td><img src='{$record["picture"]}' height=150px></td>";
//     // 参加するボタン
//     $output .= "<td><a href='join.php?user_id={$user_id}&event_id={$record["id"]}'>参加する{$record["cnt"]}</a></td>";
//     // 詳細ボタン
//     //  $output .= "<td><a href='detail.php?id={$record["id"]}'>詳細</a></td>";
//     //削除ボタン
//     // $output .= "<td><a href='delete.php?id={$record["id"]}'>削除</a></td>";
//     $output .= "</tr>";
//   }
// //   // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
// //   // 今回は以降foreachしないので影響なし
//   unset($value);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>イベント詳細画面</title>
     <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcqyHgG8qoOhgLHJ0B9anrIYWGcbHQqsk&language=ja"></script>
<script src="event_input_map.js" ></script>
<style>
  html { height: 100% }
  body { height: 100% }
  #map { height: 100%; width: 100%}
</style>
</head>

<body>
<fieldset>

<legend>イベント詳細</legend>
<table>
<tr>
<td>イベント名:</td>
<td> <?= $record["name"] ?></td>
</tr>
<tr>
<td>コメント:</td>
<td> <?= $record["detail"] ?></td>
</tr>
<tr>
<td>開催日:</td>
<td> <?= $record["daytime"] ?></td>
</tr>
<tr>
<td>場所:</td>
<td><a href='event_input_map.php'>地図</a></td>
</tr>
<!-- <td>参加可否:</td>
<td>参加する <?=$record["cnt"]?></td>
<td><a href='join.php?user_id={$user_id}&event_id={$record["id"]}'>参加する{$record["cnt"]}</a></td> -->

</table>
</fieldset> 

</body>
<a href="event_all.php">イベント一覧へ</a>
<a href="top.php">トップへ</a>
</html>