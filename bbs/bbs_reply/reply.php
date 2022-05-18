<?php
require_once('../bbs_login/login_check.php');
session_start();
$db = new PDO('mysql:host=localhost;dbname=bbs', 'root');
?>
<?php


//トピック取得
$postid = $_GET['postid'];

$stt = $db->prepare('SELECT m.name, p.message,p.created_at ,p.id,m.image,p.member_id FROM post AS p INNER JOIN member AS m ON p.member_id=m.id WHERE p.id=? ');
$stt->execute(array($postid));
$post = $stt->fetch();

?>
<!-- 返信取得 -->
<?php
if(isset($_REQUEST['page'])&& is_numeric($_REQUEST['page'])){
  $page=$_REQUEST['page'];
}else{
  $page=1;
}
$start=5*($page-1);
$statement = $db->prepare('SELECT  m.name,m.image, p.message,p.created_at,p.id ,p.reply_id,p.member_id FROM post AS p INNER JOIN member AS m ON p.member_id=m.id WHERE reply_id=? LIMIT ?,5');
$statement->bindParam(1,$postid);
$statement->bindParam(2,$start,PDO::PARAM_INT);
$statement->execute();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reply.css">
  <script src="https://kit.fontawesome.com/0df40b6741.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>
<div class="container_header">
    <div class="left_header">
      <div class="profile-image"> <img class="profile-image" src="../bbs_member/image/<?php print $_SESSION['image'] ?>" style="width: 50px; height:50px;border-radius:50%;"></div>
      <div><?php print $_SESSION['name'] ?></div>

    </div>

    <div class="center_header">
      <div class="topic-vs">
        VS
      </div>
        <div><img src="../bbs_member/image/<?php print $post['image'] ?>" style="width: 50px; height:50px;border-radius:50%;"></div>
        <div><?php print $post['name'] ?></div>
    </div>

    <div class="back-to-top"><a href="../bbs_board/bbs_top.php">トップページへ</a></div>

    
    
  </div>
  <!-- トピック表示  -->
  <div class="topic">
    <div class="topic_message">
      <h2 class="subject"><?php print $post['message'] ?></h2>

    </div>

    <!-- 返信 -->
    <div class="topic_reply">
     <?php if($_SESSION['id']!= $post['member_id']): ?>
      <form action="reply_done.php" method="post">
        <textarea name="message" cols="30" rows="4"></textarea>
        <input type="hidden" name="topic_code" value="<?php print $postid; ?>">
        <input type="submit" value="返信">
      </form>
     <?php else: ?>
      <p class="reply-warning">※あなたはトピック記入者なので返信は出来ません。返信に対して返信してください</p>
      <?php endif; ?>
    </div>

  </div>

  <!-- 返信表示  -->
  <div class="reply_lists">

    <?php while ($reply = $statement->fetch()) : ?>
      <div class="reply_list">
        <div class="reply-container">
          <div class="reply-user-container">
            <div class="reply-user-info">
              <div><img class="post-img" src="../bbs_member/image/<?php print $reply['image'] ?>" style="width: 50px; height: 50px; border-radius:50%; "></div>
              <div class="reply-user"><?php print $reply['name']; ?></div>
              <div class="reply-message"><?php print $reply['message']; ?></div>
              <div class="created-at"><?php print '[' . $reply['created_at'] . ']' ?></div>
              <a class="reply-delete" href="reply_delete.php?deleteid=<?php print $reply['id'] ?>&postid=<?php print $postid ?>">削除</a>
            
            </div>


          </div>



          <div class="reply-right-container">
            
              <!-- いいね機能 -->
                <div class="likes-container">
                  
                  <!-- トピック側いいね -->
                  <div class="liked_topic_user">
                    <div><img class="post-img" src="../bbs_member/image/<?php print $post['image'] ?>" style="width: 50px; height: 50px; border-radius:50%; "></div>
                    <div class="likes_button">
                      <form action="likes_done.php" method="post">
                        <input type="hidden" name="reply_id" value="<?php print $reply['id'] ?>">
                        <input type="hidden" name="post_id" value="<?php print $postid ?>">
                        <input type="hidden" name="member_id" value="<?php print $post['member_id'] ?>">
                        <input type="submit" value="&#9825;">
                      </form>
                             
                    </div>
                    <!-- いいね数取得・表示・削除 -->
  
                    <div class="likes_count">
                      <?php
  
                      //いいね件数取得
                      $likescount = $db->prepare('SELECT count(*) cnt FROM likes WHERE liked_post_id=? AND liked_member_id=? ');
                      $likescount->execute(array($reply['id'],$post['member_id']));
                      $likecount = $likescount->fetch();
  
                      //いいね削除取得
                      $likes = $db->prepare('SELECT like_member_id FROM likes WHERE liked_post_id=? AND liked_member_id=?');
                      $likes->execute(array($reply['id'],$post['member_id']));
                      $like = $likes->fetch();
                      ?>
                      <!-- いいね件数表示 -->
                      <?php if ($likecount) {
                        print $likecount['cnt'];
                      } ?>
                      <!-- いいね削除 -->
                      <div class="likes_delete">
                        <?php if ($like) : ?>
                          <?php if ($_SESSION['id'] == $like['like_member_id']) : ?>
                            <a href="likes_delete.php?replyid=<?php print $reply['id'] ?>&postid=<?php print $post['id'] ?>">[取り消し]</a>
                          <?php endif; ?>
                        <?php endif; ?>
  
                      </div>
  
                    </div>

                  </div>

                  <div class="vs">vs</div>


                  <!-- 返信側いいね -->
                  <div class="liked_reply_user">
                    <div><img class="post-img" src="../bbs_member/image/<?php print $reply['image'] ?>" style="width: 50px; height: 50px; border-radius:50%; "></div>
                    <div class="likes_button">
                      <form action="likes_done.php" method="post">
                        <input type="hidden" name="reply_id" value="<?php print $reply['id'] ?>">
                        <input type="hidden" name="post_id" value="<?php print $postid ?>">
                        <input type="hidden" name="member_id" value="<?php print $reply['member_id'] ?>">
                        <input type="submit" value="&#9825;">
                      </form>
                     
  
                    </div>
                    <!-- いいね数取得・表示・削除 -->
  
                    <div class="likes_count">
                      <?php
  
                      //いいね件数取得
                      $likescount = $db->prepare('SELECT count(*) cnt FROM likes WHERE liked_post_id=? AND liked_member_id=? ');
                      $likescount->execute(array($reply['id'],$reply['member_id']));
                      $likecount = $likescount->fetch();
  
  
                      //いいね削除取得
                      $likes = $db->prepare('SELECT like_member_id FROM likes WHERE liked_post_id=? AND liked_member_id=?');
                      $likes->execute(array($reply['id'],$reply['member_id']));
                      $like = $likes->fetch();
                      ?>
                      <!-- いいね件数表示 -->
                      <?php if ($likecount) {
                        print $likecount['cnt'];
                      } ?>
                      <!-- いいね削除 -->
                      <div class="likes_delete">
                        <?php if ($like) : ?>
                          <?php if ($_SESSION['id'] == $like['like_member_id']) : ?>
                            <a href="likes_delete.php?replyid=<?php print $reply['id'] ?>&postid=<?php print $post['id'] ?>">[取り消し]</a>
                          <?php endif; ?>
                        <?php endif; ?>
  
                      </div>
  
                    </div>
  
  
                          </div>
                  </div>
              
            <div class="reply-to-reply-container">
              <!-- 返信への返信 -->
              <?php if ($_SESSION['id'] == $post['member_id'] || $_SESSION['id'] == $reply['member_id']) : ?>
                <?php  ?>
                <form action="rep_to_rep_done.php" method="post">
                  <input type="hidden" name="topic_code" value="<?php print $post['id']; ?>">
                  <input type="hidden" name="reply_code" value="<?php print $reply['id']; ?>">
                  <input type="text" name="message" cols="30" rows="1">
                  <input type="submit" value="返信">
                </form>
              <?php else:?>
                <p>ここには返信できません</p>
              
                <?php endif; ?>

            </div>


          </div>

        </div>

        <div class="container_reply_rep">
          <?php
          $replyid = $reply['id'];

          $state = $db->prepare('SELECT m.name, p.message,p.created_at,p.id ,p.reply_id,m.image FROM post AS p INNER JOIN member AS m ON p.member_id=m.id WHERE reply_id=?');
          $state->execute(array($replyid));
          //返信件数取得
          $sum = $db->prepare('SELECT count(*) cnt FROM post WHERE reply_id=? GROUP BY reply_id ');
          $sum->execute(array($replyid));
          $reply_sum = $sum->fetch();
          ?>

          <dl>
            <div>
              <?php if ($reply_sum) : ?>
                <dt>返信を見る<?php print $reply_sum['cnt']  ?>件</dt>
                <dd>
                  <!-- 返信一覧内容 -->
                  <?php foreach ($state as $states) : ?>

                    <div class="reply-contents">

                      <div class="reply-top-contents">
                        <div class="reply-image-contents"> <img src="../bbs_member/image/<?php print $states['image'] ?>" style="width: 40px; height: 40px; border-radius:50%;"></div>
                        <div class="reply-user-name">
                          <?php print  $states['name'] ?>
                          [<?php print $states['created_at'] ?>]
                        </div>
                      </div>

                      <div class="reply-bottom-contents">
                          <?php print $states['message'] ?>
                          
                      </div>

                
                     
                      <hr>



                  <?php endforeach; ?>

                </dd>
              <?php else : ?>
                <?php print '返信0件'; ?>
              <?php endif; ?>
            </div>
          </dl>

        </div>
      </div>
      <!-- 返信の返信取得 -->
      <hr>
    <?php endwhile; ?>
    <div class="page-change">
      <?php if($page>=2): ?>
      <a href="reply.php?page=<?php print ($page-1); ?>&postid=<?php print $postid ?>"><?php print ($page-1) ?>ページ目へ</a>
      <?php endif; ?>
  
      <?php 
      $counts=$db->prepare('SELECT COUNT(*) AS cnt FROM post WHERE reply_id=? ');
      $counts->execute(array($postid));
      $count=$counts->fetch();
      $max_page=ceil($count['cnt']/5);
      if($page<$max_page):
      ?>
      <a href="reply.php?page=<?php print ($page+1); ?>&postid=<?php print $postid ?>"><?php print ($page+1) ?>ページ目へ</a>
      <?php endif; ?>

    </div>
  </div>

  <script src="../js/main.js"></script>
</body>

</html>