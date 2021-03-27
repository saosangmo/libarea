<?php include TEMPLATE_DIR . '/header.php'; ?>
<section>
    <div class="wrap">

        <a title="Участники" class="avatar-user right" href="/users">
            Участники
        </a>
        <h1 class="top"><?php echo $data['h1']; ?></h1>

        <div class="telo posts">
            <?php if (!empty($posts)) { ?>
          
                <?php foreach ($posts as $post) { ?> 
              
                    <div id="vot<?php echo $post['post_id']; ?>" class="voters">
                        <div data-id="<?php echo $post['post_id']; ?>" class="post-up-id"></div>
                        <div class="score"><?php echo $post['post_votes']; ?></div>
                    </div>
                
                    <div class="post-telo">
                        <a class="u-url" href="/posts/<?php echo $post['post_slug']; ?>">
                            <h3 class="titl"><?php echo $post['post_title']; ?></h3>
                        </a>
                        
                        <a class="space space_<?= $post['space_tip'] ?>" href="/s/<?= $post['space_slug']; ?>" title="<?= $post['space_name']; ?>">
                            <?= $post['space_name']; ?>
                        </a>
                        
                        <div class="footer">
                            <img class="ava" src="/uploads/avatar/small/<?php echo $post['avatar']; ?>">
                            <span class="user"> 
                                <a href="/u/<?php echo $post['login']; ?>"><?php echo $post['login']; ?></a> 
                            </span>
                            <span class="date"> 
                                <?php echo $post['post_date']; ?>
                            </span>
                            <?php if($post['post_comments'] !=0) { ?> 
                                <span class="otst"> | </span>
                                комментариев (<?php echo $post['post_comments'] ?>) 
                                 
                            <?php } ?>
                        </div>  
                    </div>
           
                <?php } ?>

            <?php } else { ?>

                <h3>Нет постов</h3>

                <p>К сожалению постов нет...</p>

            <?php } ?>
        </div> 
    </div>
</section>
<?php include TEMPLATE_DIR . '/footer.php'; ?> 