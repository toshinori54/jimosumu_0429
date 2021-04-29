<?PHP
// sessionをスタートしてidを再生成しよう．
// 旧idと新idを表示しよう．

session_start(); //セッション開始
$old_session_id = session_id(); //ID取得
session_regenerate_id(true); //ID再生成＆旧IDを破棄
$new_session_id = session_id(); //新IDの取得
echo '<p>旧id' . $old_session_id . '</p>'; // idの確認
echo '<p>新id' . $new_session_id . '</p>';
