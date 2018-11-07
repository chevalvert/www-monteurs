<?php
  $ratio = isset($ratio) ? $ratio : $image->ratio();
  $width = min(isset($width) ? $width : 700, $image->width());
  $height = isset($height) ? $height : $width / $ratio;
  $quality = isset($quality) ? $quality : 100;

  $thumbnail = $image->focusCrop($width, $height, compact('quality'));

  $zoomable = isset($zoomable) && $zoomable;
  $preview = $zoomable && $ratio != $image->ratio();
  if ($preview) $fullscreen = $image->thumb(['width' => 2000]);
?>

<figure class="article-figure <?= isset($class) ? $class : '' ?>">
  <div class="article-figure__wrapper">
    <?php
    $img = snippet('image', [
      'lazy' => true,
      'class' => 'article-figure__image',
      'image' => $thumbnail,
      'alt' => isset($caption) ? $caption : $image->caption()
    ], true);

    // NOTE: wrap img element inside a link if $zoomable is set to true
    echo !$zoomable
      ? $img
      : html::a(url($image->url()), $img, [
        'class' => 'article-figure__link unstyled-link',
      ]);
    ?>

    <?php if ($preview) : ?>
    <div class="article-figure__fullpreview">
      <?php snippet('image', [
        'lazy' => true,
        'image' => $fullscreen,
        'attributes' => [
          'data-zoom-src' => $fullscreen->url()
        ]
      ])
      ?>
    </div>
    <?php endif ?>
  </div>

  <?php if (isset($caption)) : ?>
  <figcaption class="article-figure__caption">
    <?= html($caption) ?>
  </figcaption>
  <?php endif ?>

</figure>
