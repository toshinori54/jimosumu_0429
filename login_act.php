<?php
// var_dump($_POST);
// exit();

session_start();
include("functions.php");
$pdo = connect_to_db();
$email = $_POST["email"];
$password = $_POST["password"];

//DBにデータがあるか検索
$sql = 'SELECT * FROM users 
          WHERE email=:email 
            AND password=:password ;
            -- AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}else {
    $val = $stmt->fetch(PDO::FETCH_ASSOC); // 該当レコードだけ取得
    if (!$val) { // 該当データがないときはログインページへのリンクを表示
        echo "<p>ログイン情報に誤りがあります．</p>";
        echo '<a href="login.php">login</a>';
        exit();
    } else {
        $_SESSION = array(); // セッション変数を空にする
        $_SESSION["session_id"] = session_id();
        //is_adminは管理者で有るか？否か？
        // $_SESSION["is_admin"] = $val["is_admin"];
        $_SESSION["name"] = $val["name"];
        $_SESSION["id"] = $val["id"];
        header("Location:top.php"); // 一覧ページへ移動
        exit();
    }
}

