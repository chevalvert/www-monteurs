<?php

  return [
    'name' => 'Editeur',
    'default' => false,
    'permissions' => [
      '*' => true,

      'panel.access' => true,
      'panel.access.options' => true,
      'panel.access.users' => true,

      'panel.widget.account' => true,
      'panel.widget.history' => true,
      'panel.widget.pages' => true,
      'panel.widget.typography' => false,
      'panel.widget.quickadd-widget' => true,
      'panel.widget.kirby-backup-widget' => false,
      'panel.widget.site' => true,

      'panel.site.update' => false,

      'panel.page.read' => true,
      'panel.page.create' => true,
      'panel.page.update' => true,
      'panel.page.delete' => true,
      'panel.page.url' => true,
      'panel.page.visibility' => true,

      'panel.file.upload' => true,
      'panel.file.replace' => true,
      'panel.file.rename' => true,
      'panel.file.update' => true,
      'panel.file.sort' => true,
      'panel.file.delete' => true,

      'panel.user.read' => true,
      'panel.user.create' => false,
      'panel.user.update' => function () { return $this->user()->is($this->target()->user()); },
      'panel.user.delete' => function () { return $this->user()->is($this->target()->user()); },

      'panel.avatar.upload' => function () { return $this->user()->is($this->target()->user()); },
      'panel.avatar.replace' => function () { return $this->user()->is($this->target()->user()); },
      'panel.avatar.delete' => function () { return $this->user()->is($this->target()->user()); }
    ]
  ];
