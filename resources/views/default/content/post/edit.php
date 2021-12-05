<?php $post = $data['post']; ?>
<main class="col-span-12 mb-col-12 pt5 pr15 pb20 pl15 edit-post">

  <?= breadcrumb(
    '/',
    Translate::get('home'),
    getUrlByName('post', ['id' => $post['post_id'], 'slug' => $post['post_slug']]),
    $post['post_title'],
    Translate::get('edit post')
  ); ?>

  <div class="br-box-gray bg-white p15">
    <form action="<?= getUrlByName('post.edit.pr'); ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>

      <?= includeTemplate('/_block/form/field-input', ['data' => [
        [
          'title' => Translate::get('heading'),
          'type' => 'text',
          'name' => 'post_title',
          'value' => $post['post_title'],
          'min' => 6,
          'max' => 250,
          'help' => '6 - 250 ' . Translate::get('characters'),
          'red' => 'red'
        ],
      ]]); ?>

      <?= includeTemplate('/_block/form/select', [
        'uid'         => $uid,
        'data'        => $data,
        'action'      => 'edit',
        'type'        => 'blog',
        'maximum'     => 1,
        'title'       => Translate::get('blogs'),
        'required'    => false,
        'help'        => '...',
      ]); ?>

      <?= includeTemplate('/_block/form/select', [
        'uid'           => $uid,
        'data'          => $data,
        'action'        => 'edit',
        'type'          => 'topic',
        'title'         => Translate::get('topics'),
        'required'      => false,
        'maximum'       => 3,
        'help'          => Translate::get('necessarily'),
        'red'           => 'red'
      ]); ?>

      <?php if ($post['post_url']) { ?>
        <div class="mb20">
          <label class="block mb5" for="post_title">URL:</label>
          <a target="_blank" rel="noreferrer ugc" href="<?= $post['post_url']; ?>" class="size-14">
            <?= $data['post']['post_url']; ?>
          </a>
        </div>
      <?php } ?>

      <div class="file-upload mb20" id="file-drag">
        <div class="flex">
             <?php if ($post['post_content_img']) { ?>
            <div class="img-post-edit">
              <?= post_img($post['post_content_img'], $post['post_title'], 'img-post', 'cover'); ?>
              <input type="hidden" name="images" value="<?= $post['post_content_img']; ?>">
              <a class="img-remove size-14" href="/post/img/<?= $post['post_id']; ?>/remove">
                <?= Translate::get('remove'); ?>
              </a>
            </div>
          <?php } ?>
       
          <img id="file-image" src="#" alt=" " class="mr20 w200 br-box-gray">
            <div id="start">
              <input id="file-upload" type="file" name="images" accept="image/*" />
              <i class="fa fa-download" aria-hidden="true"></i>
              <div id="notimage" class="none">Please select an image</div>
            </div>
        </div>
        <div id="response" class="hidden">
          <div id="messages"></div>
        </div>
      </div>
      
      
      <?php if ($post['post_thumb_img']) { ?>
        <?= post_img($post['post_thumb_img'], $post['post_title'], 'thumb right', 'thumbnails'); ?>
      <?php } ?>

      <?= includeTemplate('/_block/editor/editor', [
        'type'      => 'post',
        'height'    => '300px',
        'preview'   => 'vertical',
        'lang'      => $uid['user_lang'],
        'content'   => $post['post_content'],
      ]); ?>

      <?php if ($data['post']['post_draft'] == 1) { ?>
        <?= includeTemplate('/_block/form/field-radio', [
          'data' => [
            [
              'title' => Translate::get('is this a draft?'),
              'name' => 'post_draft',
              'checked' => $post['post_draft']
            ],
          ]
        ]); ?>
      <?php } ?>

      <?php if ($uid['user_trust_level'] > 0) { ?>
        <?= includeTemplate('/_block/form/select-content-tl', [
          'uid' => $uid,
          'data' => $post['post_tl']
        ]); ?>

        <?= includeTemplate('/_block/form/field-radio', [
          'data' => [
            [
              'title' => Translate::get('format Q&A?'),
              'name' => 'post_type',
              'checked' => $post['post_type']
            ],
            [
              'title' => Translate::get('to close?'),
              'name' => 'closed',
              'checked' => $post['post_closed']
            ],
          ]
        ]); ?>
      <?php } ?>

      <?= includeTemplate('/_block/form/field-radio', [
        'data' => [
          [
            'title' => Translate::get('is this a translation?'),
            'name' => 'translation',
            'checked' => $post['post_translation']
          ],
        ]
      ]); ?>

      <?php if ($uid['user_trust_level'] > 2) { ?>
        <?= includeTemplate('/_block/form/field-radio', [
          'data' => [
            [
              'title' => Translate::get('raise?'), 'name' => 'top',
              'checked' => $post['post_top']
            ],
          ]
        ]); ?>
      <?php } ?>

      <?php if ($uid['user_trust_level'] > 4) { ?>
        <?= includeTemplate('/_block/form/select', [
          'uid'           => $uid,
          'data'          => $data['user'],
          'action'        => 'edit',
          'type'          => 'user',
          'title'         => Translate::get('author'),
          'required'      => false,
          'maximum'       => 1,
          'help'          => Translate::get('necessarily'),
          'red'           => 'red'
        ]); ?>
      <?php } ?>

      <?= includeTemplate('/_block/form/select', [
        'uid'           => $uid,
        'data'          => $data,
        'action'        => 'edit',
        'type'          => 'post',
        'title'         => Translate::get('related'),
        'required'      => false,
        'maximum'       => 3,
        'help'          => Translate::get('necessarily'),
      ]); ?>


      <div class="mb20">
        <?php if ($post['post_draft'] == 1) { ?>
          <input type="hidden" name="draft" id="draft" value="1">
        <?php } ?>
        <input type="hidden" name="post_id" id="post_id" value="<?= $post['post_id']; ?>">
        <?= sumbit(Translate::get('edit')); ?>
      </div>
    </form>
  </div>
</main>