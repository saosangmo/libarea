<?php include TEMPLATE_DIR . '/header.php'; ?>
<div class="wrap">
    <main>
        <div class="white-box">
            <div class="pt5 pr15 pb0 pl15">
                <?= breadcrumb('/', lang('Home'), '/u/' . $uid['user_login'], lang('Profile'), $data['h1']); ?>
                <ul class="nav-tabs mt0 mb15">
                  <?php if ($data['sheet'] == 'favorites') { ?>
                    <li class="active">
                      <span><?= lang('Favorites'); ?></span>
                    </li>
                    <li>
                      <a href="/u/<?= $uid['user_login']; ?>/preferences">
                        <span><?= lang('Preferences'); ?></span>
                      </a>
                    </li>
                  <?php } elseif ($data['sheet'] == 'preferences') { ?>
                    <li>
                      <a href="/u/<?= $uid['user_login']; ?>/favorite">
                        <span><?= lang('Favorites'); ?></span>
                      </a>
                    </li>
                    <li class="active">
                      <span><?= lang('Preferences'); ?></span>
                    </li>
                  <?php } ?>
                </ul>
            </div>
        </div>
        
        <?php if (!empty($favorite)) { ?>
            <?php foreach ($favorite as $fav) { ?>
                <div class="white-box">
                    <div class="pt5 pr15 pb5 pl15">
                        <?php if ($fav['favorite_type'] == 1) { ?>
                            <div class="mt15 mb15">
                                <?php if ($uid['user_id'] == $fav['favorite_user_id']) { ?>
                                    <span class="add-favorite size-13 right" data-id="<?= $fav['post_id']; ?>" data-type="post">
                                        <?= lang('Remove'); ?>
                                    </span>
                                 <?php } ?>
                            
                                <div>
                                    <a href="/post/<?= $fav['post_id']; ?>/<?= $fav['post_slug']; ?>">
                                        <h3 class="title size-21 mt5 mb5">
                                            <?= $fav['post_title']; ?>
                                        </h3>
                                    </a>
                                </div>
                                <div class="lowercase size-13">
                                    <a class="mr5 gray" href="/u/<?= $fav['user_login']; ?>">
                                        <?= user_avatar_img($fav['user_avatar'], 'small', $fav['user_login'], 'ava'); ?>
                                        <span class="mr5"></span>
                                        <?= $fav['user_login']; ?>
                                    </a>

                                    <span class="mr5 gray">
                                        <?= $fav['date']; ?>
                                    </span>

                                    <a class="mr5 gray" href="/s/<?= $fav['space_slug']; ?>" title="<?= $fav['space_name']; ?>">
                                        <?= $fav['space_name']; ?>
                                    </a>
                                    <?php if ($fav['post_answers_count'] != 0) { ?>
                                        <a class="mr5 gray" href="/post/<?= $fav['post_id']; ?>/<?= $fav['post_slug']; ?>">
                                            <i class="icon-commenting-o middle"></i> <?= $fav['post_answers_count'] ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div> 
                        <?php } ?>
                        <?php if ($fav['favorite_type'] == 2) { ?>
                            <div>
                                <?php if ($uid['user_id'] == $fav['favorite_user_id']) { ?>
                                    <span class="add-favorite right size-13" data-id="<?= $fav['answer_id']; ?>" data-type="answer">
                                        <?= lang('Remove'); ?>
                                    </span>
                                <?php } ?>
                                <div>
                                    <a href="/post/<?= $fav['post']['post_id']; ?>/<?= $fav['post']['post_slug']; ?>#answer_<?= $fav['answer_id']; ?>">
                                        <h3 class="title size-21 vertical">
                                            <?= $fav['post']['post_title']; ?>
                                        </h3>
                                    </a>
                                </div>    
                                <div class="space-color space_<?= $fav['post']['space_color'] ?>"></div>
                                <a class="mr5 ml5 gray size-13" href="/s/<?= $fav['post']['space_slug']; ?>" title="<?= $fav['post']['space_name']; ?>">
                                    <?= $fav['post']['space_name']; ?>
                                </a>
                                <blockquote>
                                    <?= $fav['answer_content']; ?>
                                </blockquote>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?= no_content('There are no favorites'); ?>
        <?php } ?>
    </main>
    <aside>
        <div class="white-box">
            <div class="p15">
                <?= lang('info_favorite'); ?>...
            </div>
        </div>
    </aside>
</div>
<?php include TEMPLATE_DIR . '/footer.php'; ?>