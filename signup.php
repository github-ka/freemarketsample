<?php
require_once('function.php');

//post送信されていた場合
if (!empty($_POST)) {

  //変数にユーザー情報を代入
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_re = $_POST['pass_re'];

  //未入力チェック
  validRequired($email, 'email');
  validRequired($pass, 'pass');
  validRequired($pass_re, 'pass_re');

  //バリデーションエラーがない場合
  if (empty($err_msg)) {

    //emailの形式チェック
    validEmail($email, 'email');
    //emailの最大文字数チェック
    validMaxLen($email, 'email');
    //emailの重複チェック
    validEmailDup($email);

    //パスワードの半角英数字チェック
    validHalf($pass, 'pass');
    //パスワードの最小文字数チェック
    validMinLen($pass, 'pass');
    //パスワードの最大文字数チェック
    validMaxLen($pass, 'pass');

    if (empty($err_msg)) {

      //パスワードとパスワード再入力が合っているかチェック
      validMatch($pass, $pass_re, 'pass_re');

      //バリデーションエラーがない場合
      if (empty($err_msg)) {
        $dbRst = dbConnectInsert($email, $pass);
        //SQL実行結果が成功の場合
        if ($dbRst) {
          header("Location:mypage.html"); //マイページへ
        }
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>ユーザー登録 | FreeMarket</title>
  <link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body class="page-signup page-1colum">

  <!-- メニュー -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">FreeMarket</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="login.php">ログイン</a></li>
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
          <h2 class="title">ユーザー登録</h2>
          <!-- <div class="area-msg">
            <?php
                  if (!empty($err_msg)) {
                    foreach ($err_msg as $msg) {
                      echo $msg . '<br>';
                    }
                  }
                  ?>
          </div> -->
          <div class="area-msg">
            <?= !empty($err_msg['email']) ? $err_msg['email'] : ''; ?>
          </div>
          <label class="<?= !empty($err_msg['email']) ? 'err' : ''; ?>">
            Email
            <input type="text" name="email" value="<?= !empty($email) ? h($email) : ''; ?>">
          </label>
          <div class="area-msg">
            <?= !empty($err_msg['pass']) ? $err_msg['pass'] : ''; ?>
          </div>
          <label class="<?= !empty($err_msg['pass']) ? 'err' : ''; ?>">
            パスワード <span style="font-size:12px">※英数字６文字以上</span>
            <input type="password" name="pass" value="<?= !empty($pass) ? h($pass) : ''; ?>">
          </label>
          <div class="area-msg">
            <?= !empty($err_msg['pass_re']) ? $err_msg['pass_re'] : ''; ?>
          </div>
          <label class="<?= !empty($err_msg['pass_re']) ? 'err' : ''; ?>">
            パスワード（再入力）
            <input type="password" name="pass_re" value="<?= !empty($pass_re) ? h($pass_re) : ''; ?>">
          </label>
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="登録する">
          </div>
        </form>
      </div>

    </section>

  </div>

  <!-- footer -->
  <footer id="footer">
    Copyright <a href="">著作権サイトURL</a>. All Rights Reserved.
  </footer>

  <script src="js/vendor/jquery-2.2.2.min.js"></script>
  <script src="js/vendor/footer.js"></script>

</body>

</html>