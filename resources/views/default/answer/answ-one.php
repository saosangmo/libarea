<ol class="answer-telo"> 
    <li class="answers_subtree" id="answ_<?= $answ['answer_id']; ?>">

       <?php if ($answ['answ_vote_status'] || $uid['id'] == $answ['answer_user_id']) { ?>
            <div class="voters active">
                <div class="answ-up-id"></div>
                <div class="score"><?= $answ['answer_votes']; ?></div>
            </div>
        <?php } else { ?>
            <div id="up<?= $answ['answer_id']; ?>" class="voters">
                <div data-id="<?= $answ['answer_id']; ?>" class="answ-up-id"></div>
                <div class="score"><?= $answ['answer_votes']; ?></div>
            </div>
        <?php } ?>

        <div class="answ-telo">
            <div class="answ-header">
                <img class="ava" src="/uploads/avatar/small/<?= $answ['avatar'] ?>">
                <span class="user"> 
                    <a href="/u/<?= $answ['login']; ?>"><?= $answ['login']; ?></a> 
                </span> 
                <span class="date">  
                   <?= $answ['date']; ?>
                </span>
                <span class="date">  
                    <?php if ($data['post']['post_user_id'] == $answ['answer_user_id']) { ?><span class="authorpost">&#x21af;</span> <?php } ?>
                </span>
                <span class="date">
                    <a rel="nofollow" href="/post/<?= $data['post']['post_slug']; ?>#answ_<?= $answ['answer_id']; ?>">#</a>
                </span>
                <?php if ($answ['level'] != 0) { ?> 
                    <span class="date">
                        <a rel="nofollow" href="/post/<?= $data['post']['post_slug']; ?>#answ_<?= $answ['answer_on']; ?>">&#8679;</a>
                    </span>
                <?php } ?> 
            </div>
            <div class="answ-telo-body">
                <?= $answ['content'] ?> 
            </div>
        </div>
        <span id="answ_add_link<?php $answ['answer_id']; ?>" class="answ_add_link">
            <a data-post_id="<?= $data['post']['id']; ?>" data-id="<?= $answ['comment_id']; ?>" class="addansw">Ответить</a>
        </span>

        <div id="answ_addentry<?= $answ['answer_id']; ?>" class="reply"></div> 
    
    </li>
</ol>