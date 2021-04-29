
<?php

// var_dump($_GET);
// exit();

session_start();
include("functions.php");
// check_session_id();
// // ユーザid取得
$user_id = $_SESSION['id'];

$user_id = $_GET['user_id'];
$event_id = $_GET['event_id'];

$pdo = connect_to_db();

//SQLカウント
$sql ="SELECT COUNT(*) FROM event_join WHERE user_id=:user_id AND event_id=:event_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':event_id', $event_id, PDO::PARAM_STR);
$status = $stmt->execute();
// echo "ここまで";

//失敗した場合のエラー
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("sqlError:" . $error[2]);
} else {
  $join_count =$stmt->fetch();
//   var_dump($join_count[0]);
//     exit();
if ($join_count[0] != 0) {
  $sql = 'DELETE FROM event_join 
            WHERE user_id=:user_id AND event_id=:event_id';
} else {
  $sql = 'INSERT INTO event_join (id, user_id, event_id, created_at)
            VALUES(NULL, :user_id, :event_id, sysdate())';
}
//SQL作成＆実行
// $sql = "INSERT INTO event_join (id,user_id,event_id,created_at) VALUES(NULL,:user_id,:event_id,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':event_id', $event_id, PDO::PARAM_STR);
$status = $stmt->execute();

//失敗した場合のエラー
if ($status == false) {
    $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
    // header("Location:event_all.php");
     header("Location:event_all.php");
    exit();
}
}







?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>参加登録</title>
</head>
<body>
<form action="join_act.php" method="POST">

<div>
イベントID : <?= $record["name"] ?>
</div>

<div>
ユーザーID（メールアドレス）：<input type="text" name=user_id>
</div>




</form>


    
</body>
</html> -->