<?php


  class MemberNews {
    static function create ($data) {
      try {
        $slug = str::slug($data['title']);
        $uid = self::ensure_uid($slug);

        $data['date'] = date('Y-m-d');
        $newPage = page('actualite-des-adherents')
          ->children()
          ->create($uid, 'member-new', $data);

        return $newPage;
      } catch (Exception $e) {
        return ['error' => $e];
      }
    }

    static function upload ($page, $image = null) {
      if (!is_a($page, 'Page')) return $page;
      if (!$image || !array_key_exists('tmp_name', $image)) return false;

      $upload = new Upload($page->root() . DS . '{safeFilename}', [
        'input' => 'image',
        'overwrite' => true
      ]);

      if ($file = $upload->file()) return $file;
      else return ['error' => $upload->error()];
    }

    static function ensure_uid ($uid, $original = null, $iterations = 1) {
      if (!page('actualite-des-adherents')->find($uid)) return $uid;

      $original = $original ? $original : $uid;
      return self::ensure_uid($original . '-' . $iterations, $original, ++$iterations);
    }
  }
