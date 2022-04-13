<?php $profile = $data['profile']; ?>

<div class="mb-none">

  <div class="bg-violet box">
    <blockquote class="ml0 mb10 gray">
      <?= $profile['about']; ?>...
    </blockquote>
    <div class="gray-600">
      <i class="bi-calendar-week middle"></i>
      <span class="middle lowercase text-sm">
        <?= Html::langDate($profile['created_at']); ?>
        <sup class="ml5"><?= __('tl' . $profile['trust_level'] . '.title'); ?></sup>
      </span>
    </div>
  </div>

  <?php if ($data['blogs']) { ?>
    <div class="bg-violet box">
      <h3 class="uppercase-box"><?= __('created.by'); ?></h3>
      <?php foreach ($data['blogs'] as $blog) { ?>
        <div class="w-100 mb-w100 mb15 flex flex-row">
          <a class="mr10" href="<?= getUrlByName($blog['facet_type'], ['slug' => $blog['facet_slug']]); ?>">
            <?= Html::image($blog['facet_img'], $blog['facet_title'], 'img-lg', 'logo', 'max'); ?>
          </a>
          <div class="ml5 w-100">
            <a class="black" href="<?= getUrlByName($blog['facet_type'], ['slug' => $blog['facet_slug']]); ?>">
              <?= $blog['facet_title']; ?>
            </a>
            <div class="text-sm pr15 mb-pr0 gray-600">
              <?= $blog['facet_short_description']; ?>
              <div class="flex mt5 text-sm">
                <i class="bi-journal mr5"></i>
                <?= $blog['facet_count']; ?>
                <?php if ($blog['facet_focus_count'] > 0) { ?>
                  <i class="bi-people ml15 mr5"></i>
                  <?= $blog['facet_focus_count']; ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <?php if ($profile['my_post'] != 0) { ?>
    <?php $post = $data['post']; ?>
    <div class="bg-violet box">
      <h3 class="uppercase-box"><?= __('selected.post'); ?></h3>
      <div class="mt5">
        <a href="<?= getUrlByName('post', ['id' => $post['post_id'], 'slug' => $post['post_slug']]); ?>">
          <?= $post['post_title']; ?>
        </a>
        <?php if ($user['id'] > 0) { ?>
          <?php if ($profile['login'] == $user['login']) { ?>
            <a class="add-profile ml10" data-post="<?= $post['post_id']; ?>">
              <i class="bi-trash red"></i>
            </a>
          <?php } ?>
        <?php } ?>
        <div class="text-sm lowercase">
          <a class="gray" href="<?= getUrlByName('profile', ['login' => $profile['login']]); ?>">
            <?= Html::image($profile['avatar'], $profile['login'], 'ava-sm', 'avatar', 'small'); ?>
            <?= $profile['login']; ?>
          </a>
          <span class="gray-600 ml5"><?= $post['post_date'] ?></span>
          <?php if ($post['post_answers_count'] != 0) { ?>
            <a class="gray-600 right" href="<?= getUrlByName('post', ['id' => $post['post_id'], 'slug' => $post['post_slug']]); ?>">
              <i class="bi-chat-dots middle"></i>
              <?= $post['post_answers_count']; ?>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php if ($data['topics']) { ?>
    <div class="bg-violet box">
      <h3 class="uppercase-box"><?= __('is.reading'); ?></h3>
      <?php foreach ($data['topics'] as  $topic) { ?>
        <div class="mt5 mb5">
          <a class="flex relative items-center pt5 pb5 hidden gray" href="<?= getUrlByName('topic', ['slug' => $topic['facet_slug']]); ?>">
            <?= Html::image($topic['facet_img'], $topic['facet_title'], 'img-base', 'logo', 'small'); ?>
            <span class="bar-name text-sm"><?= $topic['facet_title']; ?></span>
          </a>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <?php if (!empty($data['participation'][0]['facet_id'])) { ?>
    <div class="bg-violet box">
      <h3 class="uppercase-box"><?= __('understands'); ?></h3>
      <?php foreach ($data['participation'] as $part) { ?>
        <a class="tags" href="<?= getUrlByName('topic', ['slug' => $part['facet_slug']]); ?>">
          <?= $part['facet_title']; ?>
        </a>
      <?php } ?>
    </div>
  <?php } ?>

  <div class="bg-violet box">
    <h3 class="uppercase-box"><?= __('contacts'); ?></h3>
    <?php foreach (Config::get('form/user-setting') as $block) { ?>
      <?php if ($profile[$block['title']]) { ?>
        <div class="mt5">
          <?= $block['lang']; ?>:
          <?php if ($block['url']) { ?>
            <a href="<?php if ($block['addition']) { ?><?= $block['addition']; ?><?php } ?><?= $profile[$block['url']]; ?>" rel="noopener nofollow ugc">
              <span class="mr5 ml5"><?= $profile[$block['title']]; ?></span>
            </a>
          <?php } else { ?>
            <span class="mr5 ml5"><?= $profile[$block['title']]; ?></span>
          <?php } ?>
        </div>
      <?php } else { ?>
        <?php if ('location' == $block['title']) { ?>
          <div class="mb20">
            <?= $block['lang']; ?>: ...
          </div>
        <?php } ?>
      <?php } ?>
    <?php } ?>
  </div>

  <div class="bg-violet box">
    <h3 class="uppercase-box"><?= __('badges'); ?></h3>
    <div class="m0 text-3xl">
      <i title="<?= __('medal.registration'); ?>" class="bi-gift sky"></i>
      <?php if ($profile['id'] < 50) { ?>
        <i title="<?= __('first.days'); ?>" class="bi-award green"></i>
      <?php } ?>
      <?php foreach ($data['badges'] as $badge) { ?>
        <?= $badge['badge_icon']; ?>
      <?php } ?>
    </div>
  </div>

  <?php if (UserData::checkAdmin()) { ?>
    <div class="boxe">
      <h3 class="uppercase-box"><?= __('admin'); ?></h3>
      <div class="mt5">
        <?php if ($profile['trust_level'] != UserData::REGISTERED_ADMIN) { ?>
          <?php if ($profile['ban_list'] == 1) { ?>
            <span class="type-ban gray mb5 block" data-id="<?= $profile['id']; ?>" data-type="user">
              <i class="bi-person-x-fill red middle mr5"></i>
              <span class="red text-sm"><?= __('unban'); ?></span>
            </span>
          <?php } else { ?>
            <span class="type-ban text-sm gray mb5 block" data-id="<?= $profile['id']; ?>" data-type="user">
              <i class="bi-person-x middle mr5"></i>
              <?= __('ban.it'); ?>
            </span>
          <?php } ?>
        <?php } ?>
        <a class="gray mb5 block" href="<?= getUrlByName('admin.user.edit', ['id' => $profile['id']]); ?>">
          <i class="bi-gear middle mr5"></i>
          <span class="middle"><?= __('edit'); ?></span>
        </a>
        <a class="gray block" href="<?= getUrlByName('admin.badges.user.add', ['id' => $profile['id']]); ?>">
          <i class="bi-award middle mr5"></i>
          <span class="middle"><?= __('reward.user'); ?></span>
        </a>
        <?php if ($profile['whisper']) { ?>
          <div class="tips text-sm pt15 pb10 gray-600">
            <i class="bi-info-square green mr5"></i>
            <?= $profile['whisper']; ?>
          </div>
        <?php } ?>
        <hr>
        <span class="gray">id<?= $profile['id']; ?> | Tl<?= $profile['trust_level']; ?> | <?= $profile['email']; ?></span>
      </div>
    </div>
  <?php } ?>
</div>