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

      <div class="main__content">
        <div class="publications">
          <ul class="publications__items">
          <?php foreach ($page->children()->visible() as $publication) : ?>
            <li class="publications__item">
              <article class="publication">
                <a class="publication__link" href="<?= $publication->url() ?>">
                  <?php if ($image = $publication->cover()->isNotEmpty() ? $publication->image($publication->cover()) : null) : ?>
                  <?php snippet('article-figure', [
                    'ratio' => 148/210, // A3 ratio
                    'zoomable' => false,
                    'preview' => false,
                    'image' => $image,
                    'class' => 'publication__cover'
                  ]) ?>
                  <?php endif ?>
                  <?php snippet('label', [
                    'article' => $publication,
                    'nolink' => true
                  ]) ?>
                  <h1 class="publication__title">
                    <?= $publication->title()->html() ?>
                  </h1>
                </a>
              </article>
            </li>
          <?php endforeach ?>
          </ul>
        </div>
      </div>
    </section>

  </div>
</main>

<?php snippet('footer') ?>
