<?php
  email::$services['html-mail'] = function($email) {
    $headers = header::create([
      'From'                      => $email->from,
      'Reply-To'                  => $email->replyTo,
      'Cc'                        => $email->cc,
      'Bcc'                       => $email->bcc,
      'Return-Path'               => $email->replyTo,
      'Message-ID'                => '<' . time() . '-' . $email->from . '>',
      'X-Mailer'                  => 'PHP v' . phpversion(),
      'Content-Type'              => 'text/html; charset=utf-8',
      'Content-Transfer-Encoding' => '8bit',
    ]);
    ini_set('sendmail_from', $email->from);
    $send = mail(
      $email->to,
      str::utf8($email->subject),
      str::utf8($email->body),
     $headers
    );
    ini_restore('sendmail_from');
    if(!$send) {
      throw new Error('The email could not be sent');
    }
  };
