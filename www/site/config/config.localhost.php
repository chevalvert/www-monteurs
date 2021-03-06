<?php
  c::set([
    'debug' => true,
    'cache' => false,
    'ssl' => false,
    'plugin.html.minifier.active' => false
  ]);

  // The code below are required for the kirby-webpack dev server to work
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] === 'webpack') {
    c::set('url',  $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_X_FORWARDED_HOST']);
  }
