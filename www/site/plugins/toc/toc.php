<?php

  field::$methods['toc'] = 'toc';
  field::$methods['anchors'] = 'anchors';

  /**
   * Return the table of content of the field
   *
   * @param string $field
   * @param int $maxLevel
   * @return the TOC html
   */
  function toc ($field, $maxLevel = 6) {
    $toc = json_decode(toc_json($field->value));

    if (!function_exists('build')) {
      function build ($entry, $maxLevel, $level = 0) {
        if ($level > $maxLevel) return;

        if (!is_array($entry) && strlen($entry->text) > 0) {
          if ($entry->level > $maxLevel) return;

          $li = brick('li');
          $a = brick('a', $entry->text, [
            'class' => 'toc-link',
            'data-depth' => 1,
            'href' => '#' . $entry->slug
          ]);
          $li->append($a);
          return $li;
        } else {
          $ul = brick('ul');
          foreach ($entry as $sub_entry) {
            $sub = build($sub_entry, $maxLevel, ++$level);
            if ($sub) $ul->append($sub);
          }
          return $ul;
        }
      }
    }

    $html = brick('ul', ['class' => 'toc']);
    foreach ($toc as $firstLevelEntry) {
      $li = brick('li');
      $li->append(build($firstLevelEntry, $maxLevel));
      $html->append($li);
    }

    return $html;
  }

  /**
   * Wrap all titles of a field inside anchored links
   *
   * @param string $field
   * @return the kirbytext of the $field
   */
  function anchors ($field) {
    $input = str_replace(["\r\n", "\r"], "\n", $field->value);

    $slugs = [];
    $field->value = preg_replace_callback('/^(#).*$/m',
                  function ($matches) use (&$slugs) {
                    $lvl = strrpos($matches[0], '#') + 1;
                    $txt = substr($matches[0], $lvl);

                    $slug = str::slug($txt);
                    array_push($slugs, $slug);
                    if (($slug_count = countOccurence($slug, $slugs)) - 1 > 0) {
                      $slug .=  '-' . $slug_count;
                    }

                    $anchor = brick('div', [
                                    'id'    => $slug,
                                    'class' => 'toc-anchor'
                                    ]);
                    $title = brick('h' . $lvl, $txt, ['class' => 'has-anchor']);
                    $title->prepend($anchor);
                    return $title;
                  },
                  $input, -1, $i);
    return $field;
  }

  function countOccurence ($needle, $haystack) {
    $counts = array_count_values($haystack);
    return array_key_exists($needle, $counts) ? $counts[$needle] : -1;
  }

  /**
   * Return the table of content in json
   *
   * @param string $markdown
   * @return encoded json
   * @see https://stackoverflow.com/a/34970944
   */
  function toc_json ($markdown) {
    // ensure using only "\n" as line-break
    $source = str_replace(["\r\n", "\r"], "\n", $markdown);

    // look for markdown TOC items
    preg_match_all('/^(#).*$/m',
                   $source,
                   $matches,
                   PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE
                   );

    // preprocess: iterate matched lines to create an array of items
    // where each item is an array(level, text)
    $file_size = strlen($source);

    $arr = [];
    $slugs = [];
    foreach ($matches[0] as $item) {
      $found_mark = substr($item[0], 0, 1);
      if ($found_mark == '#') {
        // text is the found item
        $item_text = $item[0];
        $item_level = strrpos($item_text, '#') + 1;
        $item_text = substr($item_text, $item_level);
      } else {
        // text is the previous line (empty if <hr>)
        $item_offset = $item[1];
        $prev_line_offset = strrpos($source, "\n", -($file_size - $item_offset + 2));
        $item_text =
        substr($source, $prev_line_offset, $item_offset - $prev_line_offset - 1);
        $item_text = trim($item_text);
        $item_level = $found_mark == '=' ? 1 : 2;
      }
      if (!trim($item_text) OR strpos($item_text, '|') !== FALSE) {
        // item is an horizontal separator or a table header, don't mind
        continue;
      }
      $slug = str::slug($item_text);
      array_push($slugs, $slug);
      if (($slug_count = countOccurence($slug, $slugs)) - 1 > 0) {
        $slug .=  '-' . $slug_count;
      }

      $arr[] = [
        'level' => $item_level,
        'text'  => trim($item_text),
        'slug'  => $slug,
      ];
    }

    if (!function_exists('recursiveWalk')) {
      function recursiveWalk ($arr, $parent_entry, &$i) {
        $entries = [];
        $sub_entries = [];

        for ($i; $i < count($arr) - 1; $i++) {
          $entry = $arr[$i + 1];
          if ($entry['level'] > $parent_entry['level']) {
            if ($entry['level'] - $parent_entry['level'] > 1) {
              $sub_entries[] = recursiveWalk($arr, $entry, $i);
            } else $sub_entries[] = $entry;
          } else break;
        }

        $entries[] = $parent_entry;
        if (count($sub_entries)) $entries[] = $sub_entries;
        return $entries;
      }
    }

    $raw_toc = [];
    for ($i = 0; $i < count($arr); $i++) {
      $entry = $arr[$i];
      $raw_toc[] = recursiveWalk($arr, $entry, $i);
    }

    // create a JSON list (the easiest way to generate HTML structure is using JS)
    return json_encode($raw_toc);
  }
