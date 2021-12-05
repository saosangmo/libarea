<main class="col-span-9 mb-col-12">
  <div class="bg-white br-rd5 br-box-gray pt5 pr15 pb5 pl15">
    <?= breadcrumb(
      '/',
      Translate::get('home'),
      getUrlByName('user', ['login' => $uid['user_login']]) . '/messages',
      Translate::get('all messages'),
      $data['h1']
    ); ?>

    <form action="<?= getUrlByName('messages.send'); ?>" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="recipient" value="<?= $data['recipient_user']['user_id']; ?>" />
      <textarea rows="3" id="message" class="mess" placeholder="<?= Translate::get('write'); ?>..." type="text" name="content" /></textarea>
      <?= sumbit(Translate::get('reply')); ?>
    </form>

    <?php if ($data['list']) { ?>
      <?php foreach ($data['list'] as $key => $val) { ?>
        <div class="hidden w-100 mb15">
          <?php if ($val['message_sender_id'] == $uid['user_id']) { ?>
            <div class="w-20">
              <?= user_avatar_img($uid['user_avatar'], 'max', $uid['user_login'], 'br-rd-50 w44 mt15 left'); ?>
            </div>
            <div class="p15 br-rd5 w-70 relative bg-gray-100 black left">
            <?php } else { ?>
              <a class="right" href="<?= getUrlByName('user', ['login' => $val['user_login']]); ?>">
                <?= user_avatar_img($val['user_avatar'], 'max', $val['user_login'], 'br-rd-50 w44 right'); ?>
              </a>

              <div class="p15 br-rd5 w-70 relative right black bg-yellow-100">
                <a class="left" href="<?= getUrlByName('user', ['login' => $val['user_login']]); ?>">
                  <?= $val['user_login']; ?>: &nbsp;
                </a>
              <?php } ?>

              <?= $val['message_content']; ?>

              <div class="size-14 gray mt5">
                <?= $val['message_add_time']; ?>
                <?php if ($val['message_receipt'] and $val['message_sender_id'] == $uid['user_id']) { ?>
                  <?= Translate::get('it was read'); ?> (<?= $val['message_receipt']; ?>)
                <?php } ?>
              </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
        </div>
</main>
<?= includeTemplate('/_block/sidebar/lang', ['lang' => Translate::get('under development')]); ?>