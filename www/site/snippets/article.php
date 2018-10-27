<article class="article">
  <header class="article__header">
    <?php
      $showDate = $article->showDate() && $article->showDate()->bool();
      $lang = $site->language() == 'fr' ? 'en' : 'fr';
      $translated = $page->content($lang)->exists();
      if ($showDate || $translated) :
    ?>
    <div class="label">
      <?php if ($showDate) : ?>
      <span class="label__mtime">
        mis à jour le <time class="label__time" datetime="<?= $article->date() ?>"><?= $article->date(c::get('date.format')) ?></time>
      </span>
      <?php endif ?>

      <?php if ($translated) : ?>
        <span class="label__translation">
          <a href="<?= $article->url($lang) ?>">
            <?= r($lang == 'en', 'go to english version', 'voir la version française') ?>
          </a>
        </span>
      <?php endif ?>
    </div>
    <?php endif ?>

  <?php if ($image = $article->cover()->isNotEmpty() ? $article->image($article->cover()) : null) : ?>
    <?php snippet('article-figure', [
      'zoomable' => true,
      'ratio' => 16/9,
      'image' => $image,
      'class' => 'article__header-cover'
    ]) ?>
  <?php endif ?>
  </header>

  <div class="article__content">
    <?= $article->text()->anchors()->kirbytext() ?>
  </div>
</article>
