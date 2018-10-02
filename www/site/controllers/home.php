<?php

  return function ($site, $pages, $page) {
    $pinned = $page->pinned()->pages(',')->shuffle();
    $len = $pinned->count();
    $banners = $len > 4
      ? $pinned->chunk(($len + 1) / 2)
      : [$pinned];

    $memberNews = $site
      ->page('actualite-des-adherents')
      ->children()
      ->visible()
      ->flip()
      ->limit(6);

    return compact('banners', 'memberNews');
  };
