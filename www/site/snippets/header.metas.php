<meta name="description" content="<?= $site->description()->text() ?>">
<meta name="keywords" content="<?= $site->keywords()->text() ?>">

<link rel="apple-touch-icon" sizes="180x180" href="<?= $kirby->urls()->assets() ?>/favicons/apple-touch-icon.png?v=3">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="icon" type="image/png" sizes="32x32" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-32x32.png?v=3">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-16x16.png?v=3">
<link rel="manifest" href="<?= $kirby->urls()->assets() ?>/favicons/manifest.json?v=3">
<link rel="mask-icon" href="<?= $kirby->urls()->assets() ?>/favicons/safari-pinned-tab.svg?v=3" color="#000000">
<link rel="shortcut icon" href="favicon.ico?v=3">

<meta name="application-name" content="<?= $site->title() ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-config" content="<?= $kirby->urls()->assets() ?>/favicons/browserconfig.xml">

<meta name="theme-color" content="#ffffff"

<meta property="og:url" content="<?= $site->url() ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?>">
<meta property="og:description" content="<?= $site->description()->text() ?>">
<meta property="og:site_name" content="<?= $site->title() ?>">
<meta property="og:locale" content="fr_FR">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@LesMonteursAsso">
<meta name="twitter:creator" content="@LesMonteursAsso">
<meta name="twitter:url" content="<?= $site->url() ?>">
<meta name="twitter:title" content="<?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?>">
<meta name="twitter:description" content="<?= $site->description()->text() ?>">

<?php if ($image = $page->cover()->isNotEmpty() ? $page->image($page->cover()) : null) : ?>
  <?php $og_cover = $image->focusCrop(1200, 630) ?>
  <meta property="og:image" content="<?= $og_cover->url() ?>">
  <meta property="og:image:width" content="<?= $og_cover->width() ?>">
  <meta property="og:image:height" content="<?= $og_cover->height() ?>">
  <meta name="twitter:image" content="<?= $image->url() ?>">
<?php endif ?>
