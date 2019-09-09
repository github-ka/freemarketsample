<?php

//DB接続
function dbConnect()
{
  //DBへの接続準備
  $dsn = 'mysql:dbname=freeMarketSample;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
  $options = array(
    // SQL実行失敗時に例外をスロー
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // デフォルトフェッチモードを連想配列形式に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
    // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );

  // PDOオブジェクト生成（DBへ接続）
  $dbh = new PDO($dsn, $user, $password, $options);
  return $dbh;
}

//重複チェック
function dbConenectValidEmail($email)
{
  //DB接続
  $dbh = dbConnect();
  //SQL文
  $sql = 'SELECT count(*) FROM users WHERE email = :email';
  //prepare()でステイトメントオブジェクト返す
  $stmt = $dbh->prepare($sql);
  //代入的な感じ
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  //クエリ実行
  $stmt->execute();
  //クエリ結果の値を取得
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;

}

//登録
function dbConnectInsert($email, $pass)
{
  $dbh = dbConnect();
  //SQL文（クエリー作成）
  $sql = 'INSERT INTO users (email,pass,login_time, create_date) VALUES (:email,:pass,:login_time,:create_date)';
  //準備
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  //パスワードはハッシュ化
  $stmt->bindValue(':pass', password_hash($pass, PASSWORD_DEFAULT), PDO::PARAM_STR);
  $stmt->bindValue(':login_time', date('Y-m-d H:i:s'), PDO::PARAM_STR);
  $stmt->bindValue(':create_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
  //プレースホルダに値をセットし、SQL文を実行
  $dbRst = $stmt->execute();
  return $dbRst;
}