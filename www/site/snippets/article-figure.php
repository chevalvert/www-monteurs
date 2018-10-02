<figure class="article-figure <?= isset($class) ? $class : '' ?>">
  <?php
    $resized = $image->thumb(['width' => 2000]);
    $caption = $image->caption()->isNotEmpty() ? $image->caption() : null;
    $zoomable = isset($zoomable) && $zoomable;
    $preview = isset($preview) && $preview;
  ?>

  <?php if ($caption) : ?>
  <figcaption class="article-figure__caption" title="<?= $caption ?>">
    <?= $caption->html() ?>
  </figcaption>
  <?php endif ?>

  <?php if ($zoomable) : ?>
  <a class="article-figure__link" href="<?= $resized->url() ?>">
  <?php endif ?>

    <div class="article-figure__image">
      <?php
        $size = min(700, $image->width());
        snippet('image', [
          'lazy' => true,
          'image' => $image->focusCrop($size, $size / $ratio, ['quality' => 100]),
          'caption' => $caption
        ])
      ?>
    </div>

    <?php if ($preview) : ?>
    <?php // TODO: refactor with only one image ?>
    <div class="article-figure__fullpreview">
      <?php snippet('image', [
          'lazy' => true,
          'image' => $resized,
          'caption' => $caption,
          'attributes' => [
            'data-zoom-src' => $resized->url()
          ]
        ])
      ?>
    </div>
    <?php endif ?>

  <?php if ($zoomable) : ?>
  </a>
  <?php endif ?>

</figure>
