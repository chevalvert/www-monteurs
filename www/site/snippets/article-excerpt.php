<article class="article">
  <header class="article__header">
    <?php snippet('label', compact('article')) ?>
    <h1 class="article__header-title">
      <a class="article__header-title-link" href="<?= $article->url() ?>">
        <?php if (strpos($article->categories(), 'comptes-rendus')) : ?>
        <span class="article__header-title-prefix">compte rendu</span>
        <?php endif ?>
        <?= $article->title()->html() ?>
      </a>
    </h1>
    <?php if ($image = $article->cover()->isNotEmpty() ? $article->image($article->cover()) : null) : ?>
    <?php snippet('link', [
      'obj' => $article,
      'class' => 'article__header-cover-link',
      'content' => snippet('article-figure', [
        'ratio' => 16/9,
        'image' => $image,
        'class' => 'article__header-cover'
      ], true)
    ]) ?>
    <?php endif ?>
  </header>

  <?php if (isset($length)) : ?>
  <div class="article__excerpt">
    <?= excerpt($article->text()->kirbytext(), $length) ?>
    <a class="article__excerpt-link" href="<?= $article->url() ?>">lire la suite</a>
  </div>
  <?php endif ?>
</article>
