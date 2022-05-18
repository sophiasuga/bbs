<?php
require_once('../bbs_login/login_session.php');
if(isset($_REQUEST['page'])&& is_numeric($_REQUEST['page'])){
  $page=$_REQUEST['page'];
}else{
  $page=1;
}
$start=5*($page-1);
$db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
$stt = $db->prepare('SELECT m.name,m.image, p.message,p.created_at,p.id,p.member_id FROM post AS p INNER JOIN member AS m ON p.member_id=m.id WHERE reply_id=0 ORDER BY created_at DESC LIMIT ?,5');
$stt->bindParam(1,$start,PDO::PARAM_INT);
$stt->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/top.css">
  <title>Document</title>
</head>

<body>
    <!-- ヘッダー -->
  <div class="container_header">
    <div class="left_header">
      <div class="profile-image"> <img class="profile-image" src="../bbs_member/image/<?php print $_SESSION['image'] ?>" style="width: 50px; height:50px;border-radius:50%;"></div>
      <div><?php print $_SESSION['name'] ?></div>
    </div>

    <div class="center_header">
      <h1 class="header-title">VS board</h1>
    </div>

    <div class="right_header">
      <ul>
        <li><a href="../bbs_member/profile_edit.php">プロフィール編集</a></li>
        <li><div id="open">ログアウト</div></li>
      </ul>
    </div>
    
    
  </div>
  <!-- モーダル -->
  <div id="mask" class="hidden"></div>
  <div id="modal" class="hidden">
    
      <p>本当にログアウトしますか</p>
    
   
      <div class="modal-bottom">
        <a href="../bbs_login/logout.php">ログアウト</a>
      
        <div id="close">閉じる</div>
      </div>
   
  </div>
  
     <!-- メイン -->
  <div class="main">
    
    <div class="main-left">
      <div class="topic_list">
        <h1>トピック一覧(新着順)</h1>
      </div>
      
     <?php while ($rec = $stt->fetch()) : ?>
  
      <div class="container_topic">
        <section>
          <div class="prof-img">
            <img class="profile" src="../bbs_member/image/<?php print $rec['image']; ?>" >
          </div>
          
          <div class="topic-contents">

            <div class="post-details">
              <div class="user-name">           
                <?php print  $rec['name']; ?>
              </div>
             
              <div class="post-info">                
                <div class="post-created_at">
                  <?php print $rec['created_at']; ?>
                </div>
                <div class="post-delete">
                      <?php if ($_SESSION['id'] == $rec['member_id']) : ?>                       
                        <a href="bbs_topic_delete.php?postid=<?php print $rec['id'] ?>">削除</a>
                      <?php endif; ?>
                    </div>
                   
              </div>
            </div>
            
            <div class="topic-sentence">
              <h2 class="topic-message"><?php print $rec['message']; ?></h2>
              <a class="objection" href="../bbs_reply/reply.php?postid=<?php print $rec['id']; ?>">反論</a>
            </div>
          </div>
        </section>
      </div>
    <?php endwhile; ?>
    <div class="page-change">
      <?php if($page>=2): ?>
      <a href="bbs_top.php?page=<?php print ($page-1); ?>"><?php print ($page-1) ?>ページ目へ</a>
      <?php endif; ?>
  
      <?php 
      $counts=$db->query('SELECT COUNT(*) AS cnt FROM post WHERE reply_id=0 ');
      $count=$counts->fetch();
      $max_page=ceil($count['cnt']/5);
      if($page<$max_page):
      ?>
      <a href="bbs_top.php?page=<?php print ($page+1); ?>"><?php print ($page+1) ?>ページ目へ</a>
      <?php endif; ?>

    </div>
    
  </div>
  
<div class="main-right">
  
  <h2>トピック追加</h2>
  <?php if (isset($_SESSION['error'])) : ?>
    <?php if ($_SESSION['error'] == 'blank') : ?>
      *トピックを入力してください
    <?php endif; ?>
  <?php endif; ?>

  <form action="bbs_topic_add.php" method="post">
    <textarea name="message" cols="50" rows="6" placeholder="この欄に入力してください。&#13;（例）〇〇って面白くないよな&#13; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;〇〇より✖✖のほうが全然いい"></textarea>
    <input type="submit" value="送信">
  </form>

  <div>
    検索機能作成予定

  </div>
</div>

</div>


 <script src="../js/top.js"></script>
</body>

</html>