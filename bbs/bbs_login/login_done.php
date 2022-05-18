
<?php
session_start();
session_regenerate_id(true);

$db=new PDO('mysql:host=localhost;dbname=bbs','root');
$stt=$db->prepare('SELECT * FROM member WHERE mail=? AND password=?');
$stt->execute(array($_POST['mail'],$_POST['pass']));
$member=$stt->fetch(PDO::FETCH_ASSOC);

if($member){
  $member_id=$member['id'];
  $member_name=$member['name'];
  $member_image=$member['image'];
  $_SESSION['login']=1;
  $_SESSION['id']=$member_id;
  $_SESSION['name']=$member_name;
  $_SESSION['image']=$member_image;
  header('Location:../bbs_board/bbs_top.php');
  print('<input type="hidden" name="id" value="'.$member['id'].'"> ');
}else{
  print '<link rel="stylesheet" href="../css/log.css">';
  print '<div class="error">';
  print '<p>※メールアドレスもしくはパスワードが間違っています</p>';
  print '<br>';
  print '<a href="../bbs_login/login.php" class="back">戻る</a>';
  print '</div>';
}
print '';

?>


</div>
