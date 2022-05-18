<?php

$member_name=htmlspecialchars($_POST['name'],ENT_QUOTES);
$member_pass=htmlspecialchars($_POST['pass'],ENT_QUOTES);
$member_mail=$_POST['mail'];
$member_image=$_POST['image'];

$db=new PDO('mysql:host=localhost;dbname=bbs','root');
$stt=$db->prepare('INSERT INTO member SET name=?,password=?,mail=?,image=?');
$stt->execute(array($member_name,$member_pass ,$member_mail,$member_image));
echo '登録完了しました';

$statement=$db->prepare('SELECT id FROM member WHERE name=? AND password=?');
$statement->execute(array($member_name,$member_pass));
$member=$statement->fetch();

session_start();
$_SESSION['login']=1;
$_SESSION['id']=$member['id'];
$_SESSION['name']=$member_name;
$_SESSION['image']=$member_image;

print('<input type="hidden" name="id" value="'.$member['id'].'"> ');
?>
<br>
<a href="../bbs_board/bbs_top.php">掲示板画面へ</a>