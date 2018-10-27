<?php

kirbytext::$tags['image'] = array(
  'attr' => array(
    'zoomable',
    'ratio',
    'width',
    'height',
    'alt',
    'text',
    'title',
    'class',
    'imgclass',
    'linkclass',
    'caption',
    'link',
    'target',
    'popup',
    'rel'
  ),
  'html' => function($tag) {
    $url = $tag->attr('image');
    $title = $tag->attr('title');
    $link = $tag->attr('link');
    $caption = $tag->attr('caption');
    $file = $tag->file($url);

    // use the file url if available and otherwise the given url
    $url = $file ? $file->url() : url($url);

    // alt is just an alternative for text
    $alt = $tag->attr('alt');
    if ($text = $tag->attr('text')) $alt = $text;

    return snippet('article-figure', [
      'class' => $tag->attr('class'),
      'caption' => $alt,
      'image' => $file,
      'ratio' => $tag->attr('ratio'),
      'zoomable' => $tag->attr('zoomable'),
      'width' => $tag->attr('width')
    ], true);
  }
);
