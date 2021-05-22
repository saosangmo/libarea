<?php include TEMPLATE_DIR . '/header.php'; ?>
<main class="w-75">
    <h1><?= $data['h1']; ?></h1>
    <div class="box wide">
        <form class="" action="/register/add" method="post">
            <?php csrf_field(); ?>
            <div class="boxline">
                <label for="login"><?= lang('Nickname'); ?></label>
                <input type="text" name="login" id="login">
     
            </div>
            <div class="boxline">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>
            <div class="boxline">
                <label for="password"><?= lang('Password'); ?></label>
                <input type="password" name="password" id="password">
            </div>
             <div class="boxline">
                <label for="password_confirm"><?= lang('repeat-password'); ?></label>
                <input type="password" name="password_confirm" id="password_confirm">
            </div>    
            <?php if (Lori\Config::get(Lori\Config::PARAM_CAPTCHA)) { ?>
                <div class="captcha_data">
                    <div class="captcha_wrap">
                        <div class="g-recaptcha" data-theme="light" data-size="normal" data-callback="captcha_ready" data-sitekey="<?= Lori\Config::get(Lori\Config::PARAM_PUBLIC_KEY); ?>"></div>
                        <script async defer nonce="" src="https://www.google.com/recaptcha/api.js?hl=ru"></script>
                    </div>
                </div>   <br />
            <?php } ?>
            <div class="boxline">
                <div class="boxline">
                    <button type="submit" class="button-primary"><?= lang('Sign up'); ?></button>
                    <small>
                        <span class="otst"><a href="/login"><?= lang('Sign in'); ?></a></span>
                    </small>
                </div>

            </div>
        </form>
    </div>
</main>
<?php include TEMPLATE_DIR . '/footer.php'; ?>