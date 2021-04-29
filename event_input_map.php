<!-- このページ全部使用していない -->

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Google Maps JavaScript API ジオコーディング(Geocode)</title>
<style>
/* p {line-height:180%} */
.head-title {width:100%;background:#87ceeb;color:#fff;text-indent:8px;font-weight:700;line-height:180%}
</style>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDcqyHgG8qoOhgLHJ0B9anrIYWGcbHQqsk&language=ja"></script>
<script src="event_input_map.js" ></script>
</head>
<body onload="initialize()">
<!-- <div class="head-title">Google Maps APIを使ったサンプル。</div>
<p>ジオコーディング 住所から座標を取得[Geocode]住所 </p> -->
<table style="width:100%;border:0">
<tr style="background-color:#dddddd">
<th style="width:20%">項目</th>
<th>情報</th></tr>
<tr><td>緯度</td><td id="id_ido" name="latitude"></td></tr>
<tr><td>経度</td><td id="id_keido" name="longitude"></td></tr>
</table>
<input id="address" type="textbox" value="北九州市" style="line-height:1.6em;font-size:16px">
<input type="button" value="住所検索" onclick=codeAddress() style="height:30px">
<div id="map_canvas" style="width:100%;height:300px"></div>
</body>
</html>