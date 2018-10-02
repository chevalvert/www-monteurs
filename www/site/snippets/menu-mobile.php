<header role="banner" class="menu-mobile">
  <div class="menu-mobile__logo">
    <a href="<?= $site->url() ?>" class="menu-mobile__logo-link" title="Retour à l'accueil" tabindex="1">
      <?php snippet('svg/logo--full') ?>
    </a>
  </div>

  <input type="checkbox" class="menu-mobile__toggle" id="menuMobileToggle" style="display:none"/>
  <label for="menuMobileToggle" class="menu-mobile__toggle-label"></label>

  <nav role="navigation" class="menu-mobile__nav">
    <ul class="menu-mobile__nav-items">
    <?php $tabindex = 1 ?>
    <?php foreach ($pages->visible() as $item) : ?>
      <li class="menu-mobile__nav-item <?= r($item->isOpen(), ' is-open') ?> <?= r($item->isActive(), ' is-active') ?>">
        <?php snippet('link', [
          'obj' => $item,
          'class' => 'menu-mobile__nav-item-link',
          'tabindex' => ++$tabindex
        ]) ?>
      </li>
    <?php endforeach ?>

      <li class="menu-mobile__nav-item">
        <?php snippet('link', ['uri' => 'adhesion', 'class' => 'menu-mobile__nav-item-link']) ?>
      </li>
    </ul>

    <form class="searchform" action="<?= $site->find('rechercher')->url() ?>" >
      <input class="searchform__input" autofocus type="search" placeholder="rechercher…" name="q" value="<?= isset($query) ? esc($query) : '' ?>">
      <button class="searchform__button" type="submit"><?php snippet('svg/magnifying-glass') ?></button>
    </form>
  </nav>
</header>
