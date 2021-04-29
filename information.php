<?php

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM todo_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();