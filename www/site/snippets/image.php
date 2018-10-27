<img
  class="<?= isset($class) ? $class : '' ?>"
  width="<?= $image->width() ?>"
  height="<?= $image->height() ?>"
  alt="<?= isset($alt) ? $alt : '' ?>"
  title="<?= isset($alt) ? $alt : '' ?>"

  <?php if (isset($attributes)) {
    foreach ($attributes as $attribute => $value) {
      echo $attribute . '="'. $value .'"';
    }
  } ?>

  <?php if (isset($lazy) && $lazy) {
    echo 'data-lozad ';
    echo 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" ';
    echo 'data-src="' . $image->url() . '" ';
  } else {
    echo 'src="' . $image->url() . '" ';
  } ?>
/>
<noscript><img src="<?= $image->url() ?>" /></noscript>
