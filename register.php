<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>リストユーザ登録画面</title>
</head>

<body>
  <form action="register_act.php" method="POST">
    <fieldset>
      <legend>リストユーザ登録画面</legend>
      <div>
        email: <input type="text" name="email">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
       <div>
        name: <input type="text" name="name">
      </div>
      <div>
        <button>Register</button>
      </div>
      <a href="top.php">トップへ戻る</a>
    </fieldset>
  </form>

</body>

</html>