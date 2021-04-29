<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>引野掲示板</title>
    <style>
/* p {line-height:180%} */
.head-title {width:100%;background:#87ceeb;color:#fff;text-indent:8px;font-weight:700;line-height:180%}
</style>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcqyHgG8qoOhgLHJ0B9anrIYWGcbHQqsk&language=ja"></script>
<script src="event_input_map.js" ></script>
<style>
  html { height: 100% }
  body { height: 100% }
  #map { height: 100%; width: 100%}
</style>
</head>

<body onload="initialize()">

    <form action="event_input_act.php" method="POST" enctype="multipart/form-data">
            <div>
                イベント名:<input type="text" name="name">
            </div>
             <div>
                開催日時:<input type="date" name="daytime">
            </div>

            <div>
                写真:<input type="file" name="picture"  accept="image/*" capture="camera">
            </div>
            <div>
                イベント詳細:
            </div>
            <textarea name="detail" id="" cols="30" rows="10"></textarea>
           
       
      <!-- マップ表示 -->
            <p>開催場所</p>
            <!-- <iframe src="./event_input_map.php" width="600" height="500" ></iframe> -->

<table style="width:100%;border:0">
<tr style="background-color:#dddddd">
<th style="width:20%">項目</th>
<th>情報</th></tr>
<tr><td>緯度</td><td id="id_ido"></td></tr>
<tr><td>経度</td><td id="id_keido" ></td></tr>

<!-- 緯度経度の表示テスト -->
<!-- 経度<input type="text" value="" > -->


<!-- 取得した緯度経度をvalue値に入れて -->
<input type="hidden" name="latitude" value=>
<input type="hidden" name="longitude" value="<?= $record["id_keido"]?>">
</table>

<input id="address" type="textbox" value="北九州市" style="line-height:1.6em;font-size:16px">
<input type="button" value="住所検索" onclick=codeAddress() style="height:30px">
<div id="map_canvas" style="width:100%;height:300px"></div>


 <!-- formタグの中で無いと作動しない。 -->
            <div>
                <button type="submit">登録</button>
                <a href="top.php">トップへ</a>
                <a href="event_all.php">イベント一覧</a>
            </div>
         </form>
            </script>

           
            
  



</body>

</html>