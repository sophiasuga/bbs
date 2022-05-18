<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/log.css">
  <title>Document</title>
</head>
<body>
  <div class="log-container">
    <div class="log-wrapper">

      <h2 class="log-header">ログイン</h2>
      <div class="log-form">
        <form action="login_done.php" method="post">
          mailadress <br>
          <input type="text" name="mail"><br>
          password<br>
          <input type="password" name="pass"><br>
          <input type="submit" class="btn">
        </form>
          
        </div>
     
        <a href="../bbs_member/bbs_member_add.php" class="create-new-member">新規登録</a>
      
    </div>

  </div>
</body>
</html>