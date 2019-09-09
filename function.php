<?php
require_once('connection.php');
//ログの取得
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', './log/php_error.log');

//エラーメッセージを定数に設定
define('MSG01', '入力必須です');
define('MSG02', 'Emailの形式で入力してください');
define('MSG03', 'パスワードとパスワード（再入力）が合っていません');
define('MSG04', '半角英数字のみご利用いただけます');
define('MSG05', '6文字以上で入力してください');
define('MSG06', '256文字以内で入力してください');
define('MSG07', 'エラーが発生しました。しばらくしてからやり直してください');
define('MSG08', 'そのEmailはすでに登録されています');

//配列$err_msg
$err_msg = array();
//dbアクセス結果用
$dbRst = false;

$keys = [
  'email' => 'Emailは',
  'pass' => 'パスワードは',
  'pass_re' => 'パスワード（再入力）は',
];

//エスケープ処理
function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}



//バリデーション関数（未入力チェック）
function validRequired($str, $key)
{
  if (empty($str)) {
    global $err_msg;
    global $keys;
    $err_msg[$key] = $keys[$key] . MSG01;
  }
}

//バリデーション関数（未入力チェック）
function validEmail($str, $key)
{
  if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $str)) {
    global $err_msg;
    $err_msg[$key] = MSG02;
  }
}

//バリデーション関数（同値チェック）
function validMatch($str1, $str2, $key)
{
  if ($str1 !== $str2) {
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}
//バリデーション関数（最小文字数チェック）
function validMinLen($str, $key, $min = 6)
{
  if (mb_strlen($str) < $min) {
    global $err_msg;
    global $keys;
    $err_msg[$key] = $keys[$key] . MSG05;
  }
}
//バリデーション関数（最大文字数チェック）
function validMaxLen($str, $key, $max = 256)
{
  if (mb_strlen($str) > $max) {
    global $err_msg;
    global $keys;
    $err_msg[$key] = $keys[$key] . MSG06;
  }
}

//バリデーション関数（email重複チェック）
function validEmailDup($email)
{
  global $err_msg;

  //例外処理
  try {
    $result = dbConenectValidEmail($email);

    //配列の先頭から要素を取り出すarray_shift()
    if (!empty(array_shift($result))) {
      $err_msg['email'] = MSG08;
    }
  } catch (Exception $e) {
    error_log('エラー発生' . $e->getMessage());
    $err_msg['email'] = MSG07;
  }
}


//バリデーション関数（半角チェック）
function validHalf($str, $key)
{
  if (!preg_match("/^[a-zA-Z0-9]+$/", $str)) {
    global $err_msg;
    $err_msg[$key] = MSG04;
  }
}
