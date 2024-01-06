<main>
  <div class="indent-body">
    <?= insert('/content/user/setting/nav'); ?>

    <div class="mt20">
      <form action="<?= url('setting.change', ['type' => 'preferences']); ?>" accept-charset="UTF-8" method="post">
        <?php csrf_field(); ?>

        <div class="mb15">
          <input name="id[]" value="-1" type="checkbox" <?php if ($data['blocks'][0]['facet_id'] == -1) : ?> checked<?php endif; ?>> <?= __('app.show_sites_block'); ?>
        </div>

        <h2 class="title"><?= __('app.signed_facets'); ?></h2>
        <span class="gray-600 text-xs">
          <?= __('app.signed_facets_help', ['num' => config('facets.quantity_home')]); ?>
        </span>

        <div class="tasks__list mt15 mb15">
          <?php foreach ($data['facets'] as $facet) : ?>
            <div class="flex flex-row items-center gap-min mb15 tasks__item">
              <input name="id[]" value="<?= $facet['facet_id']; ?>" type="checkbox" <?php if ($facet['facet_output']) : ?> checked<?php endif; ?>>
              <a title="<?= $facet['facet_title']; ?>" href="<?= url($facet['facet_type'], ['slug' => $facet['facet_slug']]); ?>">
                <?= Img::image($facet['facet_img'], $facet['facet_title'], 'img-sm', 'logo', 'max'); ?>
              </a>
              <?= $facet['facet_title']; ?>
              <?php if ($facet['facet_type'] == 'blog') : ?><sup class="red lowercase"><?= __('app.blog'); ?></sup><?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="mb15">
          <?= Html::pagination($data['pNum'], $data['pagesCount'], null, 'preferences', '?'); ?>
        </div>

        <?= Html::sumbit(__('app.edit')); ?>
      </form>
    </div>
</main>

<aside>
  <div class="box bg-beige">
    <?= __('app.preferences_help'); ?>
  </div>
</aside>

<script nonce="<?= $_SERVER['nonce']; ?>">
  const tasksListElement = document.querySelector(`.tasks__list`);
  const taskElements = tasksListElement.querySelectorAll(`.tasks__item`);

  for (const task of taskElements) {
    task.draggable = true;
  }

  tasksListElement.addEventListener(`dragstart`, (evt) => {
    evt.target.classList.add(`selected`);
  });

  tasksListElement.addEventListener(`dragend`, (evt) => {
    evt.target.classList.remove(`selected`);
  });

  const getNextElement = (cursorPosition, currentElement) => {
    const currentElementCoord = currentElement.getBoundingClientRect();
    const currentElementCenter = currentElementCoord.y + currentElementCoord.height / 2;

    const nextElement = (cursorPosition < currentElementCenter) ?
      currentElement :
      currentElement.nextElementSibling;

    return nextElement;
  };

  tasksListElement.addEventListener(`dragover`, (evt) => {
    evt.preventDefault();

    const activeElement = tasksListElement.querySelector(`.selected`);
    const currentElement = evt.target;
    const isMoveable = activeElement !== currentElement &&
      currentElement.classList.contains(`tasks__item`);

    if (!isMoveable) {
      return;
    }

    const nextElement = getNextElement(evt.clientY, currentElement);

    if (
      nextElement &&
      activeElement === nextElement.previousElementSibling ||
      activeElement === nextElement
    ) {
      return;
    }

    tasksListElement.insertBefore(activeElement, nextElement);
  });
</script>