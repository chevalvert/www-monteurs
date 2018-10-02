<?php

  return function ($site, $pages, $page) {
    $byYear = function ($p) {
      return $p->date('%Y');
    };

    $categories = $page->categories()->toStructure();
    $current_category_id = param(c::get('params.names')['lists.filter'], null);

    $byCategory = function ($p) use ($current_category_id) {
      return $current_category_id
        ? str::contains($p->categories(), $current_category_id)
        : true;
    };

    $current_category = $categories->filter(function ($p) use ($current_category_id) {
      return str::slug($p->title()) === $current_category_id;
    })->first();

    $articles = $page
      ->children()
      ->visible()
      ->sortBy('date')
      ->flip()
      ->filter($byCategory)
      ->group($byYear);

    $years = $articles->keys();
    if (!$years) return [
      'articles' => $articles,
      'years' => [],
      'current_year' => null,
      'current_category' => $current_category,
      'categories' => $categories
    ];

    $current_year = param(c::get('params.names')['pagination'], $years[0]);

    $articles = $articles->get($current_year);
    if (!$articles) $articles = new Collection();

    return compact(
      'articles',
      'years',
      'categories',
      'current_year',
      'current_category'
    );
  };
