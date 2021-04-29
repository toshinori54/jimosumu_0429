<?php
// sessionに保存されている変数を取り出し，計算して表示しよう
session_start();
$_SESSION['num'] += 1; //サーバーに保存（session01に保存）している変数を利用して１足す
echo $_SESSION['num'];//結果の呼び出し