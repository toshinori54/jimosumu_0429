<?php
// session変数を定義して値を入れよう

session_start();
$_SESSION['num'] = 100; //サーバーに保存
echo $_SESSION['num']; //サーバーから呼び出し
