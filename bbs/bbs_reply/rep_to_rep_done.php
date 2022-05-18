<?php
   session_start();
   session_regenerate_id(true);
   ?> 
<?php
if($_POST){
  if($_POST['message']!=''){
    $db=new PDO('mysql:host=localhost;dbname=bbs','root');
    $stt=$db->prepare('INSERT INTO post SET message=?,member_id=?,reply_id=?,created_at=NOW()');
    $stt->execute(array($_POST['message'],$_SESSION['id'],$_POST['reply_code']));
    header('Location:reply.php?postid='.$_POST['topic_code']);
  }else{

    echo 'もう一度入力ください';
   print('<input type="button" onclick="history.back()">'); 
  }

}else{
  echo 'もう一度入力ください';
 print('<input type="button" onclick="history.back()">'); 
}
?>

