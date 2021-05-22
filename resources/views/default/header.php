<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <?php getRequestHead()->output(); ?>
 
        <?php if (isset($post['post_is_delete'])) { ?>  
            <meta name="robots" content="noindex" />
        <?php } ?>

        <link rel="canonical" href="<?= $data['canonical']; ?>">
        
        <link rel="icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/favicon.png">

        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    
<body class="bd<?php if(Request::getCookie('dayNight') == 'dark') {?> dark<?php } ?>">

<div class="wrap">
    <header>
        <div class="header-left"> 
            <a title="<?= lang('Home'); ?>" class="logo" href="/">LORI<span>UP</span></a>

            <form class="form" method="post" action="/search">
                <?= csrf_field() ?>
                <input type="text" name="q" id="search" placeholder="Найти..." class="form-search">
            </form>
           
           <a class="link no-mob" href="/space"><?= lang('Space'); ?></a> 
           <a class="link no-mob" href="/flow"><?= lang('Flow'); ?></a>

        </div>
        <div class="header-right right">
 
            <?php if(!$uid['id']) { ?> 
                <div class="nav">        
                    <?php if(!Lori\Config::get(Lori\Config::PARAM_INVITE)) { ?>
                        <div class="nav">
                            <a class="register" title="<?= lang('Sign up'); ?>" href="/register">
                                <?= lang('Sign up'); ?>
                            </a>
                        </div>
                    <?php } ?>  
                    <div class="nav no-pc">
                        <a class="login" title="<?= lang('Sign in'); ?>" href="/login"><?= lang('Sign in'); ?></a>
                    </div> 
                </div>                  
            <?php } else { ?> 
                <div class="dropbtn nav">
                    <div class="nick" title=""><span><?= $uid['login']; ?></span>  
                        <img class="ava" alt="<?= $uid['login']; ?>" src="/uploads/users/avatars/small/<?= $uid['avatar']; ?>">
                        <i class="icon arrow arrow-down"></i>
                    </div>
                    <div class="dropdown-menu">
                        <span class="st"></span>
                        <a href="/u/<?= $uid['login']; ?>">
                            <i class="icon user"></i>
                            <?= lang('Profile'); ?>
                        </a>
                        <a href="/u/<?= $uid['login']; ?>/setting">
                            <i class="icon settings"></i>
                            <?= lang('Settings'); ?>
                        </a>
                        <a href="/u/<?= $uid['login']; ?>/drafts">
                            <i class="icon book-open"></i>
                            <?= lang('Drafts'); ?>
                        </a>
                        <a href="/u/<?= $uid['login']; ?>/notifications">
                            <i class="icon bell"></i> 
                            <?= lang('Notifications'); ?>
                        </a>
                        <a href="/u/<?= $uid['login']; ?>/messages">
                            <i class="icon envelope"></i> 
                            <?= lang('Messages'); ?>
                        </a>
                        <a href="/u/<?= $uid['login']; ?>/comments"> 
                            <i class="icon bubbles"></i>
                            <?= lang('Comments'); ?> 
                        </a>
                        <a href="/u/<?= $uid['login']; ?>/favorite">
                            <i class="icon star"></i> 
                            <?= lang('Favorites'); ?>              
                        </a>
                        <?php if($uid['trust_level'] > 1) { ?>
                            <a href="/u/<?= $uid['login']; ?>/invitation">
                                <i class="icon link"></i>   
                                <?= lang('Invites'); ?>                   
                            </a> 
                        <?php } ?>  
                        <?php if($uid['trust_level'] == 5) { ?> 
                            <a href="/admin" target="_black">
                                <i class="icon shield"></i>    
                                <?= lang('Admin'); ?>                   
                            </a> 
                        <?php } ?>     
                        <hr>   
                        <a href="/logout" class="logout" target="_self" title="<?= lang('Sign out'); ?>">
                            <i class="icon logout"></i> 
                            <?= lang('Sign out'); ?>
                        </a>
                    </div>
                </div>
                <div class="nav create">  
                    <a class="add-post" href="/post/add"> 
                        <i class="icon pencil"></i>                    
                    </a>
                </div>   
                <?php if($uid['notif']) { ?> 
                    <div class="nav notif">  
                        <a href="/u/<?= $uid['login']; ?>/notifications"> 
                            <?php if($uid['notif']['action_type'] == 1) { ?>
                                <i class="icon envelope"></i>
                            <?php } else { ?>    
                                <i class="icon bell"></i>
                            <?php } ?>
                        </a>
                    </div>  
                <?php } ?>  
            <?php } ?>  

            <div class="nav">
                <span id="toggledark" class="my-color-m">
                    <i class="icon frame"></i> 
                </span>
            </div>
            
        </div>
    </header>
    
<?php if(!empty($post['post_title'])) { ?>
    <div id="stHeader">
        <a href="/"><i class="icon home"></i></a> <span class="slash">\</span> <?= $post['post_title']; ?>
    </div>
<?php } ?>

 
<?php if ($uid['msg']) { ?>
    <?php foreach($uid['msg'] as $message) { ?>
        <?= $message; ?>
    <?php } ?>
<?php } ?>

<?php if(!empty($space_bar)) { ?>
    <?php if(!$space_bar && $uid['uri'] == '/') { ?>
        <div class="space-no-user"> 
            <i class="icon diamond"></i>
            Читайте больше!  <a href="/space">Подпишитесь</a> на пространства, которые вам интересны.
        </div>
    <?php }  ?>
<?php }  ?>