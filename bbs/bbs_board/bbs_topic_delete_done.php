
<?php
require_once('../bbs_login/login_session.php');
$postid=$_GET['postid'];
$db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
$stt = $db->prepare('DELETE FROM post WHERE id=? ');
$stt->execute(array($postid));
header('Location:bbs_top.php');
?>