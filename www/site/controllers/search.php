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
      'words' => true
    ]);

  return compact('query', 'results');
};
