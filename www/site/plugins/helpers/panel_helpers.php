<?php

  // NOTE: this is used to retrieve categories defined in list.*.yml blueprints
  // the categories are globally available through c::get('lists.categories.intendedTemplate')
  // or via PanelHelpers::getCategoriesOfParentList
  // or via unslug_category($listTemplate, $category_id)

  $byIntendedTemplate = function ($p) { return str::contains($p->intendedTemplate(), 'list'); };
  $lists = site()->index()->filter($byIntendedTemplate);
  $lists_categories = [];

  foreach ($lists as $list) {
    $name = $list->intendedTemplate();
    $lists_categories[$name] = [];
    foreach ($list->categories()->toStructure() as $category) {
      $category_id = str::slug($category->title());
      $lists_categories[$name][$category_id] = $category->title();
    }
    c::set('lists.categories.' . $name, $lists_categories[$name]);
  }

  class PanelHelpers {
    static function getCategoriesOfParentList ($field) {
      return c::get('lists.categories.' . $field->parentList());
    }

    // NOTE: this is used in list.*.yml by the index field
    static function beautifyPages ($pages) {
      foreach ($pages as &$page) {
        $p = page($page['uri']);
        $page['parsedDate'] = $p->date('%Y-%m-%d');

        $v = $p->isVisible() ? '<b>visible</b>' : 'invisible';
        $page['parsedVisibility'] = '<a href="' . self::getPanelURL($p, 'toggle') . '" data-modal>' . $v . '</a>';
      }
      return $pages;
    }

    static function getPanelURL ($page, $action = 'add') {
      return site()->url() . '/panel/pages/' . $page->uri() . '/' .$action;
    }
  }

  function unslug_category ($listTemplate, $category_id) {
    $categories = c::get('lists.categories.' . $listTemplate);
    if (!$categories) return;
    return array_key_exists($category_id, $categories)
      ? $categories[$category_id]
      : null;
  }

