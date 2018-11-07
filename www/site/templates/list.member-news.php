<?php snippet('header') ?>
<?php snippet('menu') ?>

<main id="main" role="main">
  <div class="js-wrapper" data-namespace="<?= $page->template() ?>">

    <header class="main__header">
      <div class="main__header-pusher"></div>
      <section class="main__header-content">
        <h1 class="main__header-title"><?= $page->title()->html() ?></h1>
      </section>
    </header>

    <section class="main__body">
      <aside class="main__sidebar">
        <?php snippet('sidebar', [
          'actions' => [
            snippet('link', ['obj' => $site->page('annoncer-une-actualite')], true)
          ]
        ]) ?>
      </aside>
      <div class="main__content">
      <?php foreach ($page->children()->sortBy('date', 'DESC')->visible() as $article) : ?>
      <?php snippet('article-excerpt', [
        'article' => $article,
        'length' => 300
      ]) ?>
      <?php endforeach ?>
      </div>
    </section>

  </div>
</main>

<?php snippet('footer') ?>
