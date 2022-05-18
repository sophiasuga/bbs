<?php
session_start();
try{

  $postid=$_POST['post_id'];
  $member_id=$_POST['member_id'];

  if($member_id!=$_SESSION['id']){
  $db=new PDO('mysql:host=localhost;dbname=bbs','root');
  $stt=$db->prepare('INSERT INTO bad SET bad_post_id=?,bad_member_id=?, created_at=NOW()');
  $stt->execute(array($_POST['reply_id'],$_SESSION['id']));
  }

  header('Location:reply.php?postid='."$postid");

}catch(Exception $e){
  echo $e->getMessage();
}


?>