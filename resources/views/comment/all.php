<?php include TEMPLATE_DIR . '/header.php'; ?>
<section>
    <div class="wrap">
    
        <a title="Участники" class="avatar-user right" href="/users">
            Учасники
        </a>

        <h1 class="top"><?php echo $data['title']; ?></h1>

        <div class="telo comments">
            <?php if (!empty($data['comments'])) { ?>
          
                <?php foreach ($data['comments'] as $comm) { ?>  
                    <div class="voters">
                        <div class="comm-up-id"></div>
                        <div class="score"><?= $comm['comment_votes'] ?></div>
                    </div>
                    <div class="comm-telo">
                        <div class="comm-header">
                            <img class="ava" src="/images/user/small/<?php echo $comm['avatar'] ?>">
                            <span class="user"> 
                                <a href="/u/<?php echo $comm['login']; ?>"><?php echo $comm['login']; ?></a> 
                                
                                <?php echo $comm['date']; ?>
                            </span> 
         
                            <span class="otst"> | </span>
                            <span class="date">  
                               <a href="/posts/<?php echo $comm['post_slug']; ?>"><?php echo $comm['post_title']; ?></a>
                            </span>
                        </div>
                        <div class="comm-telo-body">
                            <?php echo $comm['content']; ?> 
                        </div>
                    </div>
                <?php } ?>
                
                <div class="pagination">
              
                </div>
                
             <?php } else { ?>

                <h3>Нет комментариев</h3>

                <p>К сожалению комментариев нет...</p>

            <?php } ?>
        </div> 
     </div>
</section>
<?php include TEMPLATE_DIR . '/footer.php'; ?>   