<?php
  $p = isset($obj) ? $obj : null;
  if (!$p) $p = isset($uri) ? $site->find($uri) : null;
?>

<?php if ($p) : ?>
<a class="<?php echo isset($class) ? $class : '' ?>" href="<?= $p->url() ?>" <?= isset($tabindex) ? 'tabindex="'.$tabindex.'"' : '' ?>>
  <?= isset($content) ? $content : $p->title()->html() ?>
</a>
<?php endif ?>
