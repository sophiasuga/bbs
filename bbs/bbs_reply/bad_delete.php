<?php
require_once('../bbs_login/login_session.php');

$replytid=$_GET['replyid'];
$postid=$_GET['postid'];
$db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
$stt = $db->prepare('DELETE FROM bad WHERE bad_post_id=? AND bad_member_id=? LIMIT 1 ');
$stt->execute(array($replytid,$_SESSION['id']));
header('Location:reply.php?postid='."$postid");

?>