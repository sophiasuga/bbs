<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/member-add.css" class="css">
  <title>Document</title>
</head>
<body>
  <div class="member-add-container">
    <div class="member-add-wrapper">
      <h2 class="member-add-header">新規登録</h2>
      <div class="member-add-form">
        <form action="bbs_member_check.php" method="post" enctype="multipart/form-data">
          ニックネーム<br>
          <input type="text" name="name"><br>
          パスワード<br>
          <input type="password" name="pass"><br>
          メールアドレス<br>
          <input type="text" name="mail"><br>
          プロフィール<br>
          <input type="file" name="image"  class="image"> <br>
          <input type="submit" value="登録する" class="btn">
        </form>
      </div>
    </div>
 <a href="../bbs_login/login.php" class="to-login">ログイン画面へ</a>
  </div>
  
</body>
</html>