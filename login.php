<?php
require_once('./function.php');

//post送信の確認
if (!empty($_POST)) {
  debug('post送信があります');

  //変数にユーザー情報を代入
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  //未入力チェック
  validRequired($email, 'email');
  validRequired($pass, 'pass');
  //エラーメッセージがない場合
  if(empty($err_msg)) {
    //emailの形式チェック
    validEmail($email, 'email');
    //パスワードの半角英数字チェック
    validHalf($pass, 'pass');

    if(empty($err_msg)) {
      $result = validEmailPassCheck($email,$pass);
      if($result) {
        header('Location:mypage.php');
        exit;
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ログイン | FreeMarket</title>
  <link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body class="page-login page-1colum">

  <!-- メニュー -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">FREE MARKET</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="signup.php" class="btn btn-primary">ユーザー登録</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main">

      <div class="form-container">

        <form action="" class="form" method="post">
          <h2 class="title">ログイン</h2>
          <div class="area-msg">
            <?= !empty($err_msg['email']) ? $err_msg['email'] : ''; ?>
          </div>
          <label class="<?= !empty($err_msg['email']) ? 'err' : ''; ?>">
            メールアドレス
            <input type="text" name="email" value="<?= !empty($email) ? h($email) : '';?>">
          </label>
          <div class="area-msg">
            <?= !empty($err_msg['pass']) ? $err_msg['pass'] : ''; ?>
          </div>
          <label class="<?= !empty($err_msg['pass']) ? 'err' : ''; ?>">
            パスワード
            <input type="text" name="pass" value="<?= !empty($email) ? h($pass) : ''; ?>">
          </label>
          <label>
            <input type="checkbox" name="pass_save">次回ログインを省略する
          </label>
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="ログイン">
          </div>
          パスワードを忘れた方は<a href="passRemindSend.html">コチラ</a>
        </form>
      </div>

    </section>

  </div>

  <!-- footer -->
  <footer id="footer">
    Copyright <a href="">サイトURL</a>. All Rights Reserved.
  </footer>

  <script src="js/vendor/jquery-2.2.2.min.js"></script>
  <script src="js/vendor/footer.js"></script>
</body>

</html>