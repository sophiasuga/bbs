<?php
require_once('../bbs_login/login_check.php');
$db=new PDO('mysql:host=localhost;dbname=bbs','root');
?>
<?php 
if($_REQUEST['postid']){
  $post_id=$_GET['postcode'];
  $stt=$db->prepare('SELECT * FROM post WHERE id=?');
  $stt->execute(array($post_code));
  $post=$stt->fetch();
}else{
  header('Location:bbs_top.php');
}
?>

<div>
  <h2><?php print $post['message'] ?></h2>
  <?php print $post['created_at'] ?>
</div>

<form action="reply_done.php>" method="post">
    <textarea name="reply"  cols="30" rows="10"></textarea>
    <input type="submit" value="返信">
  </form>
