
<?php
   session_start();
   session_regenerate_id(true);
   if(isset($_SESSION['login'])==false){
     print('ログインされていません');
     print'<a href="../bbs_login/gin.php">ログイン画面へ</a>';
     exit();
   }else{
     print $_SESSION['name'];
     print 'さんログイン中';
     print '<br><br>';
   }
   
   ?> 
<?php

if(!empty($_POST)){
  if($_POST['message']!=''){

    $db=new PDO('mysql:host=localhost;dbname=bbs','root');
    $stt=$db->prepare('INSERT INTO post SET message=?,created_at=NOW(),member_id=? ');
    $stt->execute(array($_POST['message'],$_SESSION['id']));
    
    header('Location:bbs_top.php');
  }else{
   
   header('Location:bbs_error.php');
    
  }
  
}else{
header('Location:bbs_error.php');
}


?>