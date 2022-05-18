<?php
session_start();
session_regenerate_id(true);

$name=htmlspecialchars($_POST['name']);
$pass=htmlspecialchars($_POST['pass']);
$mail=htmlspecialchars($_POST['mail']);
$image=$_FILES['image'];

try{
  $db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
  $stt=$db->prepare('UPDATE member SET name=?,password=?,mail=? WHERE id=?');
  $stt->execute(array($name,$pass,$mail,$_SESSION['id']));

if($image){
  $imageup=$db->prepare('UPDATE member SET image=? WHERE id=?');
  $imageup->execute(array($image['name'],$_SESSION['id']));

  if($image['size']>0){
    if($image['size']>1000000000)
    {
      print '画像が大きすぎます';
    }else{
      move_uploaded_file($image['tmp_name'],'./image/'.$image['name']);
      print '<br>';
    }
  }
}
  header('Location:profile_edit.php');
}catch(Exception $e){
  print $e->getMessage();
}


?>