<main>
  <h2 class="title"><?= __('app.add_poll'); ?></h2>
  <form action="<?= url('content.create', ['type' => 'poll']); ?>" id="myform" method="post">
    <?= csrf_field() ?>
    <fieldset>
      <input type="text" name="title" />
    </fieldset>
    <fieldset class="max-w300">
      <p><?= __('app.option'); ?> 1: <input type="text" id="in1" name="1" /></p>
      <p><?= __('app.option'); ?> 2: <input type="text" id="in2" name="2" /></p>
    </fieldset>
    <div class="flex gap items-center">
      <div class="add-el gray-600 text-sm">+ <?= __('app.option'); ?></div>
      <?= Html::sumbit(__('app.add_poll')); ?>
    </div>
  </form>
</main>
<aside>
  <div class="box box-shadow-all text-sm">
    <h4 class="uppercase-box"><?= __('app.help'); ?></h4>
    <?= __('help.add_poll'); ?>
  </div>
</aside>

<script nonce="<?= $_SERVER['nonce']; ?>">
  let maxFieldLimit = 6;

  queryAll(".add-el").forEach(el => el.addEventListener("click", function(e) {
    addEl();
  }));

  function addEl() {
    let inputs = document.querySelectorAll('input[type="text"]')
    let lastNum = ((inputs[inputs.length - 1]).getAttribute('name'));
    let nextNum = Number(lastNum) + 1;

    if (nextNum >= maxFieldLimit) {
      alert("<?= __('msg.field_limit'); ?> = " + maxFieldLimit);
      return false;
    }

    let elem = document.createElement("p");
    elem.innerHTML = `<?= __('app.option'); ?> ${nextNum}: <input type="text" id="in${nextNum}" name="${nextNum}">`;

    let parentGuest = document.getElementById("in" + lastNum);
    parentGuest.parentNode.insertBefore(elem, parentGuest.nextSibling);
  }
</script>