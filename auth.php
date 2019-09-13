<?php

debugLogStart();

//================================
//ログイン認証機能
//================================
// ログインしている場合
if (!empty($_SESSION['login_date'])) {
  debug('ログイン済みユーザーです。');

  // 現在日時が最終ログイン日時＋有効期限がtime()を超えている場合
  if (($_SESSION['login_date'] + $_SESSION['login_limit']) > time()) {
    debug('ログイン有効期限以内です。');
    //最終ログイン日時を現在日時に更新
    $_SESSION['login_date'] = time();
    
  } else {
    debug('ログイン有効期限オーバーです。');
    // セッションを削除（ログアウトする）
    session_destroy();
    // ログインページへ
    header("Location:login.php");
    exit;
  }
} else {
  debug('未ログインユーザーです。');
}