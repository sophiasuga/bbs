<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  print('ログインされていません');
  print '<a href="../bbs_login/login.php">ログイン画面へ</a>';
  exit();
} else {


}
?>