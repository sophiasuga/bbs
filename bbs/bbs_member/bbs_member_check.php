<link rel="stylesheet" href="../css/member-add.css">
<?php
$bbs_name = $_POST['name'];
$bbs_pass = $_POST['pass'];
$bbs_mail = $_POST['mail'];
$bbs_image=$_FILES['image'];

if (!empty($_POST)) {
  print ('<div class="error-container">');
  if ($_POST['name'] == '') {
    print('<div class="name-error">ニックネームが入力されていません</div>') ;
  }
  if ($_POST['pass'] == '') {
    print('<div class="pass-error">パスワードが入力されていません</div>') ;

  }
  if ($_POST['mail'] == '') {
    print('<div class="mail-error">メールアドレスが入力されていません</div>') ;
  }
  
  if($bbs_image['size']>0){
    if($bbs_image['size']>10000000)
    {
      print('<div class="image-error">画像のサイズが大きすぎます</div>') ;
    }else{
      move_uploaded_file($bbs_image['tmp_name'],'./image/'.$bbs_image['name']);
      print '<br>';
    }
  }
  
  
  if ($_POST['name'] != '' && $_POST['pass'] != '' && $_POST['mail'] != '' ||$bbs_image['size']>10000000) {
    print('<div class="member-post-form">');
    print('<form action="bbs_member_done.php" method="post">');
    print('<input type="hidden" name="name" value="' . $bbs_name . '">');
    print($bbs_name . '<br>');
    print('<input type="hidden" name="pass" value="' . $bbs_pass . '">');
    print($bbs_pass );
    print('<input type="hidden" name="image" value="' . $bbs_image['name'] . '"  >');
    print '<div><img src="./image/'.$bbs_image['name'].' " class="image" style="width: 50px; height:50px; border-radius:50%;"></div>';
    print('<input type="hidden" name="mail" value="' . $bbs_mail . '">');
    print('<div >'.$bbs_mail . '</div>');
    print('<input class="input" type="submit" value="登録">');
    print('<a class="back" href="bbs_member_add.php">戻る</a>');
    print('</form>');
    print '</div>';
  } else {

    print('<a href="bbs_member_add.php">戻る</a>');
  }
  print ('</div>');
} else {
  echo 'もう一度入力してください';
  print('<a href="bbs_member_add.php">戻る</a>');
}
?>

