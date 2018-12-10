<?php

  return function ($site, $pages, $page) {
    $byYear = function ($p) {
      return $p->date('%Y');
    };

    $articles = $page
      ->children()
      ->visible()
      ->sortBy('date', 'DESC')
      ->group($byYear);

    $years = $articles->keys();
    $current_year = param(c::get('params.names')['pagination'], $years[0]);

    $articles = $articles->get($current_year);
    if (!$articles) $articles = new Collection();

    return compact(
      'articles',
      'years',
      'current_year',
      'current_category'
    );
  };
