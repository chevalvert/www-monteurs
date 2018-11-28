<?php

@include __DIR__ . DS . 'license.php';
@include __DIR__ . DS . 'credentials.php';

// Core config
c::set([
  'ssl' => true,
  'error' => 'erreur',

  'cache' => true,
  'cache.ignore' => ['sitemap', 'feed'],

  'sitemap.ignore' => [
    'home',
    'feed',
    'bac-a-sable',
    'annoncer-une-actualite',
    'sitemap',
    'erreur',
    'backups'
  ],

  'panel.kirbytext' => true,
  'smartypants' => true,
  'markdown.extra' => true,

  'email.service' => 'mail',
  // 'email.from' => SEE: credentials.php
  // 'email.replyTo' => SEE: credentials.php

  'params.names' => [
    'pagination' => 'archive',
    'lists.filter' => 'voir'
  ],

  'search.include.templates' => [
    'article',
    'page',
    'publication',
    'member-new'
  ],

  'date.handler' => 'strftime',
  'date.format' => '%e %B %Y',
  'language.detect' => false,
  'languages' => [
    [
      'code' => 'fr',
      'name' => 'French',
      'default' => true,
      'url' => '/',
      'locale'  =>  'fr_FR.UTF-8'
    ],
    [
      'code' => 'en',
      'name' => 'English',
      'url' => 'en',
      'locale' => 'en_US.UTF-8'
    ]
  ],

  'routes' => [
    [
      // SEE: https://github.com/arnaudjuracek/kirby-backup-widget#security
      'pattern' => 'content/backups/(:any)',
      'action' => function ($file) {
        if (site()->user()) {
          // NOTE: only logged users have access to content/backups files
          page('backups')->files()->find($file)->download();
        } else {
          header::forbidden();
          die('Unauthorized access');
        }
      }
    ]
  ]
]);

// Thrid party configs
c::set([
  // 'ga.tracking_id' => SEE: credentials.php
  //
  'panel.widgets' => [
    'site'     => true,
    'pages'    => true,
    'account'  => true,
    'quickadd-widget' => true,
    'kirby-backup-widget' => true,
    'history'  => true,
    'typography' => false
  ],

  'plugin.html.minifier.active' => true,
  'plugin.html.minifier.blacklist' => ['feed', 'sitemap'],

  'typography.punctuation.spacing.french' => true,
  'typography.dashes.style' => 'em',
  'typography.quotes.primary' => 'doubleGuillemetsFrench',
  'typography.quotes.secondary' => 'doubleCurled',
  'typography.hyphenation.language' => 'fr',
  'typography.hyphenation.minlength' => 12,
  'typography.hyphenation.titlecase' => false,
  'typography.hyphenation.allcaps' => false,
  'typography.hyphenation.compounds' => false,
  'typography.math' => false,
  'typography.fractions' => false,
  'typography.dewidow' => true,

  'translations.translation' => [
    'en' => [
      'lbl_is_up_to_date' => 'Translation is up to date',
      'btn_cancel' => 'Annuler',
      'btn_delete' => 'Supprimer',
      'alert_update' => 'Cette action remettra à zéro le fichier. Tout changement sera perdu.',
      'sync' => 'Synchroniser',
      'with' => 'avec',
    ]
  ],

  'focus.field.fullwidth' => true,
  'widget.backup.include_site' => true,
  'widget.quickadd.pageURIs' => [
    'actualites',
    'publications',
    'actualite-des-adherents'
  ],

  'plugin.updateid' => [
    [
      'pages'  => 'accueil',
      'fields' => ['featured', 'pinned']
    ]
  ]
]);

// Set session validity to 30 days
// SEE: https://forum.getkirby.com/t/login-session-lifetime-extending-for-the-frontend/2922/3
// SEE: https://github.com/jenstornell/kirby-secrets/wiki/Fingerprint
c::set([
  'panel.session.timeout' => 60 * 24 * 30,
  'panel.session.lifetime' => 60 * 24 * 30
]);
s::$timeout =  60 * 24 * 30;
s::$cookie['lifetime'] = 0;
s::$fingerprint = function () { return sha1(Visitor::ua()); };
