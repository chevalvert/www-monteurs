<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, minimal-ui">
  <meta http-equiv="cleartype" content="on">

  <?php // NOTE: every form* template is prevent from being indexed to prevent spam ?>
  <?php if (isset($nofollow) && $nofollow) : ?>
    <meta name="robots" content="noindex, nofollow">
  <?php endif ?>

  <?php snippet('header.metas') ?>

  <title><?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?></title>

  <?php echo liveCSS('assets/builds/bundle.css') ?>
</head>
<body data-uri=<?= getTopLevelPage($page)->uri() ?>>
<?php if ($site->language() == 'en' && !$page->content('en')->exists()) go($page->url('fr')) ?>
