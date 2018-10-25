<?php

  kirbytext::$tags['redirect'] = [
    'attr' => ['text'],
    'html' => function ($tag) {
      $url = $tag->attr('redirect') . $_SERVER['REQUEST_URI'];
      $text = $tag->attr('text') ? $tag->attr('text') : beautifyUrl($url);
      return '<a href="' . $url . '">' . $text . '</a>';
    }
  ];
