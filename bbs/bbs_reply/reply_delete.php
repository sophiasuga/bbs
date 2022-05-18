<?php
require_once('../bbs_login/login_session.php');
try{
  $deleteid=$_GET['deleteid'];
  $postid=$_GET['postid'];
  $db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
  $stt = $db->prepare('DELETE FROM post WHERE id=?');
  $stt->execute(array($deleteid));
  header('Location:reply.php?postid='."$postid");

}catch(Exception $e){
  echo $e->getMessage();
}
?>