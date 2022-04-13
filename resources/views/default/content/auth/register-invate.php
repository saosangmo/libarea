<?php
$form = new Forms();
$form->adding(['name' => 'email', 'type' => 'value', 'var' => $data['invate']['invitation_email']]);
$form->html_form($user['trust_level'], Config::get('form/auth.register'));
?>
<main class="box w-100">
  <h1><?= __('registration.invite'); ?></h1>
  <form class="max-w300" action="<?= getUrlByName('register'); ?>/add" method="post">
    <?php csrf_field(); ?>

    <?= $form->build_form(); ?>

    <fieldset>
      <input type="hidden" name="invitation_code" value="<?= $data['invate']['invitation_code']; ?>">
      <input type="hidden" name="invitation_id" value="<?= $data['invate']['uid']; ?>">
      <?= Html::sumbit(__('registration')); ?>
    </fieldset>
  </form>
</main>