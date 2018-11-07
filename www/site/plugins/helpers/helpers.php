<?php

  // globally available helpers function

  @include __DIR__ . DS . 'panel_helpers.php';

  function buildParamURL ($arr) {
    $params = array_merge(params(), $arr);
    return url('./' . url::paramsToString($params));
  }

  function getArticleYear ($article) {
    return $article->date('%Y');
  }

  function getTopLevelPage ($page) {
    if ($page->depth() === 1) return $page;

    $parents = $page->parents();
    return $parents->last();
  }

  function beautifyUrl ($url) {
    return preg_replace('(^https?://)', '', $url);
  }

  function attachmentToLink ($page, $attachment) {
    // NOTE: this allows passing $attachment as simple ['title' => '', 'url' => ''] array
    if (is_array($attachment)) return $attachment;

    $p = r($attachment->page()->isNotEmpty(), site()->find($attachment->page()));
    $url = r($attachment->url()->isNotEmpty(), $attachment->url());
    $file = r($attachment->file()->isNotEmpty(), $page->file($attachment->file()));
    if ($file) $url = $file->url();
    if ($p) $url = $p->url();
    if (!$url) return;

    $title = r($attachment->text()->isNotEmpty(), $attachment->text()->html());
    if (!$title) {
      if ($file) $title = $file->filename();
      else $title = beautifyUrl($url);
    }

    return compact('title', 'url');
  }
