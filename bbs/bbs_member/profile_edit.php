<?php
require_once('../bbs_login/login_session.php');
$db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
$stt = $db->prepare('SELECT * FROM member WHERE id=?');
$stt->execute(array($_SESSION['id']));
$rec = $stt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/profile_edit.css">
  <title>Document</title>
</head>

<body>
  <div class="main-container">
    <div>
      <h1>編集画面</h1>
    </div>
  
    <form action="profile_edit_done.php" method="post"  enctype="multipart/form-data">
      <div class="edit-form">
      <div class="name">
        名前：<input type="text" name="name" value="<?php print $rec['name']  ?>"><br>
      </div>
      <div class="pass">
        パスワード：<input type="password" name="pass" value="<?php print $rec['password']  ?>"><br>
      </div>
      <div class="mail">
        メールアドレス：<input type="text" name="mail" value="<?php print $rec['mail']  ?>"><br>
      </div>
      <div class="image">
        プロフィール写真:<img  src="../bbs_member/image/<?php print $rec['image'] ?>" style="width: 50px;"><br>
      </div>
      <input type="hidden" name="old_image"  value="<?php print $rec['image'] ?>"><br>
      <input type="file" name="image" value="<?php print $rec['image']; ?>"><br>
      <input type="submit" value="変更" >
    </div>
    </form>
    <a class="back" href="../bbs_board/bbs_top.php">編集終了</a>
  

  </div>

</body>

</html>