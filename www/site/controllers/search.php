<?php

return function($site, $pages, $page) {
  $query   = get('q');
  $results = $site
    ->index()
    ->visible()
    ->filter(function ($p) {
      return in_array($p->intendedTemplate(), c::get('search.include.templates'));
    })
    // NOTE: slug to search for unaccentuated chars (ie: categories, which are stored slugged)
    ->search($query . ' ' . str::slug($query, ' '), [
      // Match partial words
      'words' => false,
      'fields' => [
        'title',
        'categories',
        'description',
        'text'
      ]
    ]);

  return compact('query', 'results');
};
