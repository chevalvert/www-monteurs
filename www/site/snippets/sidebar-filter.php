<?php $current_filter = param(c::get('params.names')['lists.filter']) ?>
<div class="filter">
  <ul class="filter__items">
    <li class="filter__item">
      <a
        class="filter__item-link <?= r(!$current_filter, 'is-active', '') ?>"
        href="<?= url('./') ?>">tout voir</a>
    </li>

    <?php foreach ($filters as $item) : ?>
    <?php $slug = str::slug($item->title()) ?>
    <li class="filter__item">
      <a
        class="filter__item-link <?= r($current_filter == $slug, 'is-active', '') ?>"
        <?php // NOTE: not using `buildParamURL` because we want to clear other params when selecting a new category ?>
        href="<?= url('./' . url::paramsToString([c::get('params.names')['lists.filter'] => $slug])) ?>">
        <?= $item->title()->html() ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</div>
