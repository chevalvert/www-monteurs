<?php $nolink = isset($nolink) && $nolink ?>

<div class="label">
  <time class="label__time" datetime="<?= $article->date() ?>">
    <?= $article->date(c::get('date.format')) ?>
  </time>

  <?php if ($article->categories()->exists()) : ?>
    <?php if ($article->categories()->isNotEmpty()) : ?>
    <span class="label__categories">
    <?php foreach ($article->categories()->split(',') as $category_id) : ?>
      <?php $url = url($article->parent()->url() . '/' . c::get('params.names')['lists.filter'] . ':' . $category_id) ?>
      <?php if (!$nolink) : ?><a class="label__category" href="<?= $url ?>"><?php endif ?>
        <?= unslug_category(getTopLevelPage($article)->intendedTemplate(), $category_id) ?>
      <?php if (!$nolink) : ?></a><?php endif ?>
    <?php endforeach ?>
    </span>
    <?php endif ?>
  <?php else : ?>
  <span class="label__categories">
    <?php if ($nolink) : ?>
      <?= getTopLevelPage($article)->title()->html() ?>
    <?php else :?>
    <?php snippet('link', [
      'class' => 'label__category',
      'obj' => getTopLevelPage($article)
    ]) ?>
    <?php endif ?>
  </span>
  <?php endif ?>
</div>
