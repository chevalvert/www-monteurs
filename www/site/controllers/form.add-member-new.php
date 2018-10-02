<?php
  return function ($site, $pages, $page) {
    $alert = null;
    $messages = null;

    function createField ($value, $type = 'text', $rules = null, $message = null) {
      return [
        'value' => $value,
        'type' => $type,
        'rules' => $rules,
        'required' => $rules && $rules[0] == 'required',
        'message' => $message
      ];
    }

    function fieldHasKey ($field, $key) {
      return array_key_exists('rules', $field) && $field['rules'];
    }

    $err_messages = [
      'email' => 'e-mail invalide',
      'token' => "Un jeton d'authentification est nécessaire pour l'ajout d'une actualité",
      'default' => 'champ obligatoire',
    ];

    $fields = [
      'email' => createField('e-mail', 'email', ['required', 'email'], $err_messages['email']),
      'token' => createField('token', 'text', ['required'], $err_messages['token']),
      'title' => createField('titre', 'text', ['required'], $err_messages['default']),
      'location' => createField('diffusion', 'text', ['required'], $err_messages['default']),
      'dates' =>createField('date(s)', 'text', ['required'], $err_messages['default']),
      'team' => createField('équipe', 'textarea', ['required'], $err_messages['default']),
      'description' => createField('présentation', 'textarea'),
      'image' => createField('image', 'file', ['required'], $err_messages['default']),
      'links' => createField('liens')
    ];

    $data = [];
    $token = $data['token'] = get('token');

    if (r::is('post') && get('submit')) {
      // Honeypot for spam bots
      $honey = get('website');
      $csrf_token = get('csrf');
      if (!empty($honey) || !csrf($csrf_token)) {
        go($page->url());
        exit;
      }

      $rules = [];
      $messages = [];

      foreach ($fields as $field_id => $field) {
        $data[$field_id] = get($field_id);
        if (fieldHasKey($field, 'rules')) $rules[$field_id] = $field['rules'];
        if (fieldHasKey($field, 'message')) $messages[$field_id] = $field['message'];
      }

      $image = isset($_FILES['image']) ? $_FILES['image'] : '';
      // ???: test $image['size'] and $image['type']

      if (($invalid = invalid($data, $rules, $messages))) {
        $alert = $invalid;
      } else if ($data['token'] != $page->token()) {
        $failed = $page->unauthorized();
        $err = 'token : ' . $data['token'];
      } else {
        $data['cover'] = $image['name'];
        $newPage = MemberNews::create($data);
        $newFile = MemberNews::upload($newPage, $image);

        if (is_a($newPage, 'Page') && is_a($newFile, 'Media')) {
          $email = email([
            'service' => 'html-mail',
            'to'      => $site->mailto(),
            'subject' => 'Une nouvelle actualité est en attente de validation',
            'body'    => '
              Une nouvelle actualité est en attente de validation : <a href="' . PanelHelpers::getPanelURL($newPage, 'edit') . '">' . $newPage->title()->html() . '</a>
            '
          ]);

          if ($email->send()) {
            $success = $page->success();
            $token = '';
            $data = [];
          } else {
            $failed = $page->fail();
            $err = $email->error() ? $email->error()->message() : '[MemberNews::create] ' . $newPage['error']->getMessage();
          }
        } else {
          $failed = $page->fail();
          $err = !is_a($newFile, 'Media') ? $newFile['error']->getMessage() : $newPage['error']->getMessage();
        }
      }
    }

    return compact('fields', 'alert', 'messages', 'data', 'success', 'failed', 'err', 'token');
  };
