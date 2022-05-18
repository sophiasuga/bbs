
<?php
require_once('../bbs_login/login_session.php');
$postid=$_GET['postid'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/error.css">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <p class="check-message">本当に削除しますか</p>
    <a class="delete" href="bbs_topic_delete_done.php ?postid=<?php print $postid; ?>">削除</a>
    <a onclick="history.back()" class="back" class="back"> 戻る</a>
  </div>
  
</body>
</html>

