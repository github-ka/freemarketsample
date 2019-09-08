<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="utf-8">
    <title>ログイン | FreeMarket</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
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
      <section id="main" >

       <div class="form-container">
        
         <form action="mypage.html" class="form">
           <h2 class="title">ログイン</h2>
           <div class="area-msg">
             メールアドレスまたはパスワードが違います
           </div>
           <label>
            メールアドレス
             <input type="text" name="email">
           </label>
           <label>
             パスワード
             <input type="text" name="pass">
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
