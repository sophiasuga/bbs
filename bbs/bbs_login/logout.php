<?php  
 session_start();
 $_SESSION=array();
 if(isset($_COOKIE[session_name()])==true){
   setcookie(session_name(),'',time()-42000,'/');
 }
 session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/logout.css">
  <title>Document</title>
</head>
<body>
  <div class="logout-container">
    <p class="logout-message">ログアウトしました</p>
    <a class="back" href="login.php">ログイン画面へ</a>
  </div>
</body>
</html>