<?php snippet('menu-mobile') ?>

<header role="banner" class="menu">
  <div class="menu__logo">
    <div class="menu__logo--full">
      <a href="<?= $site->url() ?>" class="menu__logo-link" title="Retour à l'accueil" tabindex="1">
        <?php snippet('svg/logo--full') ?>
      </a>
    </div>

    <nav class="menu__logo-nav">
      <ul class="menu__logo-nav-items">
        <li class="menu__logo-nav-item">
          <div class="menu__logo--compact">
            <a href="<?= $site->url() ?>" class="menu__logo-link" title="Retour à l'accueil">
              <?php snippet('svg/logo--compact') ?>
            </a>
          </div>
        </li>
        <li class="menu__logo-nav-item">
          <?php snippet('link', ['uri' => 'rechercher', 'content' => snippet('svg/magnifying-glass', [], true)]) ?>
        </li>
        <li class="menu__logo-nav-item">
          <?php snippet('link', ['uri' => 'adhesion', 'class' => 'menu__logo-nav-item-link']) ?>
        </li>
      </ul>
    </nav>
  </div>

  <nav role="navigation" class="menu__nav">
    <ul class="menu__nav-items">
    <?php $tabindex = 1 ?>
    <?php foreach ($pages->visible() as $item) : ?>
      <li class="menu__nav-item <?= r($item->isOpen(), ' is-open') ?> <?= r($item->isActive(), ' is-active') ?>">
        <?php snippet('link', [
          'obj' => $item,
          'class' => 'menu__nav-item-link',
          'tabindex' => ++$tabindex
        ]) ?>
      </li>
    <?php endforeach ?>
    </ul>
  </nav>
</header>
