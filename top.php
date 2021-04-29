<?php
// echo "hoge";

session_start();
//ログイン時の名前表示
// var_dump($_SESSION);
$username=$_SESSION["name"];
$id=$_SESSION["id"];
if(isset($_SESSION["id"])){//ログインしているとき
  $msg="こんにちは". htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . 'さん';
  $link = '<a href="logout.php">ログアウト</a>';
}else{//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}

//新着情報
include('functions.php');
// DB接続
$pdo = connect_to_db();

// データ取得SQL作成(降順 3件) SQLをphpadominで練習
$sql = 'SELECT * FROM `event_reg` ORDER BY daytime DESC LIMIT 3';
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
     // 画像出力を追加しよう
    $output .= "<td><img src='{$record["picture"]}' height=50px></td>";
  // 　参加者数表示
    $output .="<td>{$record["place"]}</td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcqyHgG8qoOhgLHJ0B9anrIYWGcbHQqsk&language=ja"></script>
<style>
  html { height: 100% }
  body { height: 50% }
  #map { height: 100%; width: 100%}
</style>

</head>

<body>
  <!-- ログイン者名表示 -->
<h1><?php echo $msg; ?></h1>
<?php echo $link;?>
    <h2>引野掲示板</h2>
    <p>この掲示板は引野地区の町おこしを目的にした掲示板</p>
    <p>回覧板のウェブをイメージして作りました。</p>

    <p>更新情報表示</p>

    <p>イベント地図</p>
    <div id="map"></div>

   <script>
   var MylatLng=new google.maps.LatLng(33.845731, 130.751619)
   var Options ={
     zoom:15,//地図の縮尺値
     center:MylatLng, //地図の中心座標
     mapTypeId:"roadmap" //地図の種類
   };
   var map =new google.maps.Map(document.getElementById("map"),Options);
   </script>

    <p>直近のイベント</p>
    <table border="1" style="border-collapse: collapse"><?=$output ?></table>
   
   

    <p>イベント登録はこちら↓</p>
    <a href="event_input.php">イベント登録</a>
    <p>イベント結果</p>
    <a href=""></a>
    <p>ユーザ登録</p>
    <a href="register.php">ユーザ登録</a>
    <p>ログイン</p>
    <a href="login.php">ログイン</a>

</body>

</html>