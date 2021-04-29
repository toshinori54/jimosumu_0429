<?php
// var_dump($_name);
// exit();

//データベース接続
include('functions.php');
// DB接続
$pdo = connect_to_db();



$name=$_POST["name"];
$detail=$_POST["detail"];
$daytime=$_POST["daytime"];
$place=$_POST["place"];
$latitude=$_POST["latitude"];
$longitude=$_POST["longitude"];
$picture=$_POST["picture"];

// ここからファイルアップロード&DB登録の処理を追加しよう！！！
if (!isset($_FILES['picture']) && $_FILES['picture']['error'] != 0) {
  // 送られていない，エラーが発生，などの場合
   exit('Error:画像が送信されていません');
} else {
  //ファイル名の取得
  $uploaded_file_name = $_FILES['picture']['name'];
  //tmpフォルダの場所
  $temp_path  = $_FILES['picture']['tmp_name'];
  //アップロード先ォルダ（↑自分で決める）
  $directory_path = 'upload/';

 $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
 $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
 $filename_to_save = $directory_path . $unique_name;

// var_dump( $filename_to_save);
// exit();

    if (!is_uploaded_file($temp_path)) {
    exit('Error:画像がありません'); // tmpフォルダにデータがない
  } else { //  ↓ここでtmpファイルを移動する
    if (!move_uploaded_file($temp_path, $filename_to_save)) {
      exit('Error:アップロードできませんでした'); // 画像の保存に失敗
    } else {
      chmod($filename_to_save, 0644); // 権限の変更
      
      // 今回は権限を変更するところまで
    }
  }
}


//SQL作成＆実行
$sql = "INSERT INTO event_reg (id,name,detail,daytime,place,latitude,longitude,picture,created_at,updated_at) VALUES(NULL,:name,:detail,:daytime,place,latitude,longitude,:picture,sysdate(),sysdate())";


// echo "ここまで";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
$stmt->bindValue(':daytime', $daytime, PDO::PARAM_STR);
$stmt->bindValue(':picture', $filename_to_save, PDO::PARAM_STR);
// $stmt->bindValue(':latitude', $latitude, PDO::PARAM_STR);
// $stmt->bindValue(':longitude', $longitude, PDO::PARAM_STR);
$status = $stmt->execute();



//失敗した場合のエラー
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("sqlError:" . $error[2]);
} else {
    header("Location:event_all.php");
}



